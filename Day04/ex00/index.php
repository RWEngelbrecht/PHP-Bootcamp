<?php
session_start();
if ($_GET['submit'] == "OK" && $_GET['login'] && $_GET['passwd']){
	$_SESSION['login'] = $_GET['login'];
	$_SESSION['passwd'] = $_GET['passwd'];
}
?>
<html><body>
<form name="index.php" method="GET">
	Username: <input name="login" type="text" value="<?php echo $_SESSION['login']; ?>">
	<br />
	Password: <input name="passwd" type="text" value="<?php echo $_SESSION['passwd']; ?>">
	<input type="submit" value="OK">
</form>
</body></html>
