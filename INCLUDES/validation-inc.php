<?php
include_once 'dbh-inc.php';
if (isset($_POST['submit'])) {
    $uid = mysqli_real_escape_string($conn, $_POST['username']);
    $cle = mysqli_real_escape_string($conn, $_POST['cle']);
    $sql = "SELECT * FROM users WHERE user_key = '$cle'";
    $result = mysqli_query($conn, $sql);
        if ($row = mysqli_fetch_assoc($result)) {
            if ($row['user_key'] == $cle) {
                $sql = "UPDATE users SET user_active=1 WHERE user_uid='$uid'";
                $result = mysqli_query($conn, $sql);
                header("Location: ../login.php?account=activated");
                exit();
            }
        }
        else {
            header("Location: ../activation.php?code=invalid");
        }
    }
    
