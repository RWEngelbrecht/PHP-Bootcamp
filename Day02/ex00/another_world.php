#!/usr/bin/php
<?php
function ft_split($str){
	$words = explode(" ", $str);
	$filtered = array_filter($words);
	$filtered = array_values($filtered);
	return ($filtered);
}
$i = 0;
$space = -1;
if ($argc > 1)
{
	$arr = ft_split($argv[1]);
	$str = implode(" ", $arr);
	echo "$str\n";
}
?>
