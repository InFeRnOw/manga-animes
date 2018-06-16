<?php
session_start();
if (isset($_POST['submit'])) {
    include 'dbh-inc.php';
    $cle = mysqli_real_escape_string($conn, $_POST['key']);
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $newPass = mysqli_real_escape_string($conn, $_POST['newpass']);
    $newPassConfirm = mysqli_real_escape_string($conn, $_POST['newpassconfirm']);
    $sql = "SELECT * FROM users WHERE user_uid='$user'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row['user_forget_key'] !== $cle) {
        header("Location: ../forget.php?forget=false");
        exit();
    } //$row['user_forget_key'] !== $cle
    else {
        if (empty($newPass) || empty($newPassConfirm)) {
            header("Location: ../recover.php?recover=empty&key=$cle&username=$user");
        } //empty($newPass) || empty($newPassConfirm)
        else {
            if ($newPass == $row['user_pass'] || $newPassConfirm == $row['user_pass']) {
                header("Location: ../login.php?login=same");
            } //$newPass == $row['user_pass'] || $newPassConfirm == $row['user_pass']
            else {
                if ($newPass !== $newPassConfirm) {
                    header("Location: ../recover.php?recover=passnotsame&key=$cle&username=$user");
                } //$newPass !== $newPassConfirm
                else {
                    $sql = "UPDATE users SET user_forget_key='used' WHERE user_uid='$user'";
                    $result = mysqli_query($conn, $sql);
                    $hashedPass = password_hash($newPass, PASSWORD_DEFAULT);
                    $sql = "UPDATE users SET user_pass='$hashedPass' WHERE user_uid='$user'";
                    $result = mysqli_query($conn, $sql);
                    header("Location: ../login.php?recover=success&user=$user&key=$cle");
                    exit();
                }
            }
        }
    }
} //isset($_POST['submit'])
