<?php
if($action == 'index') {
	
	// Index page
	$REGISTERED = false;
	if($User->isLogged() === false) {
		
		if(isset($_POST['_RegPseudo']) || isset($_POST['_RegEmail']) || isset($_POST['_RegPassword']) ||isset($_POST['_RegRePassword']) || isset($_POST['_RegSub'])) {
			
			$regPseudo = trim(htmlspecialchars(htmlentities($_POST['_RegPseudo'])));
			$regEmail = trim(htmlspecialchars($_POST['_RegEmail']));
			$regPassword = trim($_POST['_RegPassword']);
			$regRePassword = trim($_POST['_RegRePassword']);
			
			$response = $pageModel->sendRegistration($regPseudo, $regEmail, $regPassword, $regRePassword, $bdd, $User);
			if($response == 'success') { $REGISTERED = true; }
			
		}
		
	}
	
}