<?php
class Controller {
	
	public function index() {
		header('location:'.WEBROOT.'chapitres/');
	}
	
	public function chapitres() {
		require_once(ROOT.'model/chapitres.php');
	}
	
	public function inscription() {
		require_once(ROOT.'model/inscription.php');
	}
	
	public function connexion() {
		require_once(ROOT.'model/connexion.php');
	}
	
	public function manager() {
		require_once(ROOT.'model/manager.php');
	}
	
}
