<?php
	require_once(ROOT.'public/frac/head.php');
	require_once(ROOT.'public/frac/nav.php');
	// Check des données
	if(!isset($LOGGED)) { $LOGGED = false; }
?>

<div class="page" >
	<div class="content type1" >
		<?php if($User->isLogged() === false) { ?>
		<h3 class="ttr title titre" >Connexion</h3>
		<section class="content" >
		
			<?php if($LOGGED === false) {
				
				if(isset($response)) {
					if(!is_array($response)) {
						info('info', $response);
					}
				}
				
				?>
			
			<form method="POST" id="form_Login" >
                  <fieldset>
                        <label>Pseudonyme</label>
                        <input name="_LogPseudo" class="textbox" maxlength=20 type="text" required="required" />
                  </fieldset>
                  
                  <fieldset>
                        <label>Mot de passe</label>
                        <input name="_LogPassword" class="textbox" type="password" required="required" />
                  </fieldset>
                  
                  <fieldset>
                        <input name="_LogRem" id="__LogRem" class="checkbox" type="checkbox" />
                        <label class="for" for="__LogRem" >Se souvenir de moi</label>
                  </fieldset>
                  
                  <fieldset>
                        <i class="fa fa-check" aria-hidden="true"></i>
                        <input name="_LogSub" class="sub" type="submit" value="Continuer" />
                  </fieldset>
            </form>
			
			<?php } else {
				
				info('info', 'Vous êtes connecté !');
				// go(WEBROOT, 2);
				
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