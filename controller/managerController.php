<?php
if($action == 'index') {
	
	$COMMENTS = array();
	
	// Index page
	if($User->isAdmin()) {
		
		$COMMENTS = $comsEngine->getCheckComments($User, $bdd);
		
	}
	
}