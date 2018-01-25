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

function listComments($COMMENTS=array(), $Billet, $User) {
	for($n=0;$n!=count($COMMENTS);$n++) {
		
		$Com = $COMMENTS[$n];
		
		if($Com['cast'] == 1) { ?>
		
		<article class="Comment" id="com_<?php echo $Com['uniqueid']; ?>" >
			<?php if($User->isAdmin()) { ?>
			<span class="report <?php if($Com['reports'] >= 10) { echo 'high'; } elseif($Com['reports'] >= 5) { echo 'med'; } else { echo 'low'; } ?>" title="Reports" >
				<p><span><?php echo $Com['reports']; ?></span></p>
			</span>
			<?php } ?>
			<div class="msg-head" >
				<span class="user" ><?php echo $Com['pseudo']; ?></span>
				<span class="date" ><?php echo dateFr($Com['date_post'], 'Le %1%/%2%/%3% à %4%h%5%'); ?></span>
				<?php if($User->isLogged()) {
					if(strtolower($Com['pseudo']) != strtolower($User->get('pseudo'))) { ?>
					<span class="act" >
						<?php if(!preg_match('#!'.strtolower($User->get('pseudo')).'!#', $Com['users_report'])) { ?>
							<a class="report" href="<?php echo WEBROOT.'chapitres/lire/'.$Billet['url'].'/report/'.$Com[0]; ?>" title="Signaler un mauvais commentaire" ><i class="fa fa-flag" aria-hidden="true"></i></a>
						<?php } else { ?>
							<a class="report used" href="#" title="Vous avez déjà signalé ce commentaire" ><i class="fa fa-flag" aria-hidden="true"></i></a>
						<?php } ?>
					</span>
					<?php } else { ?>
					<span class="act" >
						<a class="remove" href="<?php echo WEBROOT.'chapitres/lire/'.$Billet['url'].'/remove/'.$Com[0]; ?>" title="Supprimer le commentaire" ><i class="fa fa-times" aria-hidden="true"></i></a>
					</span>
					<?php }
				} ?>
			</div>
			<div class="msg-body" >
				<p><?php echo nl2br(trim(htmlspecialchars($Com['content']))); ?></p>
			</div>
		</article>
		
		<?php }
	}
}

function listCheckComments($Comments, $User) {
	for($n=0;$n!=count($Comments);$n++) {
		$Com = $Comments[$n];
		?>
		<tr id="_manage-<?= $Com[$n] ?>" class="unite" >
			<th><?= $Com['reports'] ?></th>
			<td><?= $Com['pseudo'] ?></td>
			<td><?= htmlspecialchars($Com['content']) ?></td>
			<td><?= datefr($Com['date_post'], '%1%/%2%/%3% à %4%h%5%') ?></td>
			<td>
				<a onClick="toggleComment('allow', <?= $Com['id'] ?>, '<?= WEBROOT ?>');" >Valider</a>
				<a onClick="toggleComment('deny', <?= $Com['id'] ?>, '<?= WEBROOT ?>');" >Supprimer</a>
			</td>
		</tr>
	<?php }
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