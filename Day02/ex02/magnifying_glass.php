#!/usr/bin/php
<?php
function make_replacement($matches){
	return (str_replace($matches[1], strtoupper($matches[1]), $matches[0]));
}

if ($argc > 1)
{
	$file = fopen($argv[1], 'r');
	while (!feof($file))
	{
		$line = fgets($file);
		$line = preg_replace_callback('/<a.*?title="(.*?)">/', 'make_replacement', $line);
		$line = preg_replace_callback('/<a.*?>(.*?)</', 'make_replacement', $line);
		echo $line;
	}
}
?>
