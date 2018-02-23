<?php
class CommentModel extends Model {
	
	function __construct() {
		$this->connectDb();
	}
	
	public function getCountComments($chapter_id) {
		$rq = $this->db->prepare('
			SELECT count(*)
			AS `count`
			FROM `blog_comments`
			WHERE `chapter` = :cid
			AND `cast` = 1
		');
		$rq->bindParam(':cid', $chapter_id, PDO::PARAM_STR);
		$rq->execute();
		$rp = $rq->fetch();
		return $rp['count'];
	}
	
	public function getComs($chapter_id) {
		$rq = $this->db->prepare('
			SELECT *
			FROM `blog_comments`
			WHERE `chapter` = :cid
			AND `cast` = 1
			ORDER BY `id` DESC
		');
		$rq->bindParam(':cid', $chapter_id, PDO::PARAM_INT);
		$rq->execute();
		return $rq->fetchAll();
	}
	
	public function getCom($com) {
		$rq = $this->db->prepare('
			SELECT *
			FROM `blog_comments`
			WHERE `id` = :com
			LIMIT 1
		');
		$rq->bindParam(':com', $com, PDO::PARAM_INT);
		$rq->execute();
		return $rq->fetch();
	}
	
	public function toModerate() {
		$rq = $this->db->prepare('
			SELECT *
			FROM `blog_comments`
			WHERE `moderated` = 0
			ORDER BY `reports` DESC
		');
		$rq->execute();
		return $rq->fetchAll();
	}
	
	public function valid($com) {
		$update = $this->db->prepare('
			UPDATE `blog_comments`
			SET `moderated` = 1
			WHERE `id` = :com
			LIMIT 1
		');
		$update->bindParam(':com', $com, PDO::PARAM_INT);
		$update->execute();
	}
	public function delete($com) {
		$update = $this->db->prepare('
			UPDATE `blog_comments`
			SET `moderated` = 1, `cast` = 0
			WHERE `id` = :com
			LIMIT 1
		');
		$update->bindParam(':com', $com, PDO::PARAM_INT);
		$update->execute();
	}
	
	public function report($com, $names) {
		$update = $this->db->prepare('
			UPDATE `blog_comments`
			SET `reports` = `reports` + 1, `report_names` = :names
			WHERE `id` = :com
			LIMIT 1
		');
		$update->bindParam(':com', $com, PDO::PARAM_INT);
		$update->bindParam(':names', $names, PDO::PARAM_STR);
		$update->execute();
	}
	
	public function post($text, $chapter_id, $PROFILE) {
		$username = $PROFILE->get('pseudo');
		$ins = $this->db->prepare('
			INSERT INTO
			`blog_comments`(
				chapter,
				pseudo,
				text
			)
			VALUES(
				:cid,
				:user,
				:text
			)
		');
		$ins->bindParam(':cid', $chapter_id, PDO::PARAM_STR);
		$ins->bindParam(':user', $username, PDO::PARAM_STR);
		$ins->bindParam(':text', $text, PDO::PARAM_STR);
		$ins->execute();
	}
	
}
