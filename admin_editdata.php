<?php
require 'header.php';
?>

<main>
    <?php
    if ($_SESSION['userRole'] != 'Admin' && $_SESSION['userRole'] != 'Team Lead') {
        header("Location: index.php?error=noaccess");
        exit();
    }
    $CompID = trim($_GET['CompID']);
    require 'includes/dbh.php';
    ?>
    <h1 style="text-align:center">Match Data</h1>
    <?php
    $sql = "SELECT * FROM MatchStats WHERE CompID=? ORDER BY RobotID ASC, MatchNum ASC";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo 'There was an SQL Error';
    } else {
        mysqli_stmt_bind_param($stmt, "i", $CompID);
        mysqli_stmt_execute($stmt);
        $response = mysqli_stmt_get_result($stmt);
        echo '<table class="table table-bordered border-primary" id="rawdata" cellspacing="5" cellpadding="8">
            <thead class="table-light">
            <tr align="center">
            <td><b>ID</b></td>
            <td><b>Scout Name</b></td>
            <td><b>Team</b></td>
            <td><b>Match</b></td>
            <td><b>Auto Move?</b></td>
            <td><b>AutoSpeakerScored</b></td>
            <td><b>AutoSpeakerMissed</b></td>
            <td><b>AutoAmpScored</b></td>
            <td><b>AutoAmpMissed</b></td>
            <td><b>SpeakerScored</b></td>
            <td><b>SpeakerMissed</b></td>
            <td><b>AmpScored</b></td>
            <td><b>AmpMissed</b></td>
            <td><b>NotesDropped</b></td>
            <td><b>Climb</b></td>
            <td><b>TrapNote</b></td>
            <td><b>DriveRating</b></td>
            <td><b>DefenseComments</b></td>
            <td><b>DefenseRating</b></td>
            <td><b>Penalties</b></td>
            <td><b>Comments</b></td>
            <td><b>Edit Data</b></td>
            <td><b>Delete Data</b></td>
            </tr>
            </thead>';
        while ($row = mysqli_fetch_array($response)) {
            echo '<tr><td>' .
                $row['ID'] . '</td><td align="center">' .
                $row['ScoutName'] . '</td><td align="center">' .
                $row['RobotID'] . '</td><td align="center">' .
                $row['MatchNum'] . '</td><td align="center">' .
                $row['StartingZone'] . '</td><td align="center">' .
                $row['AutoSpeakerScored'] . '</td><td align="center">' .
                $row['AutoSpeakerMissed'] . '</td><td align="center">' .
                $row['AutoAmpScored'] . '</td><td align="center">' .
                $row['AutoAmpMissed'] . '</td><td align="center">' .
                $row['SpeakerScored'] . '</td><td align="center">' .
                $row['SpeakerMissed'] . '</td><td align="center">' .
                $row['AmpScored'] . '</td><td align="center">' .
                $row['AmpMissed'] . '</td><td align="center">' .
                $row['NotesDropped'] . '</td><td align="center">' .
                $row['Climb'] . '</td><td align="center">' .
                $row['TrapNote'] . '</td><td align="center">' .
                $row['DriveTeam'] . '</td><td align="center">' .
                $row['DefenseComments'] . '</td><td align="center">' .
                $row['DefenseRating'] . '</td><td align="center">' .
                $row['Penalties'] . '</td><td align="center">' .
                $row['Comments'] . '</td><td align="center">' .
                '<a href="editmatch.php?ID=' . $row['ID'] . '&CompID=' . $CompID . '" class="btn btn-primary disabled">Edit</a></td><td align="center">' .
                '<a href="deletematch.php?ID=' . $row['ID'] . '&CompID=' . $CompID . '" class="btn btn-danger">Delete</a></td><td align="center">';
            echo '</tr>';
        }
        echo '</table>';
    }
    ?>