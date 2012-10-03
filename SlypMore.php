<?php
function getMostRecent($list,$limit=5){
	usort($list, function($a, $b) {
		return $b['modDate'] - $a['modDate'];
	});
	return array_splice($list, 0, $limit);
}
?>