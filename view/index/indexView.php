<?php
	require_once(ROOT.'public/frac/head.php');
	require_once(ROOT.'public/frac/nav.php');
?>

<div class="page" >
	
	<div class="content type1">
		<h3 class="ttr title titre">Chapitres</h3>	
		<section class="content">
		<?php foreach($chapters as $chapter) { ?>
			<article class="Billet" >
				<h4><a href="<?= WEBROOT.'chapitres/lire/'.$chapter['id'].'-'.textToUrl($chapter['titre']) ?>" title="Lire ce chapitre" ><?= $chapter['titre'] ?></a></h4>
				<span class="date" title="Date de publication" ><i class="fa fa-clock-o" aria-hidden="true"></i> <?= dateFr($chapter['date_create'], 'Le %1%/%2%/%3% à %4%h'); ?></span>
				<span class="comments" title="Commentaires" ><i class="fa fa-comment-o" aria-hidden="true"></i> <?= $chapter['msgcount'] ?> commentaires</span>
			</article>
		<?php } ?>
		</section>
	</div>
	
</div>

<?php
	require_once(ROOT.'public/frac/foot.php');
?>