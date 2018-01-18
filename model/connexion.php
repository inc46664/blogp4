<?php
Class pageModel extends Model {
	
	public function setHead($CONFIG) {
		$CONFIG['head']['title'] = 'Se connecter - '.$CONFIG['global']['name'];
		$CONFIG['head']['desc'] = 'Connectez-vous à votre compte - Billet simple pour l\'Alaska: le roman en ligne de Jean Forteroche. Suivez tous les chapitres sur ce blog !';
		$CONFIG['head']['pageid'] = 2;
		return $CONFIG;
	}
	
	public function sendAuthentification($pseudo=null, $password=null, $remember='off', $bdd, $User, $Logging) {
		if($pseudo && $password) {
			$cpassword = hasher($password);
			$rqAuth = $bdd->prepare('
				SELECT id,pseudo,uniqueid
				FROM `blog_users`
				WHERE `pseudo` = :pseudo
				AND `password` = :password
				LIMIT 1
			');
			$rqAuth->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
			$rqAuth->bindParam(':password', $cpassword, PDO::PARAM_STR);
			$rqAuth->execute();
			$rpAuth = $rqAuth->fetch();
			if($rpAuth[0] != null && $rpAuth[1] != null && $rpAuth[2] != null) {
				$logToken = $Logging->newToken($rpAuth[2], $remember, $bdd);
				$session = array(
					'status' 	=> 'success',
					'cookie' 	=> $remember,
					'pseudo'	=> $rpAuth[1],
					'unique'	=> $rpAuth[2],
					'token'		=> $logToken
				);
				return $session;
			} else {
				return 'Compte introuvable';
			}
			$rqAuth->closeCursor();
		} else {
			return 'Vous devez compléter tous les champs';
		}
	}
	
	public function saveSession($session, $bdd) {
		$_SESSION['user'] = $session['unique'];
		if($session['cookie'] == 'on') {
			setcookie('remuser', $session['token'], time()+60*60*24*365, '/');
		}
	}
	
}