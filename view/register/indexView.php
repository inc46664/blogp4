<?php
	require_once(ROOT.'public/frac/head.php');
	require_once(ROOT.'public/frac/nav.php');
?>

<div class="page" >
	
	<div class="content type1">
		<h3 class="ttr title titre">S'inscrire</h3>	
		<section class="content">
			<?php if(!$PROFILE->isLogged()) { ?>
			<form method="POST" >
				<input class="textbox" name="reg-name" type="text" placeholder="Pseudonyme" required="required" />
				<input class="textbox" name="reg-pass" type="password" placeholder="Mot de passe" required="required" />
				<input class="textbox" name="reg-repass" type="password" placeholder="Retaper le mot de passe" required="required" />
				<input class="sub" name="reg-post" type="submit" value="Créer le compte" />
			</form>
			<?php } else {
				info('error', 'Vous êtes déjà connecté');
			} ?>
		</section>
	</div>
	
</div>

<?php
	require_once(ROOT.'public/frac/foot.php');
?>