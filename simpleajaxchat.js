// Assumes jquery is available; otherwise include.
function notify() {alert('pressed enter');}

function focused(tab) {if(tab.value == '...') tab.value='';}
function keyPressed(event, tab) { 
	if(event.which == 13 && tab.value != '' && tab.style.backgroundColor !== '#c0c0c0') { 
		UsernameTab = document.getElementById('ChatUsername'); 
		timestamp = document.getElementById('chatTimestamp'); 
		ajaxPost('http://www.colony-wars.com/simpleajaxchat/index.php', 'username='+UsernameTab.value+'&message='+tab.value+'&timestamp='+timestamp.value, 'chatcontent', ajaxReply);
		timestamp.parentNode.removeChild(timestamp);
		tab.value='';
		tab.style.backgroundColor = "#c0c0c0";
	}
}

function chatupdates() {
	timestamp = document.getElementById('chatTimestamp'); 
	ajaxPost('http://www.colony-wars.com/simpleajaxchat/index.php', 'timestamp='+timestamp.value, 'chatcontent', ajaxReply);
	timestamp.parentNode.removeChild(timestamp);
	setTimeout('chatupdates()', 45000);
}

setTimeout('chatupdates()', 45000);
/*
Set timeout to auto check for updates from server
*/

function ajaxReply(tabid, responce) { var tab = document.getElementById(tabid); 
			tab.innerHTML += responce; 
			chatInput = document.getElementById('chatinput'); 
			chatInput.style.backgroundColor = "#202020";
			}
/*
ajax request

append responce to chatbox
*/
function ajaxPost(url,post,elementid,callback)
{
var xmlhttp;
if (window.XMLHttpRequest)
  { // code for IE7+, Firefox, Chrome, Opera, Safari
   xmlhttp=new XMLHttpRequest();
  }
else if (window.ActiveXObject)
  {  // code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
else
  { alert("Your browser does not support XMLHTTP!");  }

 xmlhttp.onreadystatechange=function()
{ if(xmlhttp.readyState==4)
  { //document.getElementById(elementid).innerHTML=xmlhttp.responseText; 
    if(typeof(callback) !== 'undefined') callback(elementid, xmlhttp.responseText); }
}
xmlhttp.open("POST",url,true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send(post);

return false;
}
