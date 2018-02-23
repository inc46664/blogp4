<?php
$conf = array(
	'pageid' => 3,
	'title' => 'S\'inscrire',
	'desc' => 'créer un compte'
);

if(isset($_POST['reg-name']) && isset($_POST['reg-pass']) && isset($_POST['reg-repass']) && isset($_POST['reg-post'])) {
	$name = trim(htmlentities($_POST['reg-name']));
	$repass = trim($_POST['reg-repass']);
	$pass = trim($_POST['reg-pass']);
	if($name && $pass && $repass) {
		$res_exists = $userModel->exists($name);
		if($res_exists['count'] == 0) {
			if(strlen($name) >= 4 && strlen($name) <= 20) {
				if(strlen($pass) >= 6) {
					if($pass == $repass) {
						$userModel->create($name, $pass);
						$_SESSION['blog-user'] = $name;
						header('location:'.WEBROOT);
					} else {
						info('error', 'Les mots de passe sont différents');
					}
				} else {
					info('error', 'Mot de passe trop court (minimum 6 caractères)');
				}
			} else {
				info('error', 'Le pseudonyme doit faire entre 4 et 20 caractères');
			}
		} else {
			info('error', 'Ce pseudo est déjà pris');
		}
	} else {
		info('error', 'Vous devez compléter les champs');
	}
}