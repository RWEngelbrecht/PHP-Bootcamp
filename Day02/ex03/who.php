#!/usr/bin/php
<?php
date_default_timezone_set('Africa/Johannesburg');
$file = fopen("/var/run/utmpx", "r");
$final = [];
while ($packed = fread($file, 628))
{
	$unpacked = unpack('a256user/a4id/a32line/ipid/itype/i16time', $packed);
	// print_r($unpacked);
	if ($unpacked['type'] == "7")
		array_push($final, $unpacked);
}
foreach($final as $usr)
{
	$date = date('M d h:i', $usr['time1']);
	echo $usr['user']." ".$usr['line']."  $date\n";
}
?>
