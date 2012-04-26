<?php
$username = 'USERNAME';
$user_password = 'PASSWORD';
$database = 'DATABASE';
$host = 'localhost';

$connect = mysql_connect("$host", "$username", "$user_password")
	or die(mysql_error());

mysql_select_db("$database");
?>