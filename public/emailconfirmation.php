<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Email Confirmation</title>
</head>

<body>
<?php

//require "dbc.php";
$conn = mysqli_connect("localhost","root","","ecom_db");

$username = $_GET['username'];
$code = $_GET['code'];

$query = mysqli_query($conn, "SELECT * FROM `users` WHERE `username`='$username'");
while($row = mysqli_fetch_assoc($query))
{
	$db_code = $row['confirmcode'];
}
if($code == $db_code)
{
	mysqli_query($conn, "UPDATE `users` SET `confirmed`='1'");
	mysqli_query($conn, "UPDATE `users` SET `confirmcode`='0'");

	echo "Thank You. Your email has been confirmed and you may now login";
}
else
{
	echo "Username and code dont match";
}

?>
</body>
</html>
