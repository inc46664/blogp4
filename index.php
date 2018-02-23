<?php
session_start();
define('WEBROOT', str_replace('index.php', null, $_SERVER['SCRIPT_NAME']));
define('ROOT', str_replace('index.php', null, $_SERVER['SCRIPT_FILENAME']));

require_once(ROOT.'public/inc/db.php');
require_once(ROOT.'public/inc/defaults.php');

$getpage = $_GET['page'];
$arguments = explode('/', $getpage);

$page = null;
if(isset($arguments[0])) { $page = strtolower($arguments[0]); } else { $page = 'index'; }
if($page == null) { $page = 'index'; }

$action = null;
if(isset($arguments[1])) { $action = strtolower($arguments[1]); } else { $action = 'index'; }
if($action == null) { $action = 'index'; }

require_once(ROOT.'model/model.php');
require_once(ROOT.'model/userModel.php');
require_once(ROOT.'model/chapterModel.php');
require_once(ROOT.'model/commentModel.php');
require_once(ROOT.'public/inc/functions.php');
require_once(ROOT.'public/inc/profile.php');
require_once(ROOT.'controller/controller.php');

$PROFILE = new Profile;
$model = new Model;
$userModel = new UserModel;
$chapterModel = new ChapterModel;
$commentModel = new CommentModel;
$controller = new Controller;

require_once(ROOT.'public/inc/init-user.php');

// Page
if(method_exists($controller, $page)) {
	$controller_path = ROOT.'controller/'.$page.'/'.$action.'Controller.php';
	if(file_exists($controller_path)) {
		require_once(ROOT.'controller/'.$page.'/'.$action.'Controller.php');
		require_once(ROOT.'view/'.$page.'/'.$action.'View.php');
	} else {
		echo '404';
	}
} else {
	echo '404';
}
