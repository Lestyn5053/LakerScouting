<?php
if (isset($_POST['comp-table-submit'])) {
    require 'dbh.php';

    $currentYear = date("Y");

    $rUrl = "https://www.thebluealliance.com/api/v3/district/". $currentYear . "fim/events";

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
        $name = $value["short_name"];
        $week = $value["week"] + 1;

        $sql = "INSERT INTO Competition (ID, CompName, Week) VALUES (NULL, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../admin_filltables.php?error=sqlerror&name=$name&week=$week");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "si", $name, $week);
            mysqli_stmt_execute($stmt);
        }
    }

    mysqli_close($conn);
    header("Location: ../admin_filltables.php?comptablefill=success");
    exit();

} else {
    header("Location: ../index.php");
    exit();
}