<?php
	require_once(ROOT.'public/frac/head.php');
	require_once(ROOT.'public/frac/nav.php');
	
	if($User->isLogged()) {
		
		$User->logout();
		go(WEBROOT, 0);
		
?>

<div class="page" >
	<div class="content type1" >
		<h3 class="ttr title titre" >Déconnection</h3>
		<section class="content" >
			
			
			
		</section>
	</div>
	
</div>

<?php
	
	
	} else {
		go(WEBROOT, 0);
	}
	
	require_once(ROOT.'public/frac/foot.php');
?>