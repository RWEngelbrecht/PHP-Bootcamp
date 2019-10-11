<?php
if ($_POST['submit'] != "OK")
	exit("ERROR\n");
$user = array('login'=>$_POST['login'], 'passwd'=>hash('whirlpool', $_POST['oldpw']));
print_r($_POST);
print_r($user);
$folder = "../private/";
$file = "passwd";
$f_cont = array();
$f_cont = file_get_contents($folder.$file);
$f_cont = unserialize($f_cont);
// print_r($f_cont);
foreach($f_cont as $usr) {
	foreach($usr as $key=>$elem) {
		if ($key == "login") {
			if ($elem == $user['login']) {
				$usr_verif = $elem;
			}
		}
		if ($key == "passwd") {
			if ($elem == $user['passwd'])
				$newpas = hash('whirlpool', $_POST['newpw']);
		}
	}
}
echo "oldpas = ".$user['passwd']."\n"."newpas = $newpas\n";
if ($usr_verif == null || $newpas == null)
	exit("ERROR\n");
foreach($f_cont as $usr) {
	foreach ($usr as $key=>$elem) {
		if ($key == "passwd" && $elem == $user['passwd']) {
			echo "doing this\nusr ==  ";
			$usr['passwd'] = $newpas;
			print_r($usr);
		}
	}
}
print_r($f_cont);
file_put_contents($folder.$file, serialize($f_cont));
exit("OK\n")
?>
