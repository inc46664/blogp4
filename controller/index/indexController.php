<?php
$conf = array(
	'pageid' => 1,
	'title' => 'Accueil',
	'desc' => 'tous les chapitres'
);

$chapters = $chapterModel->getchapters(-1);
for($n=0; $n!=count($chapters); $n++) {
	$chapters[$n]['msgcount'] = $commentModel->getCountComments($chapters[$n]['id']);
}
