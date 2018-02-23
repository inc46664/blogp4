<?php
	if($PROFILE->isAdmin()) {
	require_once(ROOT.'public/frac/head.php');
	require_once(ROOT.'public/frac/nav.php');
?>

<div class="page" >
	
	<div class="content type1">
		<h3 class="ttr title titre">Editer: <?= $chapter_name; ?></h3>	
		<section class="content">
			<div class="bil-body" >
				<form method="POST" >
					<textarea name="edit-text" id="_tarea" ><?= $chapter['texte'] ?></textarea>
					<input name="edit-post" type="submit" class="sub" value="Enregistrer" />
				</form>
			</div>
		</section>
	</div>
	
</div>

<?php
	require_once(ROOT.'public/frac/foot.php');
	}
?>