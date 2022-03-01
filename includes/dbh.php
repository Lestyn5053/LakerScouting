<?php
//Note that for the GitHub repo, the real database information is not included
$servername = "serverName";
$dbUsername = "dbUserName";
$dbPassword = "dbPassword";
$dbName = "dbName";

$conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbName);

if (!$conn)
{
	die("Task failed successully. ".mysqli_connect_error);
}