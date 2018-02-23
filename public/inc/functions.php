<?php
function js($code) {
	echo '<script type="text/javascript" >'.$code.'</script>';
}

function go($l, $t) {
	echo '<meta http-equiv="refresh" content="'.$t.';URL='.$l.'"/>';
}

function getchars($type="default") {
	switch($type) {
		case 'default':
			return array(
				'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
				'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
				'0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '_'
			);
			break;
	}
}

function textToUrl($str) {
	$str = str_ireplace(array('é', 'à', 'ê', 'ë', '€'), 'e', $str);
	$str = str_ireplace(array('à', 'á', 'â', 'ã', 'ā', 'ą', 'ā', 'ä'), 'a', $str);
	$str = str_ireplace(array('ō', 'ô', 'ø'), 'o', $str);
	$str = str_ireplace(array('ñ', 'ñ'), 'n', $str);
	$str = str_ireplace(array('č', 'ç', 'ĉ'), 'c', $str);
	$str = str_ireplace(array('æ'), 'ae', $str);
	$str = str_ireplace(array('œ'), 'oe', $str);
	$str = str_ireplace(array('_', ' ', '.', ':', ';', '&', '!', '?', '^', '/', '\\', '*', '=', ','), '-', $str);
	$str = str_ireplace(array('--', '---'), '-', $str);
	if(is_numeric($str)) { $str.= 'i'; }
	return strtolower($str);
}

function maxlength($str, $n) {
	if(strlen($str) >= ($n-3)) {
		$str = substr($str, 0, ($n-3));
		$str = $str.'...';
	}
	return $str;
}

function info($type='info', $msg=null, $options=array()) {
	?><div class="INFO <?= $type ?>" >
		<p><?= $msg ?></p>
	</div><?php
}

function randstr($n, $c) {
	$str = null;
	$i = 0;
	while($i != $n) {
		$r = rand(0,(count($c)-1));
		$str = $str.$c[$r];
		$i++;
	}
	return $str;
}

function contains($val, $var) {
	$b = false;
	if(str_replace($val, null, $var) != $var) {
		$b = true;
	}
	return $b;
}

function dateFr($date, $template='?') {
	$boum = explode(' ', $date);
	$day = explode('-', $boum[0]);
	$hour = explode(':', $boum[1]);
	$template = str_replace('%1%', $day[2], $template);
	$template = str_replace('%2%', $day[1], $template);
	$template = str_replace('%3%', $day[0], $template);
	$template = str_replace('%4%', $hour[0], $template);
	$template = str_replace('%5%', $hour[1], $template);
	$template = str_replace('%6%', $hour[2], $template);
	return $template;
}
