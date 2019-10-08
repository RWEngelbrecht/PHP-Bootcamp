#!/usr/bin/php
<?php
while (!feof(STDIN))
{
	echo "Enter a number: ";
	$input = rtrim(fgets(STDIN));
	if (feof(STDIN))
		exit;
	else if (!is_numeric($input))
		echo "'$input' is not a number\n";
	else if ($input % 2 == 0)
		echo "The number $input is even\n";
	else if ($input % 2 != 0)
		echo "The number $input is odd\n";
}
?>
