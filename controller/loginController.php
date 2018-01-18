<?php
if($action == 'index') {
	
	// Index page
	$CHAPITRES = $chapEngine->getChapters('*', '`broadcast` = 1', 'order by `date_create` DESC', 'LIMIT 10', array(), $bdd, $comsEngine);
	
} else if ($action == 'lire') {
	
	// Page lecture billet
	$cur_billet = null;
	$EditMode = false;
	if(isset($arguments[2])) {
		if(strlen($arguments[2]) > 0) {
			$cur_billet = trim(htmlspecialchars(htmlentities($arguments[2])));
		}
	}
	if($cur_billet != null) {
		
		$BILLET = $chapEngine->getChapterByUrl($cur_billet, $bdd);
		
	}
	
}