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
        header("Location: ../register.php?register=empty");
    }
    else {
        //Check if email is valid
        if ($pass1 !== $pass2) {
            header("Location: ../register.php?register=passwordconfirm");
        }
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: ../register.php?register=emailinvalid");
            exit();
        }
        else {
            $sql = "SELECT * FROM users WHERE user_uid = '$uid'";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);

            if ($resultCheck > 0) {
                header("Location: ../register.php?register=usernametaken");
                exit();
            }
            elseif ($resultCheck == 0) {
                $sql = "SELECT * FROM users WHERE user_email = '$email'";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);

                if ($resultCheck > 0) {
                    header("Location: ../register.php?register=emailtaken");
                    exit();
                }
                else {
                    $hashedPass = password_hash($pass1, PASSWORD_DEFAULT);
                    //Email confirmation
                    $cle = md5(microtime(TRUE)*100000);
                    //Insert the user into the database
                    $sql = "INSERT INTO users (user_uid, user_email, user_pass, user_key) VALUES ('$uid', '$email', '$hashedPass', '$cle');";
                    $result = mysqli_query($conn, $sql);

                    $sql = "SELECT * FROM users WHERE user_uid = '$uid'";
                    $result = mysqli_query($conn, $sql);

                    $destinataire = $email;
                    $sujet = "Activate your account";
                    $entete = "manga-animes.com";
                    $message = 'Welcome on manga-animes,

To activate your account, please copy your code.

your confirmation code: ' .$cle.'


---------------
This is an automatic mail, please do not respond.';

mail($destinataire, $sujet, $message, $entete);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $userid = $row['user_id'];
                            $sql = "INSERT INTO profileimg (userid, status) VALUES ('$userid', 1)";
                            mysqli_query($conn, $sql);
                        }
                    }
                    header("Location: ../login.php?register=success");
                    exit();
                }
            }
        }
    }

}
else {
    header("Location: ../register.php");
    exit();
}
