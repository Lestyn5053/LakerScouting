<?php
if (isset($_POST['delete-match-submit'])) {
    require 'dbh.php';

    $ID = $_GET['ID'];
    $CompID = $_GET['CompID'];

    $sql = "DELETE FROM MatchStats WHERE ID=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../deletematch.php?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "i", $ID);
        mysqli_stmt_execute($stmt);

        header("Location: ../admin_editdata.php?CompID=$CompID&deletedata=success");
        exit();
    }
} else {
    header("Location: ../index.php");
    exit();
}
?>