<?php
$conf = array(
	'pageid' => 0,
	'title' => 'Editer un chapitre',
	'desc' => 'editer un chapitre',
	'tinymce' => true
);
if($PROFILE->isAdmin()) {
	$chapter_valid = false;
	$chapter_id = $chapter = null;
	$chapter_name = 'Modifier un chapitre';
	if(isset($arguments[2])) {
		$chapter_id = explode('-', $arguments[2])[0];
		$chapter = $chapterModel->getChapter($chapter_id);
		if($chapter != null && is_array($chapter)) {
			$chapter_valid = true;
			$chapter_name = $chapter['titre'];
			
			if(isset($_POST['edit-text']) && isset($_POST['edit-post'])) {
				$text = $_POST['edit-text'];
				$chapterModel->edit($chapter_id, $text);
				header('location:'.WEBROOT.'chapitres/lire/'.$chapter['id'].'-'.textToUrl($chapter['titre']));
			}
			
		}
	}
} else {
	header('location:'.WEBROOT);
}
