<?php

/*
SlypCore

S L y P (Simple, Limpio y Potente / Simple, Lean y Potent)

MIT License
===========

Copyright (c) 2012 Agustin Amenabar <baamenabar@gmail.com>

Permission is hereby granted, free of charge, to any person obtaining a
copy of this software and associated documentation files (the "Software"),
to deal in the Software without restriction, including without limitation
the rights to use, copy, modify, merge, publish, distribute, sublicense,
and/or sell copies of the Software, and to permit persons to whom the
Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
DEALINGS IN THE SOFTWARE.
*/
class SlypCore{

	protected $_errors=array();
	protected $acctions=array();
	protected $mailWebmaster = 'baamenabar@gmailc.om';
	protected $nombreMarca = 'Code Blog Médula';
	protected $mailAministrador = 'agustin@fliin.com';
	protected $_templateDir = '';
	protected $_cachedHtml = './articulos/cached/';
	protected $articleList;
	const noventa = 7776000;
	const treinta = 2592000;
	
	function __construct()
	{
		require "inc/libs/classTextile.php";
		require "inc/libs/markdown.php";
		require "inc/libs/simple_html_dom.php";
	}

	public function getArticleList(){
		if( !count( $this->articleList ) ){
			$this->loadArticleList();
		}
		return $this->articleList;
	}

	function getArticle($filename){
		//$this->processContents();
		//print_r($this->articleList);
		$ao = new stdClass();
		$arl = $this->getArticleList();
		foreach ($arl as $onea) {
			if( $onea['filename'] == $filename ){
				foreach ($onea as $key => $value) {
					$ao->{$key} = $value;
				}
				break;
			}
		}
		if (!isset($ao->modDate)) {
			$this->_errors['5']=true;
			return false;
		}
		$ao->path = $this->_cachedHtml.($filename).$ao->modDate.'.html';
		if(!is_file($ao->path))echo 'NO ENCUENTRO: '.$ao->path;
		//var_dump($ao);
		return $ao;
	}

	public function getTemplateFile($bname){
		if( is_file( $this->_templateDir . $bname) )return $this->_templateDir . $bname;
		if( is_file( $this->_templateDir . $bname . '.php') )return $this->_templateDir . $bname . '.php';
		if( is_file( $this->_templateDir . $bname . '.html') )return $this->_templateDir . $bname . '.html';
		return '';
	}

	public function processContents($forceRewrite=false){
		$fileList = $this->getFileList();
		$this->articleList = array();
		foreach ($fileList as $oneArticle) {
			$leyendoEncabezados = true;
			$articleRawFile = "./articulos/".$oneArticle['filename'];
			$articleRawFilesize = filesize( $articleRawFile );
			$fhandl = fopen($articleRawFile, 'r+b');
			$lastpos = 0;
			while (($buffer = fgets($fhandl)) !== false) {
				//echo "\nbuff=".trim($buffer).';';
				if(!trim($buffer)){
					if( !isset($oneArticle['pubDate']) ){//si el artículo no tiene fecha de publicación guardada, guardamos la última modificación como fecha de publicación
						$oneArticle['pubDate'] = date('Y-m-d H:i:s',$oneArticle['modDate']);
						$agregado = 'pubDate:'.$oneArticle['pubDate'].PHP_EOL.PHP_EOL;
						$theRest = fread($fhandl, $articleRawFilesize);
						fseek($fhandl, $lastpos);
						fwrite($fhandl, $agregado.$theRest);
						$articleRawFilesize += strlen($agregado);
						fseek($fhandl, $lastpos);
						//$leyendoEncabezados=false;
						continue;
					}
					$leyendoEncabezados=false;
					break;
				}
				$lastpos = ftell($fhandl);
				$posDivisor = strpos($buffer, ':');
				if($posDivisor===false)$posDivisor = strlen( $buffer );
				$key = substr($buffer, 0, $posDivisor);
				$value = substr($buffer, $posDivisor+1);
				//echo "\n".trim($key).'=>'.trim($value)." ".$oneArticle.' '.$oneArticle['filename'];
				if( strtolower( trim( $key ) ) == 'not_article' )continue;
				$oneArticle[trim($key)] = trim($value);
			}
			if(!$leyendoEncabezados){//ya leímos los encabezados ahora, procesamos el cuerpo de texto.
				$articleCachedUrl = $this->_cachedHtml.$oneArticle['filename'].$oneArticle['modDate'].'.html';
				//if( true ){
				if( !is_file( $articleCachedUrl ) || $forceRewrite ){
					$articleRawText = fread( $fhandl, $articleRawFilesize );
					if(!$articleRawText)$articleRawText = 'ERROR: no file could be read by fread.';
					if(!isset($oneArticle['markdown'])){
						$textile = new Textile('html5');
						$articleHtml = $textile->TextileThis($articleRawText);
					}else{
						$articleHtml = Markdown($articleRawText);
					}
					$articleDom = str_get_html($articleHtml);
					$introParagraph = $articleDom->find('.intro',0);
					if($introParagraph === null)$introParagraph = $articleDom->find('p',0);
					if($introParagraph !== null){
						$oneArticle['intro'] = trim( $introParagraph->innertext );
					}
				}
				if( @file_put_contents( $articleCachedUrl, $articleHtml ) ){
					$this->_errors['2']=true;
				}

			}
			$this->articleList[] = $oneArticle;
			fclose($fhandl);
		}
		//benchmarkUnserialization($this->articleList);
		//print_r($this->articleList);
		usort($this->articleList, function($a, $b) {
			return $b['pubDate'] - $a['pubDate'];
		});
		if( @file_put_contents( $this->_cachedHtml.'contents.enc', serialize($this->articleList) ) === false)$this->_errors['3'] = true;
		return $this->articleList;
	}

	private function getFileList(){
		$directory = new DirectoryIterator("./articulos");
		$fileList = Array();
		foreach ($directory as $fileinfo) {
		    if ($fileinfo->isFile()) {
		        $extension = pathinfo($fileinfo->getFilename(), PATHINFO_EXTENSION);
		        //echo "<br>". $fileinfo->getFilename() . ' -> ' . $extension;
		        if(strtolower($extension) === 'txt'){
		        	$oneArticle = array(
		        		'filename' => $fileinfo->getFilename(),
		        		'modDate' => $fileinfo->getMTime()
		        		);
		        	$fileList[]=$oneArticle;
		        }
		    }
		}
		return $fileList;
	}
	
	protected function loadArticleList(){
		$encodedFileList = $this->_cachedHtml.'contents.enc';
		if( is_file( $encodedFileList ) ){
			$unserializedT = @unserialize( file_get_contents( $encodedFileList ) );
			if( $unserializedT === false)$this->_errors['4'] = true;
			$this->articleList = $unserializedT;
		}else{
			$this->processContents();
		}
	}

	protected function activaAcciones(){
		$algunaActivada=false;
		if(isset($_GET['a'])&& $_GET['a'] && isset($this->acciones[$_GET['a']])){
			$this->{$this->acciones[$_GET['a']]}();
			$algunaActivada=true;
		}
		return $algunaActivada;
	}
	
	protected function avisaWebmaster($message=''){
		$message.="\r\n\r\nen la fecha:".date('Y-m-d H:i:s');
		$message.="\r\n\r\nen el archivo:".$_SERVER['PHP_SELF']."\r\nllamdo en:".$_SERVER['REQUEST_URI'];
		$this->$mailWebmaster;
		$this->$nombreMarca;
		$this->$mailAministrador;
		$to = $mailWebmaster;
		$subject = 'Error en sitio'.$nombreMarca;
		$additionalHeaders = "From: Soporte $nombreMarca <".$mailAministrador.">\n";
		$additionalHeaders .= 'MIME-Version: 1.0' . "\n";
		$additionalHeaders .= 'Content-type: text/plain; charset=utf-8' . "\n";
		@mail($to, $subject,$message,$additionalHeaders);
	}
	
	protected function valida_email($email) {
		if (preg_match("/[\\000-\\037]/",$email)) {
			return false;
		}
		$pattern = "/^[-_a-z0-9\'+*$^&%=~!?{}]++(?:\.[-_a-z0-9\'+*$^&%=~!?{}]+)*+@(?:(?![-.])[-a-z0-9.]+(?<![-.])\.[a-z]{2,6}|\d{1,3}(?:\.\d{1,3}){3})(?::\d++)?$/iD";
			if(!preg_match($pattern, $email)){
			return false;
		}
		return true;
	}

	public function benchmarkUnserialization($toSer){
		$enJson = json_encode($toSer);
		$enPhp = serialize($toSer);

		//***************** JSON
		$beforeJson = microtime(true);

		for ($i=0; $i < 100000 ; $i++) {
		    json_decode($enJson);
		}

		$afterJson = microtime(true);
		echo ($afterJson-$beforeJson) . " sec/json_decode\n";

		//***************** UNSERIALIZE
		$beforePhp = microtime(true);

		for ($i=0; $i < 100000 ; $i++) {
		    unserialize($enPhp);
		}

		$afterPhp = microtime(true);
		echo ($afterPhp-$beforePhp) . " sec/unserialize\n";
	}

	public function getError($nombre=false){
		if($nombre===false){
			return (bool) count($this->_errors);
		}else{
			if(!isset($this->_errors[$nombre]))return false;
			return (bool) $this->_errors[$nombre];
		}
		return false;
	}
}




?>