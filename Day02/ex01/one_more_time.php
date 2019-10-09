#!/usr/bin/php
<?php
function err(){
	echo "Wrong Format\n";
	exit;
}

if ($argc > 1)
{
	$week_days = array("Lundi"=>"Monday", "Mardi"=>"Tuesday", "Mercredi"=>"Wednesday", "Jeudi"=>"Thursday",
						"Vendredi"=>"Friday", "Samedi"=>"Saturday", "Dimanche"=>"Sunday");
	$months = array("Janvier"=>"January", "Fevrier"=>"February", "Mars"=>"March", "Avril"=>"April",
						"Mai"=>"May", "Juin"=>"June", "Juillet"=>"July", "Aout"=>"August", "Septembre"=>"September",
							"Octobre"=>"October", "Novembre"=>"November", "Decembre"=>"December");
	$date_fr = explode(" ", $argv[1]);
	if (count($date_fr) != 5)
		err();
	if (!ctype_alpha($date_fr[0]) || !ctype_alpha($date_fr[2]))
		err();
	if (!is_numeric($date_fr[1]) || $date_fr[1] > 31 || !is_numeric($date_fr[3]))
		err();
	if (!preg_match('/^(00|[0-9]|1[0-9]|2[0-3]):([0-9]|[0-5][0-9]):([0-9]|[0-5][0-9])$/', $date_fr[4]))
		err();
	$i = 0;
	foreach($week_days as $key=>$day)
	{
		if (!strcasecmp($key, $date_fr[0]))
			break;
		if ($i == 7)
			err();
		$i++;
	}
	$date_en = $date_fr;
	$date_en[0] = $week_days[ucfirst($date_fr[0])];
	$date_en[2] = $months[ucfirst($date_fr[2])];
	$date_long = implode(" ", $date_en);
	array_shift($date_en);
	$date_short = implode(" ", $date_en);
	if (strcmp(strtotime($date_long), strtotime($date_short)))
		err();
	$time = strtotime($date_long);
	echo $time."\n";
}
?>
