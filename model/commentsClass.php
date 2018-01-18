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
	
}