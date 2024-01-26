<?php
if (isset($_POST['edit-role-submit'])) {
    require 'dbh.php';

    $email = $_POST['email'];
    $username = $_POST['username'];
    $userrole = $_POST['role'];

    $sql = "UPDATE Users SET Role=? WHERE UserName=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../edituserrole.php?error=sqlerror");
        exit();			 
    } else {
        mysqli_stmt_bind_param($stmt, "ss", $userrole, $username);
        mysqli_stmt_execute($stmt);

        header("Location: ../admin_accessmanagement.php?editrole=success");
        exit();
    }
} else {
    header("Location: ../index.php");
    exit();
}
?>