<?php
// Init user
if(isset($_SESSION['blog-user'])) {
	$session_user = trim(htmlentities($_SESSION['blog-user']));
	$getuser = $userModel->getUser($session_user);
	if($getuser['status'] == 'success') {
		$PROFILE->set('id', $getuser['id']);
		$PROFILE->set('pseudo', $getuser['pseudo']);
		$PROFILE->setLogged();
		if($getuser['admin'] == 1) { $PROFILE->setAdmin(); }
	} else {
		unset($_SESSION['blog-user']);
	}
	unset($session_user, $getuser);
}