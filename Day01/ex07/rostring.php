#!/usr/bin/php
<?php
$i = 0;
$arr = [];
while (argv[++$i])
{
	$str = trim(preg_replace('/\s+/', ' ', $argv[$i]));
	$s = explode(" ", $str);
	for ($j = 0; $s[$j]; $j++)
		array_push($arr, $s[$j]);
}
$temp = array_shift($arr);
$k = count($arr);
$arr[$k - 1] = $temp;
for ($j = 0; $j < $k; $j++)
{
	if ($j < $k - 1)
		echo "$arr[$j] ";
	else
		echo "$arr[$j]\n";
}
?>
