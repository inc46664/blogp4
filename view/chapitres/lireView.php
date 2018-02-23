<?php
	require_once(ROOT.'public/frac/head.php');
	require_once(ROOT.'public/frac/nav.php');
?>

<div class="page" >
	
	<div class="content type1">
		<h3 class="ttr title titre"><?= $chapter_name; ?></h3>	
		<section class="content">
			<?php if($chapter_valid === true) { ?>
			<div class="bil-head" >
				<p>Ajouté le <?= datefr($chapter['date_create'], '%1%/%2%/%3%') ?></p>
				<p>Dernière mise à jour le <?= datefr($chapter['date_edit'], '%1%/%2%/%3% à %4%h%5%') ?></p>
				<?php if($PROFILE->isAdmin()) { ?>
				<a class="admin-button" href="<?= WEBROOT.'chapitres/edit/'.$chapter['id'].'-'.textToUrl($chapter['titre']) ?>" rel="nofollow" >Modifier</a>
				<?php } ?>
			</div>
			<div class="bil-body" >
				<p><?= $chapter['texte'] ?></p>
			</div>
			<div class="comments" id="coms" >
				<h4>Commentaires</h4>
				<?php
				if($PROFILE->isLogged()) { ?>
				<article class="Comment" >
					<span class="username" >> <?= htmlentities($PROFILE->get('pseudo')) ?></span>
					<form method="POST" spellcheck="true" >
						<textarea name="_ncom-text" required="required" placeholder="Message..." ></textarea>
						<input type="submit" name="_ncom-post" value="Envoyer" />
					</form>
				</article>
				<?php }
				for($n=0;$n!=count($comments); $n++) { ?>
				<article class="Comment" >
					<span class="username" >> <?= htmlentities($comments[$n]['pseudo']) ?><?php
					if(strtolower($comments[$n]['pseudo']) != strtolower($PROFILE->get('pseudo')) && $PROFILE->isLogged() && $comments[$n]['moderated'] == 0 && !contains('-'.strtolower($PROFILE->get('pseudo')).'-', $comments[$n]['report_names'])) { ?>
						<a class="report" href="<?= WEBROOT.'chapitres/lire/'.$chapter['id'].'-'.textToUrl($chapter['titre']).'/r/'.$comments[$n]['id'] ?>" >Report</a>
					<?php }
					?></span>
					<p class="content" ><?= nl2br($comments[$n]['text']); ?></p>
				</article>
				<?php } ?>
			</div>
			<?php } else {
				info('error', 'Chapitre inconnu.');
			} ?>
		</section>
	</div>
	
</div>

<?php
	require_once(ROOT.'public/frac/foot.php');
?>