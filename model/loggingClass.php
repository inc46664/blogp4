<?php
	class Logging {
		public function getSessionByCookie($bdd, $hash) {
			$rqCookie = $bdd->prepare('
				SELECT `user`
				AS `response`
				FROM `blog_logs`
				WHERE `uniqueid` = :unique
				AND `valid` = 1
				AND `cookie` = 1
			');
			$rqCookie->bindParam(':unique', $hash, PDO::PARAM_STR);
			$rqCookie->execute();
			$rpCookie = $rqCookie->fetch();
			if($rpCookie['response'] != null) {
				return $rpCookie['response'];
			} else {
				return 'error';
			}
			$rqCookie->closeCursor();
		}
		
		public function tokenToUser($token, $bdd, $User) {
			$rqUser = $bdd->prepare('
				SELECT id, pseudo, email, uniqueid, ip_inscription, ip_connexion, date_inscription, perm_post, perm_admin
				FROM `blog_users`
				WHERE `uniqueid` = :token
				LIMIT 1
			');
			$rqUser->bindParam(':token', $token, PDO::PARAM_STR);
			$rqUser->execute();
			$rpUser = $rqUser->fetch();
			if($rpUser[0] != null && $rpUser[1] != null && $rpUser[2] != null) {
				$User->setLogged(true);
				$User->set("id", $rpUser[0]);
				$User->set("pseudo", $rpUser[1]);
				$User->set("email", $rpUser[2]);
				$User->set("ip_in", $rpUser[4]);
				$User->set("ip_co", $rpUser[5]);
				$User->set("date_in", $rpUser[6]);
				$User->set("uniqueid", $rpUser[3]);
				$User->set("perm_post", $rpUser[7]);
				if($rpUser[8] == 1) {
					$User->setAdmin(true);
				}
				return "success";
			} else {
				return "error";
			}
			$rqUser->closeCursor();
		}
		
		public function initConnexion($bdd, $User) {
			// On check les cookies
			if(isset($_COOKIE['remuser'])) {
				$sessionCookie = $this->getSessionByCookie($bdd, $_COOKIE['remuser']);
				$_SESSION['user'] = $sessionCookie;
			}
			// On vérifie la session
			if(isset($_SESSION['user'])) {
				$sessionUser = $this->tokenToUser($_SESSION['user'], $bdd, $User);
				if($sessionUser == "error") {
					unset($_SESSION['user']);
				} else {
					// L'utilisateur est connecté
					if($User->isAdmin()) {
						// User est Admin.
					}    
				}
			}
		}
            
            
            public function newToken($token, $rem, $bdd) {
                  
                  $chars = getchars();
                  $uniqueToken = randstr(50, $chars);
                  $remember = 'off';
                  if($rem == 'on') { $remember = 1; }
                  
                  $insert = $bdd->prepare('
                        INSERT INTO
                        `blog_logs`(
                              uniqueid,
                              user,
                              cookie
                        )
                        VALUES(
                              :unique,
                              :user,
                              :cookie
                        )
                  ');
                  $insert->bindParam(':unique', $uniqueToken, PDO::PARAM_STR);
                  $insert->bindParam(':user', $token, PDO::PARAM_STR);
                  $insert->bindParam(':cookie', $remember, PDO::PARAM_INT);
                  $insert->execute();
                  
                  return $uniqueToken;
                  
            }
            
		public function visit($User, $bdd) {
			$username = $User->get('pseudo');
			$rqVisits = $bdd->prepare('
				SELECT count(*)
				AS `count`
				FROM `blog_visits`
				WHERE `ip` = "'.$_SERVER['REMOTE_ADDR'].'"
				AND DATE(`date`) = DATE(NOW())
			');
			$rqVisits->execute();
			$rpVisits = $rqVisits->fetch();
			if($rpVisits['count'] == 0) {
				$insert = $bdd->prepare('
					INSERT INTO
						`blog_visits`(
							ip,
							user
						)
						VALUES(
							\''.$_SERVER['REMOTE_ADDR'].'\',
							:user
						)
					'
				);
				$insert->bindParam(':user', $username, PDO::PARAM_STR);
				$insert->execute();
			} else {
				$update = $bdd->prepare('
					UPDATE `blog_visits`
					SET `counter` = `counter` + 1
					WHERE `ip` = \''.$_SERVER['REMOTE_ADDR'].'\'
					AND DATE(`date`) = DATE(NOW())
					LIMIT 1
				');
				$update->execute();
			}
			$rqVisits->closeCursor();
		}
		
	}
?>