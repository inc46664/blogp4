<?php
$conf = array(
	'pageid' => 5,
	'title' => 'Déconnexion',
	'desc' => 'se deconnecter'
);

if($PROFILE->isLogged()) {
	unset($_SESSION['blog-user']);
}
header('location:'.WEBROOT);