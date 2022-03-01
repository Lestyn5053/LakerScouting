<?php
require 'header.php';
?>
<main>
    <?php
    $CompID = trim($_GET['CompID']);
    require 'includes/dbh.php';
    ?>
    <script>
        function exportTableToExcel(tableID, filename = '') {
            var downloadLink;
            var dataType = 'application/vnd.ms-excel';
            var tableSelect = document.getElementById(tableID);
            var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

            // Specify file name
            filename = filename ? filename + '.xls' : 'excel_data.xls';

            // Create download link element
            downloadLink = document.createElement("a");

            document.body.appendChild(downloadLink);

            if (navigator.msSaveOrOpenBlob) {
                var blob = new Blob(['\ufeff', tableHTML], {
                    type: dataType
                });
                navigator.msSaveOrOpenBlob(blob, filename);
            } else {
                // Create a link to the file
                downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

                // Setting the file name
                downloadLink.download = filename;

                //triggering the function
                downloadLink.click();
            }
        }
    </script>
    <h1 style="text-align:center">Raw Match Data</h1>
    <h3 style="text-align:center">Have fun reading this LOL</h3>
    <h4 style="text-align:center">Ok but real talk, any T/F value is represented by 0 for false, 1 for true</h4>
    <?php
    $sql = "SELECT * FROM MatchStats WHERE CompID=? ORDER BY RobotID ASC, MatchNum ASC";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo 'There was an SQL Error';
    } else {
        mysqli_stmt_bind_param($stmt, "i", $CompID);
        mysqli_stmt_execute($stmt);
        $response = mysqli_stmt_get_result($stmt);
        echo '<table id="rawdata" cellspacing="5" cellpadding="8">
            <tr align="center"><td><b>Team</b></td>
            <td><b>Match</b></td>
            <td><b>Preload</b></td>
            <td><b>Auto Move?</b></td>
            <td><b>AutoHGScored</b></td>
            <td><b>AutoHGMissed</b></td>
            <td><b>AutoLGScored</b></td>
            <td><b>AutoLGMissed</b></td>
            <td><b>HGScored</b></td>
            <td><b>HGMissed</b></td>
            <td><b>LGScored</b></td>
            <td><b>LGMissed</b></td>
            <td><b>BallsDropped</b></td>
            <td><b>Rotation?</b></td>
            <td><b>FIRSTTry?</b></td>
            <td><b>Position?</b></td>
            <td><b>FIRSTTry?</b></td>
            <td><b>Climb</b></td>
            <td><b>Level?</b></td>
            <td><b>DriveRating</b></td>
            <td><b>DefenseComments</b></td>
            <td><b>DefenseRating</b></td>
            <td><b>Penalties</b></td>
            <td><b>Comments</b></td>
            </tr>';
        while ($row = mysqli_fetch_array($response)) {
            echo '<tr><td>' .
                $row['RobotID'] . '</td><td align="center">' .
                $row['MatchNum'] . '</td><td align="center">' .
                $row['autoPreload'] . '</td><td align="center">' .
                $row['autoMove'] . '</td><td align="center">' .
                $row['autoHGScored'] . '</td><td align="center">' .
                $row['autoHGMissed'] . '</td><td align="center">' .
                $row['autoLGScored'] . '</td><td align="center">' .
                $row['autoLGMissed'] . '</td><td align="center">' .
                $row['teleHGScored'] . '</td><td align="center">' .
                $row['teleHGMissed'] . '</td><td align="center">' .
                $row['teleLGScored'] . '</td><td align="center">' .
                $row['teleLGMissed'] . '</td><td align="center">' .
                $row['BallsDropped'] . '</td><td align="center">' .
                $row['RotationControl'] . '</td><td align="center">' .
                $row['RCFirstTry'] . '</td><td align="center">' .
                $row['PositionControl'] . '</td><td align="center">' .
                $row['PCFirstTry'] . '</td><td align="center">' .
                $row['Climb'] . '</td><td align="center">' .
                $row['LevelClimb'] . '</td><td align="center">' .
                $row['DriveTeam'] . '</td><td align="center">' .
                $row['DefenseComments'] . '</td><td align="center">' .
                $row['DefenseRating'] . '</td><td align="center">' .
                $row['Penalties'] . '</td><td align="center">' .
                $row['Comments'] . '</td><td align="center">';
            echo '</tr>';
        }
        echo '</table>';
    ?>
        <button class="btn btn-outline-success btn-block input-group-btn" onclick="exportTableToExcel('rawdata', 'matchdata')">Export to Excel</button>
        <small class="text-muted">Please note that this feature is intended for PC use. Excel might yell at you saying that you shouldn't open it unless you trust the source. Don't worry, everything is fine.</small>
    <?php
    }
    ?>
</main>
<?php
require 'footer.php';
?>