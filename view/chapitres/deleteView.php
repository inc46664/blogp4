<?php
	require_once(ROOT.'public/frac/head.php');
	require_once(ROOT.'public/frac/nav.php');
	// Check des données
	if(!isset($ident)) { $ident = null; }
	if(!isset($response)) { $response = 'erreur'; }
?>

<div class="page" >
	<div class="content type1" >
		<h3 class="ttr title titre" >Supprimer un Chapitre</h3>
		<section class="content" >
			
			<?php
			info('info', $response);
			go(WEBROOT.'chapitres/', 2);
			?>
			
		</section>
	</div>
	
</div>

<?php
	require_once(ROOT.'public/frac/foot.php');
?>