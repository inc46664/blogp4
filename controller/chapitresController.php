<?php
if($action == 'index') {
	
	// Index page
	$CHAPITRES = $chapEngine->getChapters('*', '`broadcast` = 1', 'order by `num` DESC', null, array(), $bdd, $comsEngine);
	
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
		// Editer le billet
		if(strtolower($arguments[3]) == 'edit' && $User->isAdmin()) {
			$EditMode = true;
		}
		// Supprimer un commentaire
		else if (strtolower($arguments[3]) == 'remove' && isset($arguments[4])) {
			$remove_id = $arguments[4];
			if(is_numeric($remove_id) && $remove_id > 0) {
				$comsEngine->remove($remove_id, $User, $bdd);
			}
		}
		// Signaler un commentaire
		else if (strtolower($arguments[3]) == 'report' && isset($arguments[4])) {
			$report_id = $arguments[4];
			if(is_numeric($report_id) && $report_id > 0) {
				$comsEngine->report($report_id, $User, $bdd);
			}
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
			
			// Si post newcom
			if(isset($_POST['write_text']) && isset($_POST['write_post']) && $User->isLogged()) {
				$text = $_POST['write_text'];
				if($text != null || strlen($text) > 1) {
					$response_postcom = $comsEngine->write($BILLET[0], $text, $User, $bdd);
				}
			}
			
			// Commentaires
			$COMMENTS = $comsEngine->getComments($BILLET[0], $bdd);
			
			if(isset($response_postcom)) { go('#com_'.$response_postcom, 0); }
			
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
	
	if($User->isAdmin() && isset($_POST['_CreateNum']) && isset($_POST['_CreateTitre']) && isset($_POST['_CreateExt']) && isset($_POST['_CreateText'])) {
		$numero = trim(htmlentities($_POST['_CreateNum']));
		$titre = trim($_POST['_CreateTitre']);
		$extrait = trim($_POST['_CreateExt']);
		$content = trim($_POST['_CreateText']);
		if(!is_numeric($numero) || $numero < 1) { $numero = 1; }
		$response = $chapEngine->create($numero, $titre, $extrait, $content, $bdd, $User);
	}
	
}