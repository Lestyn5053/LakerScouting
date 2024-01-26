<?php
if (isset($_POST['robot-table-submit'])) {
    require 'dbh.php';

    $currentYear = date("Y");

    $rUrl = "https://www.thebluealliance.com/api/v3/district/". $currentYear . "fim/teams/simple";

    $curl = curl_init($rUrl);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'X-TBA-Auth-Key: 8pRhwwMxvZ1B39cydigMPwKUt8fPRJPWyXcmRVk4Gbcpw3kCqmf4hyDNjJIcGTZP',
        'accept: application/json'
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    $obj = json_decode($response, true);
    foreach($obj as $item => $value) {
        $ID = $value["team_number"];
        $team_name = $value["nickname"];

        $sql = "INSERT INTO Robot (ID, TeamName) VALUES (?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../admin_filltables.php?error=sqlerror&name=$team_name&teamnum=$ID");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $ID, mysqli_real_escape_string($conn, $team_name));
            mysqli_stmt_execute($stmt);
        }
    }

    mysqli_close($conn);
    header("Location: ../admin_filltables.php?robotablefill=success");
    exit();

} else {
    header("Location: ../index.php");
    exit();
}