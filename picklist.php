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
    <h1 style="text-align:center">Picklist</h1>
    <h3>Disclaimer: This list is based roughly on what Team 5053 is looking for in partners. It also does not take human input into account, so the team's actual pick list may (should!) vary from this to some degree.</h3>
    <h4>On behalf of Team 5053 and all of our wonderful sponsors and supporters, we'd like to request the assistance of...</h4>
    <?php
    $sql = "SELECT RobotID, CompID, COUNT(RobotID) AS Matches, (SUM(autoHGScored) / SUM(autoTotHGAtt)) AS AutoHGAccuracy, AVG(autoHGScored) AS AvgAutoHG, (SUM(HGScored) / SUM(HGTotAtt)) AS HGAccuracy, AVG(HGScored) AS AvgHG FROM `MatchStats` WHERE CompID=$CompID GROUP BY RobotID, CompID ORDER BY AutoHGAccuracy DESC, AvgAutoHG DESC, HGAccuracy DESC, AvgHG DESC";
    echo '<table id="roundone" cellspacing="5" cellpadding="8">
        <tr align="center"><td><b>Team</b></td>
        <td><b>Climbing Acc</b></td>
        <td><b>Auto HG Acc</b></td>
        <td><b>Avg Auto HG</b></td>
        <td><b>Teleop HG Acc</b></td>
        <td><b>Avg Teleop HG</b></td>
        </tr>';
    while ($row = mysqli_fetch_array($response)) {
        $query = "SELECT RobotID, CompID, COUNT(Climb) AS MatchesClimbed FROM MatchStats WHERE CompID=$CompID AND RobotID=$row[RobotID]";
        $result = @mysqli_query($conn, $query);
        $rowB = mysqli_fetch_array($result);
        $ClimbingAccuracy = round(($rowB['MatchesClimbed'] / $row['Matches']) * 100, 2);
        $AutoHGAcc = round($row['AutoHGAccuracy'] * 100, 2);
        $HGAccuracy = round($row['HGAccuracy'] * 100, 2);
        echo '<tr><td align="center"><b>' .
            $row['RobotID'] . '</b></td><td align="center">' .
            $ClimbingAccuracy . '%</td><td align="center">' .
            $AutoHGAcc . '%</td><td align="center">' .
            round($row['AvgAutoHG'], 2) . '</td><td align="center">' .
            $HGAccuracy . '%</td><td align="center">' .
            round($row['AvgHG'], 2) . '</td><td align="center">';
        echo '</tr>';
    }
    echo '</table>';
    ?>
    <div class="d-grid gap-2">
        <button class="btn btn-outline-success btn-block input-group-btn" onclick="exportTableToExcel('roundone', 'Picklist')">Export to Excel</button>
    </div>
    <small class="text-muted">Please note that this feature is intended for PC use. Please do not use Microsoft Edge to download the excel file. Edge isn't very nice about formatting it correctly.</small>
</main>
<?php
require 'footer.php';
?>