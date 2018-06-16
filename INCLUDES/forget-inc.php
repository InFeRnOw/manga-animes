<?php
session_start();
if (isset($_POST['submit'])) {
    include 'dbh-inc.php';
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    if (empty($email)) {
        header("Location: ../forget.php?forget=empty");
        exit();
    } //empty($email)
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../forget.php?forget=emailinvalid");
        exit();
    } //!filter_var($email, FILTER_VALIDATE_EMAIL)
    else {
        $sql = "SELECT * FROM users WHERE user_email = '$email'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck < 1) {
            header("Location: ../forget.php?forget=emailinvalid");
            exit();
        } //$resultCheck < 1
        else {
            $sql = "SELECT * FROM users WHERE user_email = '$email'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $cle = md5(microtime(TRUE) * 100000);
            $sql = "UPDATE users SET user_forget_key='$cle' WHERE user_email='$email'";
            $result = mysqli_query($conn, $sql);
            $link = "https://www.manga-animes.com/recover.php?recover&key=" . $cle . "&username=" . $row['user_uid'];
            /* A SUIVRE */
            $destinataire = $email;
            $sujet = "Forgot your password";
            $entete = "manga-animes.com";
            $message = 'Welcome back on manga-animes,
You recently requested to reset your password or forgot your username.
Your username: ' . $row["user_uid"] . ',
Link to reset password: ' . $link . '
--------------------------------------------------
This is an automatic mail, please do not respond.';
            mail($destinataire, $sujet, $message, $entete);
            header("Location: ../login.php?forget=success");
        }
    }
} //isset($_POST['submit'])
