<?php
$conf = array(
	'pageid' => 2,
	'title' => 'Se connecter',
	'desc' => 'se connecter à un compte'
);

if(isset($_POST['log-name']) && isset($_POST['log-pass']) && isset($_POST['log-post'])) {
	$name = trim(htmlentities($_POST['log-name']));
	$pass = trim($_POST['log-pass']);
	if($name && $pass) {
		$res = $userModel->auth($name, $pass);
		if($res['status'] == 'success') {
			$_SESSION['blog-user'] = $name;
			header('location:'.WEBROOT);
		} else {
			info('error', 'Mot de passe/Identifiant erronés');
		}
	} else {
		info('error', 'Vous devez compléter les champs');
	}
}