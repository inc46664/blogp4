<?php
	require_once(ROOT.'public/frac/head.php');
	require_once(ROOT.'public/frac/nav.php');
	// Check des données
	if(!isset($CHAPITRES)) { $CHAPITRES = array(); }
?>

<div class="page" >
	<div class="content type1" >
		<h3 class="ttr title titre" >Chapitres</h3>
		
		<?php if($User->isAdmin()) { ?>
		<section class="content nomargin" >
			<div class="adminpane" >
				<a href="<?= WEBROOT.'chapitres/creer' ?>" class="admin-button medium" ><i class="fa fa-plus" aria-hidden="true"></i> Ajouter un chapitre</a>
			</div>
		</section>
		<?php } ?>
		
		<section class="content" >
			<?php listChapters($CHAPITRES, $User, $bdd, $comsEngine); ?>
		</section>
		
	</div>
	
</div>

<?php
	require_once(ROOT.'public/frac/foot.php');
?>