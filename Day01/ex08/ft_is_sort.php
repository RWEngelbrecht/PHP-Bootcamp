#!/usr/bin/php
<?php
function ft_is_sort($tab)
{
	$i = 0;
	$sorted = $tab;
	sort($sorted);
	foreach($tab as $val)
	{
		if ($val != $sorted[$i])
			return false;
		$i++;
	}
	return true;
}
?>
