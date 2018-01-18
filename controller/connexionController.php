<?php
if($action == 'index') {
	
	// Index page
	$LOGGED = false;
	if($User->isLogged() === false) {
		
		if(isset($_POST['_LogPseudo']) || isset($_POST['_LogPassword'])) {
			
			$logPseudo = trim(htmlspecialchars(htmlentities($_POST['_LogPseudo'])));
			$logEmail = trim(htmlspecialchars($_POST['_LogPassword']));
			$remember = 'off';
			
			if(isset($_POST['_LogRem'])) {
				$remember = trim($_POST['_LogRem']);
			}
			
			$response = $pageModel->sendAuthentification($logPseudo, $logEmail, $remember, $bdd, $User, $Logging);
			if(is_array($response)) {
				if($response['status'] == 'success') {
					$LOGGED = true;
					$pageModel->saveSession($response, $bdd);
				}
			}
			
		}
		
	}
	
}