<?php
    if (isset($_POST['submit'])) {
      session_start();
      include 'dbh-inc.php';
      $friend = mysqli_real_escape_string($conn, $_POST['friend']);
      $chatRoomId = mysqli_real_escape_string($conn, $_POST['chatroom']);
      $user = $_SESSION['u_uid'];
      $text = mysqli_real_escape_string($conn, $_POST['chatText']);
      $insert = $text;

        $sql = "INSERT INTO chat (chat_room_id, chat_room_text, chat_room_sender) VALUES ('$chatRoomId', '$insert', '$user')";
        $result = mysqli_query($conn, $sql);
        header("Location: ../chat.php?send=success&friend=$friend&chatroom=$chatRoomId");
    }
