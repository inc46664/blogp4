<?php if(isset($CONFIG)) { ?>

<nav class="NAV" >
	<section class="nav-head" >
		<h1 class="ttr titre title" ><strong><?= $CONFIG['global']['name'] ?></strong></h1>
		<h2 class="ttr titre title" ><?= $CONFIG['global']['subname'] ?></h2>
		<img class="logo" src="<?= $Model->getLogo(); ?>" alt="logo Jean Forteroche" title="Jean Forteroche" />
		<div class="social" >
			<a title="Page facebook" class="facebook link" href="#" target="_blank" ><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
			<a title="Page twitter" class="twitter link" href="#" target="_blank" ><i class="fa fa-twitter" aria-hidden="true"></i></a>
		</div>
	</section>
	<?php if(!$User->isLogged()) { ?>
	<section class="nav-content" >
		<ol class="list" >
			<li><a id="__nav2" class="link<?php if($CONFIG['head']['pageid'] == 1) { echo ' selected'; } ?>" href="<?php echo WEBROOT.'chapitres/'; ?>" ><i class="fa fa-book" aria-hidden="true"></i> Chapitres</a></li>
			<li><a id="__nav3" class="link<?php if($CONFIG['head']['pageid'] == 2) { echo ' selected'; } ?>" href="<?php echo WEBROOT.'connexion/'; ?>" ><i class="fa fa-sign-in" aria-hidden="true"></i> Se connecter</a></li>
			<li><a id="__nav4" class="link<?php if($CONFIG['head']['pageid'] == 3) { echo ' selected'; } ?>" href="<?php echo WEBROOT.'inscription/'; ?>" ><i class="fa fa-plus" aria-hidden="true"></i> S'inscrire</a></li>
		</ol>
	</section>
	<?php } else { ?>
	<section class="nav-content" >
		<ol class="list" >
			<li><a id="__nav2" class="link<?php if($CONFIG['head']['pageid'] == 1) { echo ' selected'; } ?>" href="<?php echo WEBROOT.'chapitres/'; ?>" ><i class="fa fa-book" aria-hidden="true"></i> Chapitres</a></li>
			<li><a id="__nav5" class="link<?php if($CONFIG['head']['pageid'] == 4) { echo ' selected'; } ?>" href="<?php echo WEBROOT.'profil/'; ?>" ><i class="fa fa-user" aria-hidden="true"></i> <?= $User->get('pseudo') ?></a></li>
			<?php if($User->isAdmin()) { ?><li><a id="__nav7" class="link<?php if($CONFIG['head']['pageid'] == 6) { echo ' selected'; } ?>" href="<?php echo WEBROOT.'manager/'; ?>" ><i class="fa fa-users" aria-hidden="true"></i> Manager</a></li><?php } ?>
			<li><a id="__nav6" class="link<?php if($CONFIG['head']['pageid'] == 5) { echo ' selected'; } ?>" href="<?php echo WEBROOT.'profil/logout/'; ?>" ><i class="fa fa-sign-out" aria-hidden="true"></i> Déconnexion</a></li>
		</ol>
	</section>
	<?php } ?>
	<section class="nav-foot" >
		<p><span>&copy</span> Jean Forteroche</p>
	</section>
</nav>

<?php } ?>