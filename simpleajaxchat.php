<?php
echo "<div id=cboxdiv>
	<script src=\"http://www.colony-wars.com/simpleajaxchat/simpleajaxchat.js\" type=\"text/javascript\" charset=\"UTF-8\"></script>
	<div id=chatcontent>";
	include 'index.php';

	echo "</div>
	<div id=inputfield><input id=ChatUsername type=hidden value=$user>
	<input id=chatinput type=text name=message maxlength=144 value='...' onfocus=\"focused(this)\" onkeypress=\"keyPressed(event, this)\"></input>
	</div><div class=copyrightmark>SimpleAjaxChat ©</div>
</div>";
?>
