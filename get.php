<?php
session_start();
define('WEBROOT', str_replace('get.php', null, $_SERVER['SCRIPT_NAME']));
define('ROOT', str_replace('get.php', null, $_SERVER['SCRIPT_FILENAME']));

require_once(ROOT.'public/inc/db.php');
require_once(ROOT.'public/inc/config.php');

require_once(ROOT.'model/model.php');
require_once(ROOT.'model/userClass.php');
require_once(ROOT.'model/loggingClass.php');
require_once(ROOT.'model/commentsClass.php');
require_once(ROOT.'model/chaptersClass.php');
require_once(ROOT.'public/inc/functions.php');
require_once(ROOT.'controller/controller.php');

$Model = new Model;
$Controller = new Controller;
$Logging = new Logging;
$User = new User;

$Logging->initConnexion($bdd, $User);

$status = 'error';

if(isset($_POST['type']) && isset($_POST['comid']) && $User->isAdmin()) {
	
	$type = $_POST['type'];
	$comid = $_POST['comid'];
	if($type != 'allow' && $type != 'deny') {
		$type = 'deny';
	}
	if(is_numeric($comid) && $comid > 0) {
		
		if($type == 'allow') {
			
			$update = $bdd->prepare('
				UPDATE `blog_comments`
				SET `checked` = 1
				WHERE `id` = :id
				LIMIT 1
			');
			$update->bindParam(':id', $comid, PDO::PARAM_INT);
			$update->execute();
			$status = 'success';
			
		} else {
			
			$delete = $bdd->prepare('
				DELETE
				FROM `blog_comments`
				WHERE `id` = :id
				LIMIT 1
			');
			$delete->bindParam(':id', $comid, PDO::PARAM_INT);
			$delete->execute();
			$status = 'success';
			
		}
		
	}
	
}

die($status);

?>