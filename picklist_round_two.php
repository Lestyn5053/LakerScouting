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
    <h1 style="text-align:center">Round Two Picklist</h1>
    <h4>On behalf of Team 5053 and Team [First Round Pick], we'd like to request the assistance of...</h4>
    <?php
    $sql = "SELECT * FROM IntakeRatings WHERE CompID=$CompID ORDER BY AvgIntake DESC";
    $response = @mysqli_query($conn, $sql);
    echo '<table id="roundtwo" cellspacing="5" cellpadding="8">
        <tr align="center"><td><b>Team</b></td>
        <td><b>Climbing Acc</b></td>
        <td><b>Auto HG Acc</b></td>
        <td><b>Avg Auto HG</b></td>
        <td><b>Avg Intake Rating</b></td>
        </tr>';
    while ($row = mysqli_fetch_array($response)) {
        $query = "SELECT MatchesClimbed FROM MatchClimbing WHERE CompID=$CompID AND RobotID=$row[TeamNum]";
        $result = @mysqli_query($conn, $query);
        $rowB = mysqli_fetch_array($result);
        $mysql = "SELECT Matches, AvgAutoHG, autoHGAccuracy FROM TeamSummary WHERE CompID=$CompID AND TeamNum=$row[TeamNum]";
        $resultant = @mysqli_query($conn, $mysql);
        $rowC = mysqli_fetch_array($resultant);
        $ClimbingAccuracy = round(($rowB['MatchesClimbed'] / $rowC['Matches']) * 100, 2);
        $AutoHGAcc = round($rowC['autoHGAccuracy'] * 100, 2);
        echo '<tr><td align="center"><b>' .
            $row['TeamNum'] . '</b></td><td align="center">' .
            $ClimbingAccuracy . '%</td><td align="center">' .
            $AutoHGAcc . '%</td><td align="center">' .
            round($rowC['AvgAutoHG'], 2) . '</td><td align="center">' .
            round($row['AvgIntake'], 2) . '</td><td align="center">';
        echo '</tr>';
    }
    echo '</table>';
    ?>
    <button class="btn btn-outline-success btn-block input-group-btn" onclick="exportTableToExcel('roundtwo', 'RoundTwo')">Export to Excel</button>
    <small class="text-muted">Please note that this feature is intended for PC use. Please do not use Microsoft Edge to download the excel file. Edge isn't very nice about formatting it correctly.</small>
</main>
<?php
require 'footer.php';
?>