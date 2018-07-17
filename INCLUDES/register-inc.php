<?php
if (isset($_POST['submit'])) {
    include_once 'dbh-inc.php';
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $pass1 = mysqli_real_escape_string($conn, $_POST['pass1']);
    $pass2 = mysqli_real_escape_string($conn, $_POST['pass2']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    //Error handlers
    //Check for empty fields
    if (empty($uid) || empty($pass1) || empty($email) || empty($pass2)) {
        header("Location: ../register.php?register=empty&uid=$uid&email=$email");
        exit();
    } //empty($uid) || empty($pass1) || empty($email) || empty($pass2)
    else {
        //Check if email is valid
        if ($pass1 !== $pass2) {
            header("Location: ../register.php?register=passwordconfirm&uid=$uid&email=$email");
            exit();
        } //$pass1 !== $pass2
        elseif (preg_match("/([%\$#\*']+)/", $uid) || preg_match('/([%\$#\*"]+)/', $uid)) {
            header("Location: ../register.php?register=specialchars");
            exit();
        } //preg_match("/([%\$#\*']+)/", $uid) || preg_match('/([%\$#\*"]+)/', $uid)
            elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: ../register.php?register=emailinvalid&uid=$uid&email");
            exit();
        } //!filter_var($email, FILTER_VALIDATE_EMAIL)
        else {
            $sql = "SELECT * FROM users WHERE user_uid = '$uid'";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            if ($resultCheck > 0) {
                header("Location: ../register.php?register=usernametaken&uid=$uid&email=$email");
                exit();
            } //$resultCheck > 0
            elseif ($resultCheck == 0) {
                $sql = "SELECT * FROM users WHERE user_email = '$email'";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                if ($resultCheck > 0) {
                    header("Location: ../register.php?register=emailtaken&uid=$uid&email=$email");
                    exit();
                } //$resultCheck > 0
                else {
                    $hashedPass = password_hash($pass1, PASSWORD_DEFAULT);
                    //Email confirmation
                    $cle = md5(microtime(TRUE) * 100000);
                    //Insert the user into the database
                    $sql = "INSERT INTO users (user_uid, user_email, user_pass, user_key, rank) VALUES ('$uid', '$email', '$hashedPass', '$cle', 3);";
                    $result = mysqli_query($conn, $sql);
                    $sql = "SELECT * FROM users WHERE user_uid = '$uid'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $id = $row['user_id'];
                    $destinataire = $email;
                    $sujet = "Activate your account";
                    $entete = "manga-animes.com";
                    $message = 'Welcome on manga-animes,

To activate your account, please go to this link.

your activation link: https://www.manga-animes.com/verify.php?cle=' . $cle . '&id=' . $id . '&uid=' . $uid . '


---------------
This is an automatic mail, please do not respond.';
                    if (mail($destinataire, $sujet, $message, $entete)) {
                        header("Location: ../login.php?register=success&uid=$uid");
                        exit();
                    } //mail($destinataire, $sujet, $message, $entete)
                }
            } //$resultCheck == 0
        }
    }
} //isset($_POST['submit'])
else {
    header("Location: ../register.php");
    exit();
}
