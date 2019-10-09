#!/usr/bin/php
<?php

function compare($a, $b){
	echo "a = $a\n";
	echo "b = $b\n";
    if(is_numeric($a) && !is_numeric($b))
        return 1;
    else if(!is_numeric($a) && is_numeric($b))
        return -1;
	else if (ctype_alnum($a) && !ctype_alnum($b) )
		return -1;
	else if (!ctype_alnum($a) && ctype_alnum($b))
		return 1;
	else
        return ($a < $b) ? -1 : 1;
}

$i = 0;
$arr = [];
$numer = [];
$alpha = [];
$ascii = [];
while ($argv[++$i])
{
	$j = 0;
	$str = trim(preg_replace('/\s+/', ' ', $argv[$i]));
	$s = explode(" ", $str);
	while ($s[$j])
		array_push($arr, $s[$j++]);
}
print_r($arr);
foreach($arr as $var)
{
	if (is_numeric($var))
		array_push($numer, $var);
}
sort($numer, SORT_STRING);
foreach($arr as $var)
{
	if (ctype_alpha(substr($var, 0, 1)) && !in_array($var, $numer))
		array_push($alpha, $var);

}
sort($alpha, SORT_NATURAL | SORT_FLAG_CASE);
foreach($arr as $var)
{
	if (!ctype_alnum($var) && !in_array($var, $numer) && !in_array($var, $alpha))
		array_push($ascii, $var);
}
sort($ascii);
foreach ($alpha as $var)
	echo "$var\n";
foreach ($numer as $var)
	echo "$var\n";
foreach ($ascii as $var)
	echo "$var\n";
?>
