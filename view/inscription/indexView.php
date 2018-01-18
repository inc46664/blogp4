<?php
	require_once(ROOT.'public/frac/head.php');
	require_once(ROOT.'public/frac/nav.php');
	// Check des données
	if(!isset($REGISTERED)) { $REGISTERED = false; }
?>

<div class="page" >
	<div class="content type1" >
		<?php if($User->isLogged() === false) { ?>
		<h3 class="ttr title titre" >Inscription</h3>
		<section class="content" >
		
			<?php if($REGISTERED === false) { ?>
			
			<form method="POST" id="form_Register" >
				<fieldset>
					<label>Pseudonyme</label>
					<input name="_RegPseudo" class="textbox" maxlength=20 type="text" required="required" />
				</fieldset>
					
				<fieldset>
					<label>Adresse email</label>
					<input name="_RegEmail" class="textbox" type="text" required="required" />
				</fieldset>
					
				<fieldset>
					<label>Mot de passe</label>
					<input name="_RegPassword" class="textbox" type="password" required="required" />
				</fieldset>
					
				<fieldset>
					<label>Répéter le mot de passe</label>
					<input name="_RegRePassword" class="textbox" type="password" required="required" />
				</fieldset>
					
				<fieldset>
					<i class="fa fa-check" aria-hidden="true"></i>
					<input name="_RegSub" class="sub" type="submit" value="Continuer" />
				</fieldset>
			</form>
			
			<?php } else {
				
				info('info', 'Compté créé avec succès! Redirection...');
				go(WEBROOT.'connexion/', 3);
				
			} ?>
			
		</section>
		<?php } else {
			info('error', "Vous êtes déjà connecté");
		} ?>
	</div>
	
</div>

<?php
	require_once(ROOT.'public/frac/foot.php');
?>