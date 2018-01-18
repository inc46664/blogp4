<?php
Class pageModel extends Model {
	
	public function setHead($CONFIG) {
		$CONFIG['head']['title'] = 'Tous les chapitres - '.$CONFIG['global']['name'];
		$CONFIG['head']['desc'] = 'Billet simple pour l\'Alaska: le roman en ligne de Jean Forteroche. Suivez tous les chapitres sur ce blog !';
		$CONFIG['head']['pageid'] = 1;
		return $CONFIG;
	}
	
}