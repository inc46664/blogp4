<?php
if($action == 'index') {
	
	// Index page
	$CHAPITRES = $chapEngine->getChapters('*', '`broadcast` = 1', 'order by `date_create` DESC', 'LIMIT 10', array(), $bdd, $comsEngine);
	
} else if ($action == 'lire') {
	
	// Page lecture billet
	
	$cur_billet = null;
	if(isset($arguments[2])) {
		if(strlen($arguments[2]) > 0) {
			$cur_billet = trim(htmlspecialchars(htmlentities($arguments[2])));
		}
	}
	
	$EditMode = false;
	$Edited = null;
	if(isset($arguments[3])) {
		if(strtolower($arguments[3]) == 'edit' && $User->isAdmin()) {
			$EditMode = true;
		}
	}
	
	if($cur_billet != null) {
		
		$BILLET = $chapEngine->getChapterByUrl($cur_billet, $bdd);
		
		if(count($BILLET) > 2) {
			// Billet valide.
			
			// Si post Editeur
			if(isset($_POST['_edit-text']) && isset($_POST['_edit-sub']) && $User->isAdmin()) {
				$text = trim($_POST['_edit-text']);
				$Edited = $chapEngine->editContent($text, $BILLET[0], $bdd);
				$BILLET['content'] = $text;
			}
			
		}
		
	}
	
} else if ($action == 'delete') {
	
	// Page suppression billet
	
	$ident = null;
	if(isset($arguments[2])) {
		if(is_numeric($arguments[2]) && $arguments[2] > 0) { $ident = $arguments[2]; }
	}
	
	$response = $chapEngine->remove($ident, $bdd, $User);
	
} else if ($action = "creer") {
	
	// Page creation billet
	
	if($User->isAdmin() && isset($_POST['_CreateNum']) && isset($_POST['_CreateTitre']) && isset($_POST['_CreateUrl']) && isset($_POST['_CreateExt']) && isset($_POST['_CreateText'])) {
		$numero = trim(htmlentities($_POST['_CreateNum']));
		$titre = trim($_POST['_CreateTitre']);
		$url = trim(strtolower(htmlentities($_POST['_CreateUrl'])));
		$extrait = trim($_POST['_CreateExt']);
		$content = trim($_POST['_CreateText']);
		if(!is_numeric($numero) || $numero < 1) { $numero = 1; }
		$response = $chapEngine->create($numero, $titre, $url, $extrait, $content, $bdd, $User);
	}
	
}