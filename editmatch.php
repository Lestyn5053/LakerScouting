<?php
require 'header.php';
?>
<?php
if ($_SESSION['userRole'] != 'Admin' && $_SESSION['userRole'] != 'Team Lead') {
    header("Location: index.php?error=noaccess");
    exit();
}
?>
<h1>Edit Match Data</h1>
<?php
require 'includes/dbh.php';
$ID = trim($_GET['ID']);
$CompID = trim($_GET['CompID']);
$sql = "SELECT * FROM MatchStats WHERE ID=?";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: admin_editdata.php?error=sqlerror");
    exit();
} else {
    mysqli_stmt_bind_param($stmt, "i", $ID);
    mysqli_stmt_execute($stmt);
    $response = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_array($response)) {
        echo '<form action="includes/admin_editmatchsubmit.php?ID=' . $ID .'&CompID=' . $CompID .'" method="post">';
        echo '<div class="mb-3">
        <label for="team" class="form-label">Team Number</label>
        <select class="form-select" name="team" id="team">';
        $teamSql = "SELECT Robot.ID AS RobotNum FROM Robot, RobotsAtComp WHERE Robot.ID=RobotsAtComp.RobotID AND RobotsAtComp.CompID=? ORDER BY Robot.ID ASC";
        $teamStmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($teamStmt, $teamSql)) {
            echo 'There was an SQL Error';
        } else {
            mysqli_stmt_bind_param($teamStmt, "i", $CompID);
            mysqli_stmt_execute($teamStmt);
            $teamResponse = mysqli_stmt_get_result($teamStmt);
        }
        while ($teamRow = mysqli_fetch_array($teamResponse)) {
            if (trim($teamRow['RobotNum']) == trim($row['RobotID'])) {
                echo '<option value="' . $teamRow['RobotNum'] . '" selected>' . $teamRow['RobotNum'] . '</option>';
            } else {
                echo '<option value="' . $teamRow['RobotNum'] . '">' . $teamRow['RobotNum'] . '</option>';
            }
        }
        echo '</select>
        </div>';
        echo '<div class="mb-3">
        <label for="match" class="form-label">Match Number</label>
        <input class="form-control" type="number" pattern="[0-9]*" id="match" name="match" value=' . $row['MatchNum'] . '>';
        echo '<div class="mb-3">
        <label for="auto_move" class="form-label">Starting Zone</label>
        <div class="custom-control custom-radio custom-control-inline">';
        if ($row['StartingZone'] == 1) {
            echo '<input type="radio" id="auto_move1" name="auto_move" class="form-check-input" value="1" checked>
            <label class="form-check-label" for="auto_move1">Yes</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="auto_move2" name="auto_move" class="form-check-input" value="0">
            <label class="form-check-label" for="auto_move2">No</label>
            </div>';
        } else {
            echo '<input type="radio" id="auto_move1" name="auto_move" class="form-check-input" value="1">
            <label class="form-check-label" for="auto_move1">Yes</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="auto_move2" name="auto_move" class="form-check-input" value="0" checked>
            <label class="form-check-label" for="auto_move2">No</label>
            </div>';
        }
        echo '<div class="mb-3">
        <label for="a_speaker_scored">Auto Speaker Notes Scored</label>
        <input type="number" class="form-control" pattern="[0-9]*" id="a_speaker_scored" name="a_speaker_scored" value="' . $row['AutoSpeakerScored'] .'">
        </div>';
        echo '<div class="mb-3">
        <label for="a_speaker_missed">Auto Speaker Notes Missed</label>
        <input type="number" class="form-control" pattern="[0-9]*" id="a_speaker_missed" name="a_speaker_missed" value="' . $row['AutoSpeakerMissed'] .'">
        </div>';
        echo '<div class="mb-3">
        <label for="a_amp_scored">Auto Amp Notes Scored</label>
        <input type="number" class="form-control" pattern="[0-9]*" id="a_amp_scored" name="a_amp_scored" value="' . $row['AutoAmpScored'] .'">
        </div>';
        echo '<div class="mb-3">
        <label for="a_amp_missed">Auto Amp Notes Missed</label>
        <input type="number" class="form-control" pattern="[0-9]*" id="a_amp_missed" name="a_amp_missed" value="' . $row['AutoAmpMissed'] .'">
        </div>';
        echo '<div class="mb-3">
        <label for="speaker_scored">Speaker Notes Scored</label>
        <input type="number" class="form-control" pattern="[0-9]*" id="speaker_scored" name="speaker_scored" value="' . $row['SpeakerScored'] .'">
        </div>';
        echo '<div class="mb-3">
        <label for="speaker_missed">Speaker Notes Missed</label>
        <input type="number" class="form-control" pattern="[0-9]*" id="speaker_missed" name="speaker_missed" value="' . $row['SpeakerMissed'] .'">
        </div>';
        echo '<button class="btn btn-success btn-block input-group-btn" type="submit" name="edit-match-submit">Submit</button>';
        echo '</form>';
    }
}
?>

<?php
require 'footer.php';
?>