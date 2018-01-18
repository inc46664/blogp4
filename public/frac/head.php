<?php if(isset($CONFIG)) { ?>

<head>
	<meta charset="utf-8" />
	<meta name="description" content="<?= $CONFIG['head']['desc'].' - '.$CONFIG['global']['name'].' - '.$CONFIG['global']['subname'] ?>" />
	<title><?= $CONFIG['head']['title'] ?></title>
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans|Roboto|Pacifico|Permanent+Marker" rel="stylesheet">
	<link rel="icon" type="image/png" href="<?= $Model->getFavicon(); ?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo WEBROOT.'public/css/style.css'; ?>" />
	<link rel="stylesheet" href="<?php echo WEBROOT.'public/lib/font-awesome-4.7.0/css/font-awesome.min.css'; ?>" />
	<script type="text/javascript" src="<?php echo WEBROOT.'public/js/jquery.js'; ?>" ></script>
	<script type="text/javascript" src="<?php echo WEBROOT.'public/js/main.js'; ?>" ></script>
	<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
	<script>tinymce.init({ selector:'textarea#_tarea' });</script>
	<style><?php require_once(ROOT.'public/css/patch.php'); ?></style>
</head>

<?php } ?>