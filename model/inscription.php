<?php
Class pageModel extends Model {
	
	public function setHead($CONFIG) {
		$CONFIG['head']['title'] = 'S\'Inscrire - '.$CONFIG['global']['name'];
		$CONFIG['head']['desc'] = 'Créez votre compte gratuitement - Billet simple pour l\'Alaska: le roman en ligne de Jean Forteroche. Suivez tous les chapitres sur ce blog !';
		$CONFIG['head']['pageid'] = 3;
		return $CONFIG;
	}
	
	public function sendRegistration($pseudo=null, $email=null, $password=null, $repassword=null, $bdd, $User) {
		if($pseudo && $email && $password && $repassword) {
			if(strlen($pseudo) <= 20 && strlen($pseudo) >= 4) {
				if(ctype_alnum($pseudo)) {
					if(preg_match("#@#", $email) && preg_match("#.#", $email) && strlen($email) >= 10) {
						if(strlen($password) >= 6) {
							if($password == $repassword && hasher($password) == hasher($repassword)) {
								$rqPseudo = $bdd->prepare('
									SELECT count(*)
									AS `count`
									FROM `blog_users`
									WHERE `pseudo` = :pseudo
								');
								$rqPseudo->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
								$rqPseudo->execute();
								$rpPseudo = $rqPseudo->fetch();
								if($rpPseudo['count'] == 0) {
									$rqEmail = $bdd->prepare('
										SELECT count(*)
										AS `count`
										FROM `blog_users`
										WHERE `email` = :email
									');
									$rqEmail->bindParam(':email', $email, PDO::PARAM_STR);
									$rqEmail->execute();
									$rpEmail = $rqEmail->fetch();
									if($rpEmail['count'] == 0) {
										
										// Insertion
										try {
											
											$allowed_chars = getchars();
											$insert = $bdd->prepare('
												INSERT INTO
												`blog_users`(
													pseudo,
													email,
													password,
													uniqueid,
													ip_inscription,
													ip_connexion
												) VALUES(
													:pseudo,
													:email,
													\''.hasher($password).'\',
													\''.md5(randstr(50, $allowed_chars)).md5(hasher($password)).md5(hasher($pseudo)).'\',
													\''.$_SERVER['REMOTE_ADDR'].'\',
													\''.$_SERVER['REMOTE_ADDR'].'\'
												)
											');
											$insert->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
											$insert->bindParam(':email', $email, PDO::PARAM_STR);
											$insert->execute();
											
											return 'success';
											
										} catch (Exception $e) {
											return 'Erreur';
										}
										
									} else {
										return 'Cette adresse email est déjà utilisée';
									}
									$rqEmail->bindParam();
								} else {
									return 'Ce pseudonyme est déjà utilisé';
								}
								$rqPseudo->bindParam();
							} else {
								return 'Les mots de passe ne correspondent pas';
							}
						} else {
							return 'Mot de passe trop court (minimum 6 caractères)';
						}
					} else {
						return 'Adresse email invalide';
					}
				} else {
					return 'Votre pseudonyme contient des caractères interdits';
				}
			} else {
				return 'Votre pseudonyme doit faire entre 4 et 20 caractères';
			}
		} else {
			return 'Vous devez compléter tous les champs';
		}
	}
	
}