<?php
    require 'header.php';
?>
<main>
    <?php
        $CompID = trim($_GET['CompID']);
        require 'includes/dbh.php';
    ?>
    <h1 style="text-align:center">Match Count</h1>
    <h3>How many times has each team been scouted?</h3>
    <?php
        $sql = "SELECT RobotID, COUNT(MatchNum) AS Matches FROM MatchStats WHERE CompID=? GROUP BY RobotID ORDER BY RobotID ASC";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'There was an SQL Error';
        } else {
            mysqli_stmt_bind_param($stmt, "i", $CompID);
            mysqli_stmt_execute($stmt);
            $response = mysqli_stmt_get_result($stmt);
            echo '<table cellspacing="5" cellpadding="8">
            <tr align="center"><td><b>Team</b></td>
            <td><b>Matches Scouted</b></td>
            </tr>';
            while($row = mysqli_fetch_array($response))
            {
                echo '<tr><td align="center">' . 
                $row['RobotID'] . '</td><td align="center">' . 
                $row['Matches'] .'</td><td align="center">';
                echo '</tr>'; 
            }
            echo '</table>';
        }
    ?>
</main>
<?php
    require 'footer.php';
?>