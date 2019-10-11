<?php
function authenticate($username, $password){
	if ($username == "zaz" && $password == "Ilovemylittleponey")
		return true;
	else
		return false;
}
if (!authenticate($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']))
{
	header('WWW-Authenticate: Basic realm="Member area"');
	header("HTTP/1.0 401 Unauthorized");
	header('Content-Type: text/html');
?>
<html><body>That area is accessible for members only</body></html>
<?php
	exit;
}
else{
?>
<html><body>
Hello Zaz<br />
<img src='<?php
			$file = file_get_contents('http://localhost:8080/day03/img/42.png');
			$base_64img = base64_encode($file);
			echo "data:image/png; base64,".$base_64img;
			?>'>
</body></html>
<?php
}
?>
