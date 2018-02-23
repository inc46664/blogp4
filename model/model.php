<?php
Class Model {
	
	protected $db;
	
	public function connectDb() {
		try {
			$this->db = new PDO('mysql:host=localhost;dbname=blog_ecrivain', 'root', '');
			$this->db->exec('set names utf8');
		} catch (Exception $e) { die('Impossible de se connecter &agrave; la base de donn&eacute;es'); }
	}
	
}
