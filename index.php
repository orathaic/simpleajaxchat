<?php
/*foreach($_POST as $key => $value)
{
echo "$key - $value";
}
echo '<html><body>error#</body></html>'; exit();
*/
/*
connect to db;
*/
	$settings['mysql_user'] = $settings['mysql_db'] = 'colony_tmain';
	$settings['mysql_pass'] = 'stuff';
        $dbconnect = new mysqli("localhost", $settings['mysql_user'], $settings['mysql_pass'], $settings['mysql_db']); 
	if ($dbconnect->connect_errno) {
    		echo "Failed to connect to MySQL: (" . $dbconnect->connect_errno . ") " . $dbconnect->connect_error; exit();
	}
/*
check for POST data; 
	AUTH valid username;
	post to db;
*/
if(isset($_POST)) {  session_start();
		if(isset($_SESSION['Commander']) && $_POST['username'] == $_SESSION['Commander']) $CommanderName = $_SESSION['Commander'];
	 if(isset($_POST['message']))
	{ $message = $dbconnect->real_escape_string($_POST['message']);
	if(!$dbconnect->query("INSERT INTO simple_ajax_chat (`username`,`message`)
			VALUES ('$CommanderName', '$message');"))
		echo "INSERT error(" . $dbconnect->errno . ") " . $dbconnect->error;
		}
	}
/*
check top 50 messages;
*/ //echo 'top 50';
	if(isset($_POST['timestamp'])) $now = $_POST['timestamp']; else $now = 0; //echo "SELECT * FROM simple_ajax_chat WHERE UNIX_TIMESTAMP(timestamp) < $now LIMIT 50";
	$result = $dbconnect->query("SELECT * FROM simple_ajax_chat WHERE UNIX_TIMESTAMP(timestamp) > $now ORDER BY timestamp ASC LIMIT 50");
	while ($row = $result->fetch_assoc())
	{$toreturn .= "<div>".ucfirst($row['username']).": ".$row['message']."</div>";}

$toreturn .= "<input type=hidden id=chatTimestamp value=".time()."></intup>";
/*
Return ajax string;
*/
echo $toreturn;
/***
***/
?>
