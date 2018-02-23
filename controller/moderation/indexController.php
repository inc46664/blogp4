<?php
$conf = array(
	'pageid' => 6,
	'title' => 'Modération',
	'desc' => 'modérer le forum',
	'tinymce' => true
);
$comments = array();

if($PROFILE->isAdmin()) {
	
	// Comments
	if(isset($arguments[2]) && isset($arguments[3]) && is_numeric($arguments[3])) {
		switch($arguments[2]) {
			case 'v':
			$commentModel->valid($arguments[3]);
			break;
			
			case 'd':
			$commentModel->delete($arguments[3]);
			break;
		}
	}
	$comments = $commentModel->toModerate();
	
	// Del billet
	$billets = $chapterModel->getChapters();
	if(isset($_POST['_dbil-select']) && isset($_POST['_dbil-post'])) {
		$selection = trim(htmlentities(intval($_POST['_dbil-select'])));
		if(is_numeric($selection) && $selection > 0) {
			$chapterModel->delete($selection);
			header('location:'.WEBROOT.'moderation');
		}
	}
	
	// New billet
	if(isset($_POST['_nbil-titre']) && isset($_POST['_nbil-content']) && isset($_POST['_nbil-post'])) {
		$titre = trim($_POST['_nbil-titre']);
		$content = trim($_POST['_nbil-content']);
		if($titre && $content) {
			$chapterModel->create($titre, $content);
			header('location:'.WEBROOT);
		}
	}
	
}