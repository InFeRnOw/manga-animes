<?php
session_start();
    include 'dbh-inc.php';
    $receiver = $_SESSION['u_uid'];
    $link = $_SESSION['u_id'];

    if(isset($_POST['acceptRequest'])) {
      $sender = mysqli_real_escape_string($conn, $_POST['sender']);
      $sql = "UPDATE friends SET f_status=1 WHERE f_receiver='$receiver' AND f_sender='$sender';";
      $result = mysqli_query($conn, $sql);
      header("Location: ../profile.php?request=accepted&link=$link&sender=$sender&receiver=$receiver");
      exit;
    }
    elseif (isset($_POST['refuseRequest'])) {
      $sender = mysqli_real_escape_string($conn, $_POST['sender']);
      $sql = "DELETE FROM friends WHERE f_receiver='$receiver' AND f_sender='$sender';";
      $result = mysqli_query($conn, $sql);
      header("Location: ../profile.php?request=refused&link=$link");
      exit;
    }
