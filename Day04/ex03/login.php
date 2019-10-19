<?php
require_once('./auth.php');
if (!$_GET['login'] || !$_GET['passwd']) {
	exit("ERROR\n");
}
else if (auth($_GET['login'], $_GET['passwd'])) {
	session_start();
	$_SESSION['loggued_on_user'] = $_GET['login'];
	exit("OK\n");
}
else {
	$_SESSION['loggued_on_user'] = "";
}
?>

