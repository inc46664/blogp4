<?php
	require_once(ROOT.'public/frac/head.php');
	require_once(ROOT.'public/frac/nav.php');
?>

<div class="page" >
	
	<div class="content type1">
		<h3 class="ttr title titre">Se connecter</h3>	
		<section class="content">
			<?php if(!$PROFILE->isLogged()) { ?>
			<form method="POST" >
				<input class="textbox" name="log-name" type="text" placeholder="Pseudonyme" required="required" />
				<input class="textbox" name="log-pass" type="password" placeholder="Mot de passe" required="required" />
				<input class="sub" name="log-post" type="submit" />
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