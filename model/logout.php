<?php
Class pageModel extends Model {
	
	public function setHead($CONFIG) {
		$CONFIG['head']['title'] = 'Se déconnecter - '.$CONFIG['global']['name'];
		$CONFIG['head']['desc'] = 'Se déconnecter de la session - Billet simple pour l\'Alaska: le roman en ligne de Jean Forteroche. Suivez tous les chapitres sur ce blog !';
		$CONFIG['head']['pageid'] = 5;
		return $CONFIG;
	}
	
}