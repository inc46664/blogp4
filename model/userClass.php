<?php
class User {
	
	public $logged = false;
	public $admin = false;
	public $userinfo = array(
		'id' => 0,
		'pseudo' => "",
		'email' => "",
		'ip_in' => "",
		'ip_co' => "",
		'date_in' => "",
		'uniqueid' => "",
		'perm_post' => ""
	);
	
	public function isLogged() {
		return $this->logged;
	}
	
	public function isAdmin() {
		return $this->admin;
	}
	
	public function setAdmin($boolean) {
		if(is_bool($boolean)) {
			$this->admin = $boolean;
		}
	}
	
	public function setLogged($boolean) {
		if(is_bool($boolean)) {
			$this->logged = $boolean;
		}
	}
	
	public function set($needle, $value) {
		if(isset($this->userinfo[$needle])) {
			$this->userinfo[$needle] = $value;
		}
	}
	
	public function get($needle) {
		if(isset($this->userinfo[$needle])) {
			return $this->userinfo[$needle];
		} else {
			return null;
		}
	}
	
	public function logout() {
		$_SESSION['user'] = 'lawl';
		setcookie('remuser', '', time()-1000, '/');
		$this->setLogged(false);
		$this->setAdmin(false);
	}
	
}