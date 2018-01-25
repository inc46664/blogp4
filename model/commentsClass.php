<?php
class commentsModel extends Model {
	
	public function getCountComments($id, $bdd) {
		
		$rqCount = $bdd->prepare('
			SELECT count(*)
			AS `count`
			FROM `blog_comments`
			WHERE `billet` = :id
		');
		$rqCount->bindParam(':id', $id, PDO::PARAM_INT);
		$rqCount->execute();
		$rpCount = $rqCount->fetch();
		$rqCount->closeCursor();
		return $rpCount['count'];
		
	}
	
	public function getComments($id, $bdd) {
		$get = $bdd->prepare('
			SELECT *
			FROM `blog_comments`
			WHERE `billet` = :id
			ORDER BY `date_post` DESC
		');
		$get->bindParam(':id', $id, PDO::PARAM_STR);
		$get->execute();
		$comments = $get->fetchAll();
		$get->closeCursor();
		return $comments;
	}
	
	public function getCheckComments($User, $bdd) {
		$req = $bdd->prepare('
			SELECT *
			FROM `blog_comments`
			WHERE `checked` = 0
			ORDER BY `reports` DESC
			LIMIT 100
		');
		$req->execute();
		$Comments = $req->fetchAll();
		$req->closeCursor();
		return $Comments;
	}
	
	public function write($billet, $text, $User, $bdd) {
		$text = trim(htmlspecialchars($text));
		$unique = md5(sha1($text).sha1(time()));
		$username = $User->get('pseudo');
		$insert = $bdd->prepare('
			INSERT INTO
			`blog_comments`(
				billet,
				pseudo,
				`content`,
				ip_post,
				uniqueid
			)
			VALUES(
				:bil,
				:me,
				:text,
				\''.$_SERVER['REMOTE_ADDR'].'\',
				:unique
			)
		');
		$insert->bindParam(':bil', $billet, PDO::PARAM_INT);
		$insert->bindParam(':me', $username, PDO::PARAM_STR);
		$insert->bindParam(':text', $text, PDO::PARAM_STR);
		$insert->bindParam(':unique', $unique, PDO::PARAM_STR);
		$insert->execute();
		return $unique;
	}
	
	public function remove($comid, $User, $bdd) {
		$username = $User->get('pseudo');
		$remove = $bdd->prepare('
			DELETE
			FROM `blog_comments`
			WHERE `id` = :id
			AND `pseudo` = :me
			LIMIT 1
		');
		$remove->bindParam(':id', $comid, PDO::PARAM_INT);
		$remove->bindParam(':me', $username, PDO::PARAM_STR);
		$remove->execute();
	}
	
	public function report($comid, $User, $bdd) {
		$username = $User->get('pseudo');
		$getComment = $bdd->prepare('
			SELECT *
			FROM `blog_comments`
			WHERE `id` = :id
			AND `pseudo` != :me
			LIMIT 1
		');
		$getComment->bindParam(':id', $comid, PDO::PARAM_INT);
		$getComment->bindParam(':me', $username, PDO::PARAM_STR);
		$getComment->execute();
		$Comment = $getComment->fetch();
		if($Comment[0] != null && $Comment[1] != null && $Comment[2] != null) {
			$report = strtolower($Comment['users_report']);
			if(preg_match('#!'.strtolower($username).'!#', $report) == true) {
				// Déjà report
			} else {
				$newreport = $report.'!'.strtolower($username).'!';
				$update = $bdd->prepare('
					UPDATE `blog_comments`
					SET `users_report` = :newreport,
					`reports` = reports + 1
					WHERE `id` = :id
					LIMIT 1
				');
				$update->bindParam(':newreport', $newreport, PDO::PARAM_STR);
				$update->bindParam(':id', $comid, PDO::PARAM_INT);
				$update->execute();
			}
		}
		$getComment->closeCursor();
	}
	
}