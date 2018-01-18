<?php
session_start();
define('WEBROOT', str_replace('index.php', null, $_SERVER['SCRIPT_NAME']));
define('ROOT', str_replace('index.php', null, $_SERVER['SCRIPT_FILENAME']));

require_once(ROOT.'public/inc/db.php');
require_once(ROOT.'public/inc/config.php');

$getpage = $_GET['page'];
$arguments = explode('/', $getpage);

$page = null;
if(isset($arguments[0])) { $page = strtolower($arguments[0]); } else { $page = 'index'; }
if($page == null) { $page = 'index'; }
$action = null;
if(isset($arguments[1])) { $action = strtolower($arguments[1]); } else { $action = 'index'; }
if($action == null) { $action = 'index'; }

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
$Logging->visit($User, $bdd);

$actionPath = ROOT.'view/'.$page.'/'.$action.'View.php';

if(method_exists($Controller, $page)) {
	$Controller->$page();
	$pageModel = new pageModel;
	$chapEngine = new chaptersModel;
	$comsEngine = new commentsModel;
	$CONFIG = $pageModel->setHead($CONFIG);
	require_once(ROOT.'controller/'.$page.'Controller.php');
	if(file_exists($actionPath)) {
		// Action valide
		require_once(ROOT.'view/'.$page.'/'.$action.'View.php');
	} else {
		// Action introuvable: 404
		echo '404';
	}
} else {
	// Controller introuvable: 404
	echo '404';
}

?>