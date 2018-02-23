<nav class="NAV" >
	<section class="nav-head" >
		<h1 class="ttr titre title" ><strong>Billet simple pour l'Alaska</strong></h1>
		<h2 class="ttr titre title" >Jean Forteroche</h2>
		<img class="logo" src="<?= WEBROOT.'public/img/logo.jpg' ?>" alt="logo Jean Forteroche" title="Jean Forteroche" />
	</section>
	<section class="nav-content" >
		<ol class="list" >
			<li><a id="__nav2" class="link <?php if($conf['pageid'] == 1) { echo 'selected'; } ?>" href="<?= WEBROOT ?>" ><i class="fa fa-book" aria-hidden="true"></i> Accueil</a></li>
			<?php if(!$PROFILE->isLogged()) { ?>
			<li><a id="__nav3" class="link <?php if($conf['pageid'] == 2) { echo 'selected'; } ?>" href="<?= WEBROOT.'login/'; ?>" ><i class="fa fa-sign-in" aria-hidden="true"></i> Se connecter</a></li>
			<li><a id="__nav4" class="link <?php if($conf['pageid'] == 3) { echo 'selected'; } ?>" href="<?= WEBROOT.'register/'; ?>" ><i class="fa fa-plus" aria-hidden="true"></i> S'inscrire</a></li>
			<?php } else {
				if($PROFILE->isAdmin()) {
			?>
			<li><a id="__nav6" class="link <?php if($conf['pageid'] == 6) { echo 'selected'; } ?>" href="<?= WEBROOT.'moderation/'; ?>" ><i class="fa fa-user" aria-hidden="true"></i> Modération</a></li><?php } ?>
			<li><a id="__nav5" class="link <?php if($conf['pageid'] == 5) { echo 'selected'; } ?>" href="<?= WEBROOT.'logout/'; ?>" ><i class="fa fa-sign-out" aria-hidden="true"></i> Déconnexion</a></li>
			<?php } ?>
		</ol>
	</section>
	<section class="nav-foot" >
		<p><span>&copy</span> Jean Forteroche</p>
	</section>
</nav>