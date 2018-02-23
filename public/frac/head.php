<head>
	<meta charset="utf-8" />
	<meta name="description" content="<?= $conf['desc'] ?>" />
	<title><?= $conf['title'] ?> - Billet simple pour l'Alaska</title>
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans|Roboto|Pacifico|Permanent+Marker" rel="stylesheet">
	<link rel="icon" type="image/png" href="<?= WEBROOT.'public/img/favicon.png' ?>" />
	<link rel="stylesheet" type="text/css" href="<?= WEBROOT.'public/css/style.css'; ?>" />
	<link rel="stylesheet" href="<?= WEBROOT.'public/lib/font-awesome-4.7.0/css/font-awesome.min.css'; ?>" />
	<script type="text/javascript" src="<?= WEBROOT.'public/js/jquery.js'; ?>" ></script>
	<script type="text/javascript" src="<?= WEBROOT.'public/js/main.js'; ?>" ></script>
	<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
	<?php if(isset($conf['tinymce'])) { ?><script>tinymce.init({ selector:'textarea#_tarea' });</script><?php } ?>
	<style><?php require_once(ROOT.'public/css/patch.php'); ?></style>
</head>