<?php
function auth($login, $passwd) {
	$folder = "../private/";
	$file = "passwd";
	$u_data = file_get_contents($folder.$file);
	if (!$u_data) {
		return false;
	}
	$u_data = unserialize($u_data);
	foreach ($u_data as $usr) {
		if ($usr['login'] == $login
				&& $usr['passwd'] == hash('whirlpool', $passwd)) {
			return true;
		}
	}
	return false;
}
?>
