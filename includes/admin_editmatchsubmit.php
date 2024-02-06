<?php
if (isset($_POST['edit-match-submit'])) {
    require 'dbh.php';

    $ID = trim($_GET['ID']);
    $CompID = trim($_GET['CompID']);
    //Basic Info
    $TeamNum = $_POST['team'];
    $MatchNum = $_POST['match'];
    //Autonomous
    $StartingZone = $_POST['auto_move'];
    $AutoSpeakerScored = $_POST['a_speaker_scored'];
    $AutoSpeakerMissed = $_POST['a_speaker_missed'];
    $AutoSpeakerTotal = $AutoSpeakerScored + $AutoSpeakerMissed;
    $AutoAmpScored = $_POST['a_amp_scored'];
    $AutoAmpMissed = $_POST['a_amp_missed'];
    $AutoAmpTotal = $AutoAmpScored + $AutoAmpMissed;
    //Teleoperated
    $SpeakerScored = $_POST['speaker_scored'];
    $SpeakerMissed = $_POST['speaker_missed'];
    $SpeakerTotal = $SpeakerScored + $SpeakerMissed;
    $PodiumSpeakerScored = $_POST['speaker_scored_protected'];
    $PodiumSpeakerMissed = $_POST['speaker_missed_protected'];
    $PodiumTotal = $PodiumSpeakerScored + $PodiumSpeakerMissed;
    $AmpScored = $_POST['amp_scored'];
    $AmpMissed = $_POST['amp_missed'];
    $AmpTotal = $AmpScored + $AmpMissed;
    $NotesDropped = $_POST['notes_dropped'];
    //End Game
    $Climb = $_POST['climb'];
    $TrapNote = $_POST['trap_note'];
    $DriveTeamRating = $_POST['drive_team'];
    $Defense = $_POST['defense'];
    $DefenseComments = $_POST['defense_comments'];
    $DefenseRating = $_POST['defense_rating'];
    $IntakeRating = $_POST['intake_rating'];
    $Penalties = $_POST['penalties'];
    $Comments = $_POST['comments'];

    $sql = "SELECT * FROM MatchStats WHERE ID=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../editmatch.php?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "i", $ID);
        mysqli_stmt_execute($stmt);
        $response = mysqli_stmt_get_result($stmt);
        $updateSQL = "UPDATE MatchStats SET ";
        $bindParamString = "";
        while($row = mysqli_fetch_array($response)) {
            if ($row['RobotID'] != $TeamNum) {
                $updateSQL = $updateSQL . "RobotID=?";
                $bindParamString = $bindParamString . "i";
            }
        }
        $updateSQL = $updateSQL . "WHERE ID=?";
        $bindParamString = $bindParamString . "i";
        $updateStmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($updateStmt, $updateSQL)) {
            header("Location: ../editmatch.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($updateStmt, $bindParamString, )
        }
    }
} else {
    header("Location: ../index.php");
    exit();
}
