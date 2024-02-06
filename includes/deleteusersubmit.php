<?php
if (isset($_POST['delete-user-submit'])) {
    require 'dbh.php';

    $username = $_GET['userID'];

    $sql = "DELETE FROM Users WHERE UserName=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../deleteuser.php?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);

        header("Location: ../admin_accessmanagement.php?deleteuser=success");
        exit();
    }
} else {
    header("Location: ../index.php");
    exit();
}
?>