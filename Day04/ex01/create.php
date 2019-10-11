<?php
if (!$_POST['login'] || !$_POST['passwd'] || $_POST['submit'] != "OK") {
	exit ("ERROR\n");
}
else {
	$user = array('login'=>$_POST['login'], 'passwd'=>hash('whirlpool', $_POST['passwd']));
}
$folder = "../private/";
$file = "passwd";
if (file_exists($folder) === false) {
	mkdir($folder, 0755, true);
}
if (file_exists($folder.$file) === false) {
	$put = array();
	$put[] = $user;
	file_put_contents($folder.$file, serialize($put));
}
else {
	$put = array();
	$put = file_get_contents($folder.$file);
	$put = unserialize($put);
	foreach($put as $var) {
		foreach($var as $key=>$elem) {
			if ($key == "login" && $elem == $user[$key]) {
				exit("ERROR\n");
			}
		}
	}
	$put[] = $user;
	file_put_contents($folder.$file, serialize($put));
}
exit("OK\n");
?>
