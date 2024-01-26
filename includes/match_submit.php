<?php
    if(isset($_POST['match-submit']))
    {
        require 'dbh.php';

        $CompID = trim($_GET['CompID']);
        //Declaring variables for the values collected by the scout
        $ScoutName = $_POST['name'];
        $TeamNum = $_POST['team'];
        $MatchNum = $_POST['match'];
        $startingZone = $_POST['auto_move'];
        $autoSpeakerScored = $_POST['a_speaker_scored'];
        $autoSpeakerMissed = $_POST['a_speaker_missed'];
        $autoSpeakerTotal = $autoSpeakerScored + $autoSpeakerMissed;
        $autoAmpScored = $_POST['a_amp_scored'];
        $autoAmpMissed = $_POST['a_amp_missed'];
        $autoAmpTotal = $autoAmpScored + $autoAmpMissed;
        $teleSpeakerScored = $_POST['speaker_scored'];
        $teleSpeakerMissed = $_POST['speaker_missed'];
        $teleSpeakerTotal = $teleSpeakerScored + $teleSpeakerMissed;
        $podiumSpeakerScored = $_POST['speaker_scored_protected'];
        $podiumSpeakerMissed = $_POST['speaker_missed_protected'];
        $podiumSpeakerTotal = $podiumSpeakerScored + $podiumSpeakerMissed;
        $teleAmpScored = $_POST['amp_scored'];
        $teleAmpMissed = $_POST['amp_missed'];
        $teleAmpTotal = $teleAmpScored + $teleAmpMissed;
        $NotesDropped = $_POST['notes_dropped'];
        $Climb = $_POST['climb'];
        $trapNote = $_POST['trap_note'];
        $DriveTeam = $_POST['drive_team'];
        $Defense = $_POST['defense'];
        $DefenseComments = $_POST['defense_comments'];
        $DefenseRating = $_POST['defense_rating'];
        $IntakeRating = $_POST['intake_rating'];
        $Penalties = $_POST['penalties'];
        $Comments = $_POST['comments'];

        $sql = "INSERT INTO MatchStats VALUES(NULL, $TeamNum, $CompID, $MatchNum, '$ScoutName', $startingZone, $autoSpeakerScored, $autoSpeakerMissed, $autoSpeakerTotal, $autoAmpScored, $autoAmpMissed, $autoAmpTotal,
        $teleSpeakerScored, $teleSpeakerMissed, $teleSpeakerTotal, $podiumSpeakerScored, $podiumSpeakerMissed, $podiumSpeakerTotal, $teleAmpScored, $teleAmpMissed, $teleAmpTotal, $NotesDropped, '$Climb',
        $trap_note, $DriveTeam, $Defense,'$DefenseComments', $DefenseRating, $IntakeRating, '$Penalties', '$Comments')";
        if(mysqli_query($conn, $sql))
        {
            header('Location: ' . '../match_scout.php?CompID='. $CompID .'&submit=success');
            exit();
        }
        else
        {
            echo "ERROR: Could not execute $sql. " . mysqli_error($conn);
        }
    }
    else
    {
        header("Location: ../index.php");
        exit();
    }