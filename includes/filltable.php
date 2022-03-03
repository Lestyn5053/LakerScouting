<?php
require 'dbh.php';
?>
<script src="../js/jquery-3.4.1.slim.min.js"></script>
<script src="../js/jquery-3.4.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<?php

//$rUrl = "https://www.thebluealliance.com/api/v3/district/2020fim/teams/simple";
$rUrl = "https://www.thebluealliance.com/api/v3/district/2022fim/events";
//$rUrl = "https://www.thebluealliance.com/api/v3/event/2020mitry/teams/simple";
//$rUrl  = "https://www.thebluealliance.com/api/v3/team/frc5053/event/2017mibro/status";
//$rUrl = "https://www.thebluealliance.com/api/v3/team/frc5053/events/2020/statuses";


$curl = curl_init($rUrl);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    'X-TBA-Auth-Key: 8pRhwwMxvZ1B39cydigMPwKUt8fPRJPWyXcmRVk4Gbcpw3kCqmf4hyDNjJIcGTZP',
    'accept: application/json'
));

$response = curl_exec($curl);
$obj = json_decode($response);
print_r($obj);

echo '<br><br><br>';
echo $obj->rank;
?>
<?php
//Populates competition table with Michigan competitions
foreach($obj as $item => $value)
{

$name = $value["name"];
$week = $value["week"] + 1;
$CompKey = $value["key"];

$sql = "INSERT INTO Competition (ID, Region, CompKey, Name, Week) VALUES (NULL, 'Michigan', '$CompKey', '$name', $week)";

if ($conn->query($sql) === TRUE)
{
echo '<p>It worked.</p>';
}
else
{
echo "ERROR: Could not execute $sql. " . mysqli_error($conn);
}

}

//Populates robot table with Michigan teams
/*foreach($obj as $item => $value)
{

$ID = $value["team_number"];
$team_number = $value["team_number"];
$RobotKey = $value["key"];
$team_name = $value["nickname"];
$state_prov = $value["state_prov"];

$sql = "INSERT INTO Robot (ID, TeamNum, RobotKey, TeamName, Region) VALUES ($ID, $team_number, '$RobotKey', '$team_name', '$state_prov')";

if ($conn->query($sql) === TRUE)
{
echo '<p>It worked.</p>';
}
else
{
echo "ERROR: Could not execute $sql. " . mysqli_error($conn);
}
}*/

//Populates Robot Stat/Fantasy Point tables with Michigan teams and their respective events
/*foreach($obj as $item => $value)
{
$RobotID = $value["team_number"];

$sql = "INSERT INTO RobotFantasyPts (RobotID, CompID) VALUES ($RobotID, 99)";

if ($conn->query($sql) === TRUE)
{
echo '<p>It worked.</p>';
}
else
{
echo "ERROR: Could not execute $sql. " . mysqli_error($conn);
}

$sql2 = "INSERT INTO RobotStats (RobotID, CompID) VALUES ($RobotID, 99)";

if ($conn->query($sql2) === TRUE)
{
echo '<p>It worked pt 2.</p>';
}
else
{
echo "ERROR: Could not execute $sql. " . mysqli_error($conn);
}
}*/


mysqli_close($conn);
curl_close($curl);

//Filling fantasy teams, for testing purposes only
/*$team = 5674;
$sql = "INSERT INTO UserRobot (RobotID, UserTeamID) VALUES ($team, 29)";
if ($conn->query($sql) === TRUE)
{
echo '<p>'. $team .' added successfuly.</p>';
}
else
{
echo "ERROR: Could not execute $sql. " . mysqli_error($conn);
}*/
//}
/*else
{
header("Location: ../index.php?");
exit();
}*/
