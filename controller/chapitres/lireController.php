<?php
$conf = array(
	'pageid' => 0,
	'title' => 'Chapitre',
	'desc' => 'lire un chapitre'
);

$chapter_valid = false;
$chapter_id = $chapter = null;
$chapter_name = 'Recherche d\'un chapitre';
if(isset($arguments[2])) {
	$chapter_id = explode('-', $arguments[2])[0];
	$chapter = $chapterModel->getChapter($chapter_id);
	if($chapter != null && is_array($chapter)) {
		$chapter_valid = true;
		$chapter_name = $chapter['titre'];
	}
	if(isset($arguments[3]) && $arguments[3] == 'r' && isset($arguments[4]) && is_numeric($arguments[4]) && $PROFILE->isLogged()) {
		$getcom = $commentModel->getCom(intval($arguments[4]));
		if($getcom[0] != null && $getcom['pseudo'] != null) {
			if(strtolower($getcom['pseudo']) != strtolower($PROFILE->get('pseudo'))) {
				if(contains('-'.strtolower($PROFILE->get('pseudo')).'-', $getcom['report_names']) === false) {
					$names = $getcom['report_names'].'-'.strtolower($PROFILE->get('pseudo')).'-';
					$commentModel->report(intval($arguments[4]), $names);
				}
			}
		}
	}
	if(isset($_POST['_ncom-post']) && isset($_POST['_ncom-text']) && $PROFILE->isLogged()) {
		$post_text = trim($_POST['_ncom-text']);
		if(strlen($post_text) > 1) {
			$commentModel->post($post_text, $chapter_id, $PROFILE);
			header('location:'.WEBROOT.'chapitres/lire/'.$chapter['id'].'-'.textToUrl($chapter['titre']).'#coms');
		}
	}
	$comments = $commentModel->getComs($chapter_id);
}
