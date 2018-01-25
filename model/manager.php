<?php
Class pageModel extends Model {
	
	public function setHead($CONFIG) {
		$CONFIG['head']['title'] = 'Manager - '.$CONFIG['global']['name'];
		$CONFIG['head']['desc'] = 'Page de modération';
		$CONFIG['head']['pageid'] = 6;
		return $CONFIG;
	}
	
}