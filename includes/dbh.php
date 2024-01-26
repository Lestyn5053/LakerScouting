<?php
//Note that for the GitHub repo, the real database information is not included
$servername = "sql109.infinityfree.com";
$dbUsername = "if0_35625860";
$dbPassword = "FGdezuy3ab8j1z";
$dbName = "if0_35625860_MIScoutingData";

$conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbName);

if (!$conn)
{
	die("Task failed successully. ".mysqli_connect_error);
}