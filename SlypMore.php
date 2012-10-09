<?php
function getMostRecent($list,$limit=5){
	usort($list, function($a, $b) {
		return $b['modDate'] - $a['modDate'];
	});
	return array_splice($list, 0, $limit);
}

function printFile($toprint,$dontPrintJustReturn=false){
	if(!is_file( $toprint ))return;
	$fileRawText = file_get_contents($toprint);
	$textile = new Textile('html5');
	$articleHtml = $textile->TextileThis($fileRawText);
	echo $articleHtml;
}
?>