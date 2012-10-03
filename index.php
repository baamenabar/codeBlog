<?php 

$g=$_GET;//I'm lazy.
require "SlypCore.php";
require "SlypMore.php";//set of loose functions

$sly = new SlypCore();

if(isset($g['update']))$sly->processContents(true);
$articleList = $sly->getArticleList();

if( !isset( $g['t'] ) )$g['t']='home';//the default template is home
if(isset($g['a'])){
	$theArticle = $sly->getArticle($g['a']);
}

include $sly->getTemplateFile($g['t']);

if($sly->getError())print_r($sly->getErrorList());

exit();

?>