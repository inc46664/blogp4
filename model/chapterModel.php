<?php
class ChapterModel extends Model {
	
	function __construct() {
		$this->connectDb();
	}
	
	public function getChapters($count=10) {
		if($count < 0) { $limit=null; } else { $limit=' limit '.$count; }
		$rq = $this->db->prepare('select * from `blog_chapters` order by `date_create` desc '.$limit);
		$rq->execute();
		return $rq->fetchAll();
	}
	
	public function getChapter($ident=0) {
		if($ident > 0 && is_numeric($ident)) {
			$rq = $this->db->prepare('select * from `blog_chapters` where `id`=:ident limit 1');
			$rq->bindParam('ident', $ident, PDO::PARAM_INT);
			$rq->execute();
			$rp = $rq->fetch();
			if($rp[0] != null && $rp[1] != null) {
				return $rp;
			} else { return null; }
		}
	}
	
	public function edit($chapter, $text) {
		$upd = $this->db->prepare('update `blog_chapters` set `texte`=:text where `id`=:chapter limit 1');
		$upd->bindParam(':text', $text, PDO::PARAM_STR);
		$upd->bindParam(':chapter', $chapter, PDO::PARAM_INT);
		$upd->execute();
	}
	
	public function delete($chapter) {
		$del = $this->db->prepare('delete from `blog_chapters` where `id`=:id limit 1');
		$del->bindParam(':id', $chapter, PDO::PARAM_INT);
		$del->execute();
	}
	
	public function create($titre, $content) {
		$ins = $this->db->prepare('insert into `blog_chapters`(titre,texte) VALUES(:ttl,:ctn)');
		$ins->bindParam(':ttl', $titre, PDO::PARAM_STR);
		$ins->bindParam(':ctn', $content, PDO::PARAM_STR);
		$ins->execute();
	}
	
}
