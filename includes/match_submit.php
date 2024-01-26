<?php
    if(isset($_POST['match-submit'])) {
        require 'dbh.php';

        $CompID = trim($_GET['CompID']);
        //Basic Info
        $ScoutName = $_POST['name'];
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

        $sql = "INSERT INTO MatchStats VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,
        ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../match_scout.php?CompID=$CompID'&error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "iiisiiiiiiiiiiiiiiiiisiiisiiss", $TeamNum, $CompID, $MatchNum,
            $ScoutName, $StartingZone, $AutoSpeakerScored, $AutoSpeakerMissed, $AutoSpeakerTotal,
            $AutoAmpScored, $AutoAmpMissed, $AutoAmpTotal, $SpeakerScored, $SpeakerMissed, $SpeakerTotal,
            $PodiumSpeakerScored, $PodiumSpeakerMissed, $PodiumTotal, $AmpScored, $AmpMissed, $AmpTotal,
            $NotesDropped, $Climb, $TrapNote, $DriveTeamRating, $Defense, $DefenseComments, $DefenseRating,
            $IntakeRating, mysqli_real_escape_string($conn, $Penalties), mysqli_real_escape_string($conn, $Comments));
            mysqli_stmt_execute($stmt);
        }

        mysqli_close($conn);
        header("Location: ../match_scout.php?CompID=$CompID&submit=success");
        exit();

    } else {
        header("Location: ../index.php");
        exit();
    }
?>