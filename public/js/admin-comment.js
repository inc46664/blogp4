function toggleComment(type, comid, webroot) {
	if(type != 'allow' && type != 'deny') { type = 'deny'; }
	$.post(webroot+'get.php', { type: type, comid: comid }, function (data) {
		if(data == 'success') {
			var com_el = document.getElementById('_manage-' + comid);
			com_el.style.display = 'none';
			com_el.innerHTML = '';
		} else {
			alert(data);
		}
	});
}
