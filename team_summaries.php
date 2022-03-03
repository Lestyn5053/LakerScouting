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
    $sql = "SELECT MatchStats.RobotID AS `TeamNum`, Robot.TeamName AS `TeamName`, COUNT(MatchStats.RobotID) AS `Matches`, MatchStats.CompID AS `CompID`, AVG(MatchStats.autoHGScored) AS `AvgAutoHG`,(SUM(MatchStats.autoHGScored) / SUM(MatchStats.autoTotHGAtt)) AS `autoHGAccuracy`, AVG(MatchStats.autoLGScored) AS `AvgAutoLG`,(SUM(MatchStats.autoLGScored) / SUM(MatchStats.autoTotLGAtt)) AS `autoLGAccuracy`, AVG(MatchStats.HGScored) AS `AvgHG`,(SUM(MatchStats.HGScored) / SUM(MatchStats.HGTotAtt)) AS `HGAccuracy`, AVG(MatchStats.launchPadHGScored) AS `AvgHGLaunchPad`, (SUM(MatchStats.launchPadHGScored) / SUM(MatchStats.launchPadHGTotAtt)) AS `HGLaunchPadAcc`, AVG(MatchStats.teleLGScored) AS `AvgLG`,(sum(MatchStats.teleLGScored) / sum(MatchStats.teleLGTotAtt)) AS `LGAccuracy` from (MatchStats JOIN Robot) WHERE (Robot.ID = MatchStats.RobotID) AND (CompID=?) GROUP BY `TeamNum`, MatchStats.CompID ORDER BY TeamNum ASC";

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
        $autoHGPercent = $row['autoHGAccuracy'] * 100;
        $autoLGPercent = $row['autoLGAccuracy'] * 100;
        $HGPercent = $row['HGAccuracy'] * 100;
        $LGPercent = $row['LGAccuracy'] * 100;
        $LaunchPadHGPercent = $row['HGLaunchPadAcc'] * 100;
        echo '<div class="card">
        <div class="card-header" id="heading'. $index .'">
        <h2 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse'. $index .'" aria-expanded="false" aria-controls="collapse'. $index .'">
        Team '. $row['TeamNum'] .': '. $row['TeamName'] .'
        </button>
        </h2>
        </div>
        <div id="collapse'. $index .'" class="collapse" aria-labelledby="heading'. $index .'" data-parent="#accordionExample">
        <div class="card-body">
        In Autonomous, Team '. $row['TeamNum'] .' averaged <b>'. $row['AvgAutoHG'] .'</b> high goals scored on <b>'. $autoHGPercent .'%</b> accuracy.<br>
        They also averaged <b>'. $row['AvgAutoLG'] .'</b> low goals scored on <b>'. $autoLGPercent .'%</b> accuracy.<br>
        In Teleop, they averaged <b>'. $row['AvgHG'] .'</b> high goals scored per match on <b>'. $HGPercent .'%</b> accuracy.<br>
        They also averaged <b>'. $row['AvgLG'] .'</b> low goals scored per match on <b>'. $LGPercent .'%</b> accuracy, and<br>
        they averaged <b>'. $row['AvgHGLaunchPad'] .'</b> high goals scored from the launch pad per match on <b>'. $LaunchPadHGPercent .'%</b> accuracy.<br>';
        /*$query = "SELECT * FROM MatchClimbing WHERE CompID=$CompID AND RobotID=$row[TeamNum]";
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
        </div>';*/
        $index++;
        }
    echo '</div>';
    }
    ?>
</main>
<?php
require 'footer.php';
?>