<?php
    if(isset($_POST['match-submit']))
    {
        require 'dbh.php';

        $CompID = trim($_GET['CompID']);
        //Declaring variables for the values collected by the scout
        $ScoutName = $_POST['name'];
        $TeamNum = $_POST['team'];
        $MatchNum = $_POST['match'];
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
        $launchpadHGScored = $_POST['hg_scored_launch_pad'];
        $launchpadHGMissed = $_POST['hg_missed_launch_pad'];
        $launchpadHGTotal = $launchpadHGScored + $launchpadHGMissed;
        $teleLGScored = $_POST['lg_scored'];
        $teleLGMissed = $_POST['lg_missed'];
        $teleLGTotal = $teleLGScored + $teleLGMissed;
        $BallsDropped = $_POST['balls_dropped'];
        $Climb = $_POST['climb'];
        $DriveTeam = $_POST['drive_team'];
        $Defense = $_POST['defense'];
        $DefenseComments = $_POST['defense_comments'];
        $DefenseRating = $_POST['defense_rating'];
        $IntakeRating = $_POST['intake_rating'];
        $Penalties = $_POST['penalties'];
        $Comments = $_POST['comments'];

        $sql = "INSERT INTO MatchStats VALUES(NULL, $TeamNum, $CompID, $MatchNum, '$ScoutName', $initLine, $autoHGScored, $autoHGMissed, $autoHGTotal, $autoLGScored, $autoLGMissed, $autoLGTotal,
        $teleHGScored, $teleHGMissed, $teleHGTotal, $launchpadHGScored, $launchpadHGMissed, $launchpadHGTotal, $teleLGScored, $teleLGMissed, $teleLGTotal, $BallsDropped, '$Climb', $DriveTeam, $Defense,
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