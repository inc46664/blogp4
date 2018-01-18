<?php
try {
	$bdd = new PDO('mysql:host=localhost;dbname=blog_ecrivain', 'root', '');
	$bdd->exec('SET NAMES UTF8');
} catch (Exception $e) {
	die('Impossible de se connecter &agrave la base de donn&eacutees');
}