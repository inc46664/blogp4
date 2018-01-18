function go(dir) {
      window.location = dir;
}

function setCookie(cname, cvalue, exdays) {
	var d = new Date();
	d.setTime(d.getTime() + (exdays*24*60*60*1000));
	var expires = "expires="+ d.toUTCString();
	document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function setResponse(id, str) {
      var response = document.getElementById(id);
      if(str.length <= 0) {
            response.innerHTML = "";
            response.style.display = 'none';
      } else {
            response.innerHTML = str;
            response.style.display = 'block';
      }
}

$(function() {
      
      // Popup cookies
      $("#close-pop_cookies").click(function() {
            $("#pop_cookies").css("display", "none");
            setCookie("allcks", true, 365);
      });
      
});