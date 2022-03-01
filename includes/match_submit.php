<?php
    if(isset($_POST['match-submit']))
    {
        require 'dbh.php';

        $CompID = trim($_GET['CompID']);
        //Declaring variables for the values collected by the scout
        $ScoutName = $_POST['name'];
        $TeamNum = $_POST['team'];
        $MatchNum = $_POST['match'];
        $Preload = $_POST['preload'];
        $initLine = $_POST['auto_move'];
        $autoHGScored = $_POST['a_hg_scored'];
        $autoHGMissed = $_POST['a_hg_missed'];
        $autoHGTotal = $autoHGScored + $autoHGMissed;
        $autoLGScored = $_POST['a_lg_scored'];
        $autoLGMissed = $_POST['a_lg_missed'];
        $autoLGTotal = $autoLGScored + $autoLGMissed;
        $teleHGScored = $_POST['hg_scored'];
        $teleHGMissed = $_POST['hg_missed'];
        $teleHGTotal = $teleHGScored + $teleHGMissed;
        $trenchHGScored = $_POST['hg_scored_trench'];
        $trenchHGMissed = $_POST['hg_missed_trench'];
        $trenchHGTotal = $trenchHGScored + $trenchHGMissed;
        $teleLGScored = $_POST['lg_scored'];
        $teleLGMissed = $_POST['lg_missed'];
        $teleLGTotal = $teleLGScored + $teleLGMissed;
        $BallsDropped = $_POST['balls_dropped'];
        $RotationControl = $_POST['rotation_control'];
        $RCFIRST = $_POST['rc_accurate'];
        $PositionControl = $_POST['position_control'];
        $PCFIRST = $_POST['pc_accurate'];
        $Climb = $_POST['climb'];
        $Level = $_POST['level'];
        $DriveTeam = $_POST['drive_team'];
        $Defense = $_POST['defense'];
        $DefenseComments = $_POST['defense_comments'];
        $DefenseRating = $_POST['defense_rating'];
        $IntakeRating = $_POST['intake_rating'];
        $Penalties = $_POST['penalties'];
        $Comments = $_POST['comments'];

        $sql = "INSERT INTO MatchStats VALUES(NULL, $TeamNum, $CompID, $MatchNum, '$ScoutName', $Preload, $initLine, $autoHGScored, $autoHGMissed, $autoHGTotal, $autoLGScored, $autoLGMissed, $autoLGTotal,
        $teleHGScored, $teleHGMissed, $teleHGTotal, $trenchHGScored, $trenchHGMissed, $trenchHGTotal, $teleLGScored, $teleLGMissed, $teleLGTotal, $BallsDropped, $RotationControl, $RCFIRST, $PositionControl, $PCFIRST, '$Climb', $Level, $DriveTeam, $Defense,
        '$DefenseComments', $DefenseRating, $IntakeRating, '$Penalties', '$Comments')";
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