<?php
require 'header.php';
?>
<main>
    <?php
    $CompID = trim($_GET['CompID']);
    require 'includes/dbh.php';
    ?>
    <h1 style="text-align:center">Team Summaries</h1>
    <?php
    $sql = "SELECT MatchStats.RobotID AS `TeamNum`, Robot.TeamName AS `TeamName`, COUNT(MatchStats.RobotID) AS `Matches`, MatchStats.CompID AS `CompID`, AVG(MatchStats.AutoSpeakerScored) AS `AvgAutoSpeaker`,(SUM(MatchStats.AutoSpeakerScored) / SUM(MatchStats.AutoSpeakerAttempts)) AS `autoSpeakerAccuracy`, AVG(MatchStats.autoAmpScored) AS `AvgAutoAmp`,(SUM(MatchStats.autoAmpScored) / SUM(MatchStats.autoAmpAttempts)) AS `autoAmpAccuracy`, AVG(MatchStats.SpeakerScored) AS `AvgSpeaker`,(SUM(MatchStats.SpeakerScored) / SUM(MatchStats.SpeakerAttempts)) AS `SpeakerAccuracy`, AVG(MatchStats.PodiumSpeakerScored) AS `AvgSpeakerPodium`, (SUM(MatchStats.PodiumSpeakerScored) / SUM(MatchStats.PodiumSpeakerAttempts)) AS `PodiumAccuracy`, AVG(MatchStats.AmpScored) AS `AvgAmp`,(sum(MatchStats.AmpScored) / sum(MatchStats.AmpAttempts)) AS `AmpAccuracy` from (MatchStats JOIN Robot) WHERE (Robot.ID = MatchStats.RobotID) AND (CompID=?) GROUP BY `TeamNum`, MatchStats.CompID ORDER BY TeamNum ASC";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {

        echo 'There was an SQL Error';
    } else {
        mysqli_stmt_bind_param($stmt, "i", $CompID);
        mysqli_stmt_execute($stmt);
        $response = mysqli_stmt_get_result($stmt);
        $index = 0;
        echo '<div class="accordion" id="accordionExample">';
        while ($row = mysqli_fetch_array($response)) {
            $autoHGPercent = $row['autoSpeakerAccuracy'] * 100;
            $autoLGPercent = $row['autoAmpAccuracy'] * 100;
            $HGPercent = $row['SpeakerAccuracy'] * 100;
            $LGPercent = $row['AmpAccuracy'] * 100;
            $ProtectedPercent = $row['PodiumAccuracy'] * 100;
            echo '<div class="accordion-item">
        <h2 class="accordion-header" id="heading' . $index . '">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse' . $index . '" aria-expanded="false" aria-controls="collapse' . $index . '">
        Team ' . $row['TeamNum'] . ': ' . $row['TeamName'] . '
        </button>
        </h2>
        <div id="collapse' . $index . '" class="accordion-collapse collapse" aria-labelledby="heading' . $index . '" data-parent="#accordionExample">
        <div class="accordion-body">
        In Autonomous, Team ' . $row['TeamNum'] . ' averaged <b>' . $row['AvgAutoSpeaker'] . '</b> speakers scored on <b>' . $autoHGPercent . '%</b> accuracy.<br>
        They also averaged <b>' . $row['AvgAutoAmp'] . '</b> amps scored on <b>' . $autoLGPercent . '%</b> accuracy.<br>
        In Teleop, they averaged <b>' . $row['AvgSpeaker'] . '</b> speakers scored per match on <b>' . $HGPercent . '%</b> accuracy.<br>
        They also averaged <b>' . $row['AvgAmp'] . '</b> amps scored per match on <b>' . $LGPercent . '%</b> accuracy, and<br>
        they averaged <b>' . $row['AvgSpeakerPodium'] . '</b> speakers scored from the podium per match on <b>' . $ProtectedPercent . '%</b> accuracy.<br>';
        $query = "SELECT `MatchStats`.`RobotID` AS `RobotID`,`MatchStats`.`CompID` AS `CompID`,COUNT(`MatchStats`.`Climb`) AS `MatchesClimbed`,COUNT(`MatchStats`.`RobotID`) AS `Matches` FROM `MatchStats` WHERE CompID=$CompID AND RobotID=$row[TeamNum] AND ((`MatchStats`.`Climb` = 'on_stage_alone') OR (`MatchStats`.`Climb` = 'on_stage_one_teammate') OR (`MatchStats`.`Climb` = 'on_stage_alliance')) GROUP BY `MatchStats`.`RobotID`,`MatchStats`.`CompID`";
        $result = @mysqli_query($conn, $query);
        $rowB = mysqli_fetch_array($result);
        //If a team did not climb, the MatchClimbing view will NOT display any climbing info for them, so it won't say 0 matches. This statement is necessary for this.
        if ($rowB != NULL)
        {
            echo 'In the End Game, this team climbed in <b>'. $rowB['MatchesClimbed'] .' out of '. $row['Matches'] .'</b> matches.';
            echo '</div>';
        }
        else
        {
            echo 'In the End Game, this team climbed in <b>0 out of '. $row['Matches'] .'</b> matches.';
            echo '</div>';
        }
            echo '</div>
        </div>';
            $index++;
        }
        echo '</div>';
    }
    ?>
</main>
<?php
require 'footer.php';
?>