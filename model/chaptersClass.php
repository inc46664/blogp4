<?php
class chaptersModel extends Model {
	
	public function getChapters($select='*', $where='', $order='', $limit='', $params=array(), $bdd, $comsEngine) {
		if($where != '') { $where = 'WHERE '.$where; }
		$rqChapters = $bdd->prepare(
			'SELECT * FROM `blog_billets`'
		);
		for($n=0; $n!=count($params);$n++) {
			if($params[$n]['type'] == 'int') {
				$rqChapters->bindParam($params[$n]['ident'], $params[$n]['var'], PDO::PARAM_INT);
			} else {
				$rqChapters->bindParam($params[$n]['ident'], $params[$n]['var'], PDO::PARAM_STR);
			}
		}
		$rqChapters->execute();
		$chapitres = $rqChapters->fetchAll();
		return $chapitres;
	}
	
	public function getChapterByUrl($ident, $bdd) {
		$rqChapter = $bdd->prepare('
			SELECT *
			FROM `blog_billets`
			WHERE `url` = :ident
			LIMIT 1
		');
		$rqChapter->bindParam(':ident', $ident, PDO::PARAM_STR);
		$rqChapter->execute();
		$BILLET = $rqChapter->fetch();
		if($BILLET[0] != null && $BILLET[1] != null && $BILLET[2] != null) {
			return $BILLET;
		} else {
			return array();
		}
		$rqChapter->closeCursor();
	}
	
	public function editContent($text=null, $ident=null, $bdd) {
		if(strlen($text) > 1) {
			$update = $bdd->prepare('
				UPDATE `blog_billets`
				SET `content` = :text
				WHERE `id` = :id
				LIMIT 1
			');
			$update->bindParam(':text', $text, PDO::PARAM_STR);
			$update->bindParam(':id', $ident, PDO::PARAM_INT);
			$update->execute();
			return 'Chapitre modifié avec succès';
		} else {
			return 'Le texte est trop court';
		}
	}
	
	public function remove($ident=0, $bdd, $User) {
		if($User->isAdmin()) {
			$delete = $bdd->prepare('
				DELETE
				FROM `blog_billets`
				WHERE `id` = :id
				
				LIMIT 1
			');
			$delete->bindParam(':id', $ident, PDO::PARAM_INT);
			$delete->execute();
			return 'Chapitre supprimé définitivement';
		} else {
			return 'Vous n\'avez pas la permission';
		}
	}
	
	public function create($numero=1, $titre=null, $url=null, $extrait=null, $content=null, $bdd, $User) {
		if($User->isAdmin()) {
			if($numero && $titre && $url && $extrait && $content) {
				$username = $User->get('pseudo');
				$insert = $bdd->prepare('
					INSERT INTO
					`blog_billets`(
						pseudo,
						num,
						titre,
						url,
						content,
						extrait,
						ip_create
					)
					VALUES(
						:pseudo,
						:num,
						:titre,
						:url,
						:content,
						:extrait,
						\''.$_SERVER['REMOTE_ADDR'].'\'
					)
				');
				$insert->bindParam(':pseudo', $username, PDO::PARAM_STR);
				$insert->bindParam(':num', $numero, PDO::PARAM_INT);
				$insert->bindParam(':titre', $titre, PDO::PARAM_STR);
				$insert->bindParam(':url', $url, PDO::PARAM_STR);
				$insert->bindParam(':content', $content, PDO::PARAM_STR);
				$insert->bindParam(':extrait', $extrait, PDO::PARAM_STR);
				$insert->execute();
				return 'success';
			} else {
				return 'Vous devez compléter tous les champs';
			}
		} else {
			return 'Vous n\'avez pas la permission';
		}
	}
	
}
