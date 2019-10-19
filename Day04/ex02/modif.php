<?php
if ($_POST['submit'] != "OK")
	exit("ERROR\n");
$user = array('login'=>$_POST['login'], 'passwd'=>hash('whirlpool', $_POST['oldpw']));
$folder = "../private/";
$file = "passwd";
$f_cont = array();
$f_cont = file_get_contents($folder.$file);
$f_cont = unserialize($f_cont);
foreach ($f_cont as $key => $val) {
	if ($val['login'] == $_POST['login'] && $val['passwd'] == hash('whirlpool', $_POST['oldpw'])) {
		$f_cont[$key]['passwd'] = hash('whirlpool', $_POST['newpw']);
		file_put_contents($folder.$file, serialize($f_cont));
		exit("OK\n");
	}
}
exit("ERROR\n");
?>
