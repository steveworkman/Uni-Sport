<?php
$username = 'shef_hockey';
$user_password = 'misterjuicey';
$database = 'shef_hockey';
$host = 'mysql.shef.uni-sport.org';

$connect = mysql_connect("$host", "$username", "$user_password")
	or die(mysql_error());

mysql_select_db("$database");
?>