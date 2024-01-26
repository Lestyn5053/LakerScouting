<?php
if (isset($_POST['linking-table-submit'])) {
    require 'dbh.php';

    $currentYear = date("Y");

    $compUrl = "https://www.thebluealliance.com/api/v3/district/". $currentYear . "fim/events";

    $compResponse = makeApiCall($compUrl);

    $obj = json_decode($compResponse, true);
    foreach($obj as $item => $value) {
        $event_key = $value['key'];
        $event_name = $value['name'];
        $replacement_array = array("FIM District ", " Event", "FIRST in ");
        $short_name = str_replace($replacement_array, "", $event_name);

        $sql = "SELECT ID FROM Competition WHERE CompName LIKE ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../admin_filltables.php?error=sqlerror&event=$event_key");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $short_name);
            mysqli_stmt_execute($stmt);
            $getIDResponse = mysqli_stmt_get_result($stmt);
            while ($row = mysqli_fetch_array($getIDResponse)) {
                $compID = $row['ID'];
            }
        }

        $teamUrl = "https://www.thebluealliance.com/api/v3/event/". $event_key ."/teams/simple";

        $teamResponse = makeApiCall($teamUrl);

        $teamObj = json_decode($teamResponse, true);
        foreach($teamObj as $teamItem => $teamValue) {
            $robotID = $teamValue['team_number'];

            $linkingSql = "INSERT INTO RobotsAtComp (ID, RobotID, CompID) VALUES (NULL, ?, ?)";
            $newStmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($newStmt, $linkingSql)) {
                header("Location: ../admin_filltables.php?error=sqlerror&event=$event_key&robotID=$robotID");
                exit();
            } else {
                mysqli_stmt_bind_param($newStmt, "ii", $robotID, $compID);
                mysqli_stmt_execute($newStmt);
            }
        }
    }

    mysqli_close($conn);
    header("Location: ../admin_filltables.php?linkingtablefill=success");
    exit();

} else {
    header("Location: ../index.php");
    exit();
}

function makeApiCall($rUrl) {
    $curl = curl_init($rUrl);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'X-TBA-Auth-Key: 8pRhwwMxvZ1B39cydigMPwKUt8fPRJPWyXcmRVk4Gbcpw3kCqmf4hyDNjJIcGTZP',
        'accept: application/json'
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}