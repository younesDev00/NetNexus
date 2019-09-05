<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Email Confirmation</title>
</head>

<body>
<?php

//require "dbc.php";

$username = $_GET['username'];
$code = $_GET['code'];

$query = mysql_query("SELECT * FROM `users` WHERE `username`='$username'");
while($row = mysql_fetch_assoc($query))
{
	$db_code = $row['confirmcode'];
}
if($code == $db_code)
{
	mysql_query("UPDATE `users` SET `confirmed`='1'");
	mysql_query("UPDATE `users` SET `confirmcode`='0'");

	echo "Thank You. Your email has been confirmed and you may now login";
}
else
{
	echo "Username and code dont match";
}

?>
</body>
</html>
