<?php

function js($code) {
	echo '<script type="text/javascript" >'.$code.'</script>';
}

function go($l, $t) {
	echo '<meta http-equiv="refresh" content="'.$t.';URL='.$l.'"/>';
}

function getchars($type="default") {
	switch($type) {
		case 'default':
			return array(
				'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
				'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
				'0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '_'
			);
			break;
	}
}

function info($type='info', $msg=null, $options=array()) {
	?><div class="INFO <?= $type ?>" >
		<p><?= $msg ?></p>
	</div><?php
}

function hasher($str) {
	$sel = array(
		'14S9&o228Danmad6h',
		'trAllesZSq4naaAhqsh4'
	);
	$str = '#'.sha1(md5(sha1($sel[0])).md5(sha1($str)).md5(sha1($sel[1])));
	return $str;
}

function randstr($n, $c) {
	$str = null;
	$i = 0;
	while($i != $n) {
		$r = rand(0,(count($c)-1));
		$str = $str.$c[$r];
		$i++;
	}
	return $str;
}

function dateFr($date, $template='?') {
	$boum = explode(' ', $date);
	$day = explode('-', $boum[0]);
	$hour = explode(':', $boum[1]);
	$template = str_replace('%1%', $day[2], $template);
	$template = str_replace('%2%', $day[1], $template);
	$template = str_replace('%3%', $day[0], $template);
	$template = str_replace('%4%', $hour[0], $template);
	$template = str_replace('%5%', $hour[1], $template);
	$template = str_replace('%6%', $hour[2], $template);
	return $template;
}

function listComments($COMMENTS, $User) {
	
}

function listChapters($CHAPITRES=array(), $User, $bdd, $comsEngine) {
	if(count($CHAPITRES) <= 0) {
		info('error', "Aucun chapitre à afficher");
	} else {
		for($n=0;$n!=count($CHAPITRES);$n++) {
			newBillet($CHAPITRES[$n], $User, $bdd, $comsEngine);
		}
	}
}

function newBillet($Chapitre, $User, $bdd, $comsEngine) {
	if(($Chapitre['broadcast'] == 0 && $User->isAdmin()) || $Chapitre['broadcast'] == 1) {
		?>
		<article class="Billet<?php if($Chapitre['broadcast'] == 0) { echo ' hidden'; } ?>" >
			<section class="left" >
				<h4><a href="<?= WEBROOT.'chapitres/lire/'.$Chapitre['url'] ?>" title="Lire ce chapitre" ><?= $Chapitre['titre'] ?></a></h4>
				<span class="date" title="Date de publication" ><i class="fa fa-clock-o" aria-hidden="true"></i> <?= dateFr($Chapitre['date_create'], 'Le %1%/%2%/%3% à %4%h'); ?></span>
				<span class="comments" title="Commentaires" ><i class="fa fa-comment-o" aria-hidden="true"></i> <?= $comsEngine->getCountComments($Chapitre['id'], $bdd); ?> commentaires</span>
				<?php if($User->isAdmin()) { ?>
				<span class="status" ><?php if($Chapitre['broadcast'] == 0) { echo '<i class="fa fa-eye-slash" aria-hidden="true"></i> Chapitre caché'; } else { echo '<i class="fa fa-eye" aria-hidden="true"></i> Chapitre publié'; } ?></span>
				<a class="admin-button small" href="<?= WEBROOT.'chapitres/lire/'.$Chapitre['url'].'/edit/'; ?>" ><i class="fa fa-pencil" aria-hidden="true"></i> Editer</a>
				<a class="admin-button small" href="<?= WEBROOT.'chapitres/delete/'.$Chapitre[0].'/'; ?>" ><i class="fa fa-trash" aria-hidden="true"></i> Supprimer</a>
				<?php } ?>
			</section>
			<section class="right" >
				<span class="ext" >Extrait:</span>
				<p class="part" ><?= nl2br($Chapitre['extrait']); ?> <a href="<?= WEBROOT.'chapitres/lire/'.$Chapitre['url']; ?>" class="more" >Lire la suite</a></p>
			</section>
		</article>
		<?php
	}
}