<?php
	require_once(ROOT.'public/frac/head.php');
	require_once(ROOT.'public/frac/nav.php');
	// Check des données
	if(!isset($CHAPITRES)) { $CHAPITRES = array(); }
	if($User->isAdmin()) {
?>

<div class="page" >
	<div class="content type1" >
		<h3 class="ttr title titre" >Nouveau Chapitre</h3>
		
		<section class="content" >
			<form method="POST" >
				<fieldset>
					<label>Numéro du chapitre</label>
					<input name="_CreateNum" class="textbox" type="text" placeholder="10" required="required" />
				</fieldset>
				
				<fieldset>
					<label>Titre du chapitre</label>
					<input name="_CreateTitre" class="textbox" type="text" placeholder="Chapitre 10: Lorem ipsum" required="required" />
				</fieldset>
				
				<fieldset>
					<label>Extrait du chapitre</label>
					<input name="_CreateExt" class="textbox" type="text" required="required" />
				</fieldset>
				
				<textarea class="tinymce" name="_CreateText" id="_tarea" ></textarea>
				
				<?php if(isset($response)) {
					if($response == 'success') {
						// go(WEBROOT.'chapitres/', 0);
						info('info', 'Chapitre ajouté');
					} else {
						info('error', $response);
					}
				} ?>
				<input type="submit" class="sub" name="_create-sub" value="Créer" />
			</form>
		</section>
		
	</div>
	
</div>

<?php
	} else {
		go(WEBROOT, 0);
	}
	require_once(ROOT.'public/frac/foot.php');
?>