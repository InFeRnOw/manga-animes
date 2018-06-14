<?php
session_start();
    include 'dbh-inc.php';
    $actualUser = $_SESSION['u_uid'];
    $link = $_SESSION['u_id'];

    if (isset($_POST['delete'])) {
      $sql = "SELECT * FROM friends WHERE f_receiver = '$actualUser' AND f_status = 1 OR f_sender= '$actualUser' AND f_status = 1 ORDER BY f_id DESC";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);

      if ($row['f_sender'] == $actualUser) {
        $friend = $row['f_receiver'];
        $sql = "DELETE FROM friends WHERE f_receiver='$friend' AND f_sender='$actualUser';";
        $result = mysqli_query($conn, $sql);
        header("Location: ../friend.php?request=deleted&link=$link");
        exit;
      }
      else {
        $friend = $row['f_sender'];
        $sql = "DELETE FROM friends WHERE f_sender='$friend' AND f_receiver='$actualUser';";
        $result = mysqli_query($conn, $sql);
        header("Location: ../friend.php?request=deleted&link=$link");
        exit;
      }
    }
    else if (isset($_POST['chatCreate'])) {
      $friend = mysqli_real_escape_string($conn, $_POST['friend']);

      $sql = "SELECT * FROM chatrooms WHERE chat_to = '$friend' OR chat_from= '$friend'";
      $result = mysqli_query($conn, $sql);
      $resultCheck = mysqli_num_rows($result);

      if ($resultCheck < 1) {
        $sql = "INSERT INTO chatrooms (chat_to, chat_from) VALUES ('$friend', '$actualUser')";
        $result = mysqli_query($conn, $sql);
        header("Location: ../friend.php?link=$link&chatroom=success");
      }
      else {
        header("Location: ../friend.php?link=$link&chatroom=exist");
      }
    }
    else if (isset($_POST['chatOpen'])) {
      $friend = mysqli_real_escape_string($conn, $_POST['friend']);
      $chatRoomId = mysqli_real_escape_string($conn, $_POST['chatroom']);

      header("Location: ../chat.php?chatroom=$chatRoomId&friend=$friend");
    }
