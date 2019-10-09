<?php
function ft_split($str){
	$words = explode(" ", $str);
	$sorted_words = array_filter($words);
	sort($sorted_words);
	return ($sorted_words);
}
?>
