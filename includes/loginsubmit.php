<?php
if (isset($_POST['login-submit'])) {
    require 'dbh.php';

    $emailuid = $_POST['emailuid'];
    $password = $_POST['pwd'];

    if (empty($emailuid) || empty($password)) {
        throwError("emptyfields");
    } else {
        $sql = "SELECT * FROM Users WHERE Email=? OR UserName=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            throwError("sqlerror");
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $emailuid, $emailuid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                $pwdCheck = password_verify($password, $row['Pwd']);
                if ($pwdCheck == false) {
                    throwError("wrongpassword");
                } else if ($pwdCheck == true) {
                    session_start();
                    $_SESSION['userID'] = $row['UserName'];
                    $_SESSION['userRole'] = $row['Role'];

                    header("Location: ../index.php?login=success");
                    exit();
                } else {
                    throwError("wrongpassword");
                }
            } else {
                throwError("nouser");
            }
        }
    }

} else {
    header("Location: ../index.php");
    exit();
}

function throwError($errorName) {
    header("Location: ../login.php?error=$errorName");
    exit();
}
?>