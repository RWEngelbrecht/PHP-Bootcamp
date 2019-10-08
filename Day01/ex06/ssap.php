#!/usr/bin/php
<?php
$i = 0;
$arr = [];
while ($argv[++$i])
{
	$j = 0;
	$str = trim(preg_replace('/\s+/', ' ', $argv[$i]));
	$s = explode(" ", $str);
	while ($s[$j])
		array_push($arr, $s[$j++]);
}
sort($arr);
foreach ($arr as $var)
	echo "$var\n";
?>
