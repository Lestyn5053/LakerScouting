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
        echo '<table class="table table-bordered border-primary" id="rawdata" cellspacing="5" cellpadding="8">
            <thead class="table-light">
            <tr align="center"><td><b>Team</b></td>
            <td><b>Match</b></td>
            <td><b>Auto Move?</b></td>
            <td><b>AutoSpeakerScored</b></td>
            <td><b>AutoSpeakerMissed</b></td>
            <td><b>AutoAmpScored</b></td>
            <td><b>AutoAmpMissed</b></td>
            <td><b>SpeakerScored</b></td>
            <td><b>SpeakerMissed</b></td>
            <td><b>PodiumSpeakerScored</b></td>
            <td><b>PodiumSpeakerMissed</b></td>
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
            </tr>
            </thead>';
        while ($row = mysqli_fetch_array($response)) {
            echo '<tr><td>' .
                $row['RobotID'] . '</td><td align="center">' .
                $row['MatchNum'] . '</td><td align="center">' .
                $row['StartingZone'] . '</td><td align="center">' .
                $row['AutoSpeakerScored'] . '</td><td align="center">' .
                $row['AutoSpeakerMissed'] . '</td><td align="center">' .
                $row['AutoAmpScored'] . '</td><td align="center">' .
                $row['AutoAmpMissed'] . '</td><td align="center">' .
                $row['SpeakerScored'] . '</td><td align="center">' .
                $row['SpeakerMissed'] . '</td><td align="center">' .
                $row['PodiumSpeakerScored'] . '</td><td align="center">' .
                $row['PodiumSpeakerMissed'] . '</td><td align="center">' .
                $row['AmpScored'] . '</td><td align="center">' .
                $row['AmpMissed'] . '</td><td align="center">' .
                $row['NotesDropped'] . '</td><td align="center">' .
                $row['Climb'] . '</td><td align="center">' .
                $row['TrapNote'] . '</td><td align="center">' .
                $row['DriveTeam'] . '</td><td align="center">' .
                $row['DefenseComments'] . '</td><td align="center">' .
                $row['DefenseRating'] . '</td><td align="center">' .
                $row['Penalties'] . '</td><td align="center">' .
                $row['Comments'] . '</td><td align="center">';
            echo '</tr>';
        }
        echo '</table>';
    ?>
        <div class="d-grid gap-2">
            <button class="btn btn-outline-success btn-block input-group-btn" onclick="exportTableToExcel('rawdata', 'matchdata')">Export to Excel</button>
        </div>
        <small class="text-muted">Please note that this feature is intended for PC use. Excel might yell at you saying that you shouldn't open it unless you trust the source. Don't worry, everything is fine.</small>
    <?php
    }
    ?>
</main>
<?php
require 'footer.php';
?>