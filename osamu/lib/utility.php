<?php
# utility functions
# 
function exerpt($str, $limit) {
	$str = substr($str, 0, $limit);
	$str = strip_tags($str);
	return $str;
}
?>