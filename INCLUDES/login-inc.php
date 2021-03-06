<?php
session_start();
if (isset($_POST['submit'])) {
    include 'dbh-inc.php';
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);
    //Error handlers
    //Check if inputs are empty
    if (empty($uid) || empty($pass)) {
        header("Location: ../login.php?login=empty");
        exit();
    } //empty($uid) || empty($pass)
    else {
        $sql = "SELECT * FROM users WHERE user_uid = '$uid'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck < 1) {
            header("Location: ../login.php?login=error");
            exit();
        } //$resultCheck < 1
        else {
            $sql = "SELECT * FROM users WHERE user_uid = '$uid'";
            $result = mysqli_query($conn, $sql);
            if ($row = mysqli_fetch_assoc($result)) {
                $status = $row['user_active'];
                if ($status == 0) {
                    header("Location: ../login.php?login=notactivated");
                    exit();
                } //$status == 0
                else {
                    $sql = "SELECT * FROM users WHERE user_uid = '$uid'";
                    $result = mysqli_query($conn, $sql);
                    if ($row = mysqli_fetch_assoc($result)) {
                        //De-hashing pass
                        $hashedPassCheck = password_verify($pass, $row['user_pass']);
                        if ($hashedPassCheck == false) {
                            header("Location: ../login.php?login=error");
                            exit();
                        } //$hashedPassCheck == false
                        elseif ($hashedPassCheck == true) {
                            $sqlRecovKey = "UPDATE users SET user_forget_key='used' WHERE user_uid='$uid'";
                            $resultRecovKey = mysqli_query($conn, $sqlRecovKey);
                            $sql = "SELECT * FROM users WHERE user_uid = '$uid'";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);
                            //Login in the user here
                            $_SESSION['u_id'] = $row['user_id'];
                            $_SESSION['u_uid'] = $row['user_uid'];
                            $_SESSION['u_email'] = $row['user_email'];
                            $_SESSION['u_rank'] = $row['rank'];
                            header("Location: ../index.php?login=success");
                            exit();
                        } //$hashedPassCheck == true
                    } //$row = mysqli_fetch_assoc($result)
                }
            } //$row = mysqli_fetch_assoc($result)
        }
    }
} //isset($_POST['submit'])
else {
    header("Location: ../login.php");
    exit();
}
// session_start();
// if (isset($_POST['submit'])) {
//     include 'dbh-inc.php';
//     $uid = mysqli_real_escape_string($conn, $_POST['uid']);
//     $pass = mysqli_real_escape_string($conn, $_POST['pass']);
//     //Error handlers
//     //Check if inputs are empty
//     if (empty($uid) || empty($pass)) {
//         header("Location: ../login.php?login=empty");
//         exit();
//     }
//     else {
//         $sql = "SELECT * FROM users WHERE user_uid = '$uid'";
//         $result = mysqli_query($conn, $sql);
//         if ($row = mysqli_fetch_assoc($result)) {
//             $status = $row['user_active'];
//             if ($status == 0) {
//                 header("Location: ../activation.php?account=notactivated");
//                 exit();
//             }
//             else {
//                 $sql = "SELECT * FROM users WHERE user_uid = '$uid'";
//                 $result = mysqli_query($conn, $sql);
//                 $resultCheck = mysqli_num_rows($result);
//                 if ($resultCheck < 1) {
//                     header("Location: ../login.php?login=user");
//                     exit();
//                 }
//                 else {
//                     if ($row = mysqli_fetch_assoc($result)) {
//                         //De-hashing pass
//                         $hashedPassCheck = password_verify($pass, $row['user_pass']);
//                         if ($hashedPassCheck == false) {
//                             header("Location: ../login.php?login=error");
//                             exit();
//                         }
//                         elseif ($hashedPassCheck == true) {
//                             //Login in the user here
//                             $_SESSION['u_id'] = $row['user_id'];
//                             $_SESSION['u_uid'] = $row['user_uid'];
//                             $_SESSION['u_email'] = $row['user_email'];
//                             header("Location: ../index.php?login=success");
//                             exit();
//                         }
//                     }
//                 }
//             }
//         }
//     }
// }
// else {
//     header("Location: ../index.php?login=error");
//     exit();
// }
