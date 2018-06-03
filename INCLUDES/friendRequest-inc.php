<?php
session_start();
if (isset($_POST['addSubmit'])) {
    include 'dbh-inc.php';
    $link = $_SESSION['u_id'];
    $sender = $_SESSION['u_uid'];
    $receiver = mysqli_real_escape_string($conn, $_POST['userAdd']);
    //Error handlers
    //Check if inputs are empty
    if (empty($sender) || empty($receiver) || $receiver == $sender) {
        header("Location: ../profile.php?add=error&link=$link");
        exit();
    }
    else {
      $sql = "SELECT * FROM users WHERE user_uid = '$receiver'";
      $result = mysqli_query($conn, $sql);
      $resultCheck = mysqli_num_rows($result);
      if ($resultCheck < 1) {
        header("Location: ../profile.php?add=noexist&link=$link");
          exit();
      }
      else {
        $sql = "SELECT * FROM users WHERE user_uid = '$receiver'";
        $result = mysqli_query($conn, $sql);
        if ($row = mysqli_fetch_assoc($result)) {
            $status = $row['user_active'];
            if ($status == 0) {
                header("Location: ../profile.php?add=userNotActive&link=$link");
                exit();
            }
            else {
              $sql = "SELECT * FROM friends WHERE f_sender='$sender' AND f_receiver='$receiver'";
              $result = mysqli_query($conn, $sql);
              $resultCheck = mysqli_num_rows($result);
                  if ($resultCheck > 0) {
                    header("Location: ../profile.php?add=alreadyAdded&link=$link");
                  }
                  else {
                    $sql = "INSERT INTO friends (f_sender, f_receiver, f_status) VALUES ('$sender', '$receiver', 0)";
                    $result = mysqli_query($conn, $sql);
                    header("Location: ../profile.php?add=success&link=$link");
                    exit();
                  }
               }
            }
         }
      }
   }
   else {
     header("Location: ../profile.php?add=errorUnknown&link=$link");
     exit();
   }
