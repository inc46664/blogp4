<?php
class UserModel extends Model {
	
	function __construct() {
		$this->connectDb();
	}
	
	public function getUser($username) {
		$rq = $this->db->prepare('select id,pseudo,admin from `blog_users` where `pseudo` = :user');
		$rq->bindParam(':user', $username, PDO::PARAM_STR);
		$rq->execute();
		$rp = $rq->fetch();
		if($rp[0] != null && $rp[1] != null) {
			$rp['status'] = 'success';
		} else { $rp['status'] = 'error'; }
		return $rp;
	}
	
	public function auth($name=null, $pass=null) {
		$pass = md5($pass);
		$rq = $this->db->prepare('select count(*) as `count` from `blog_users` where `pseudo`=:name and `password`=\''.$pass.'\'');
		$rq->bindParam(':name', $name, PDO::PARAM_STR);
		$rq->execute();
		$rp = $rq->fetch();
		if($rp['count'] == 1) {
			$rp['status'] = 'success';
		} else { $rp['status'] = 'error'; }
		return $rp;
	}
	
	public function exists($name=null) {
		$rq = $this->db->prepare('select count(*) as `count` from `blog_users` where `pseudo`=:name');
		$rq->bindParam(':name', $name, PDO::PARAM_STR);
		$rq->execute();
		$rp = $rq->fetch();
		return $rp;
	}
	
	public function create($name, $pass) {
		$pass = md5($pass);
		$ins = $this->db->prepare('
			insert into
			`blog_users`(pseudo,password)
			values(:name, \''.$pass.'\')
		');
		$ins->bindParam(':name', $name, PDO::PARAM_STR);
		$ins->execute();
	}
	
}
