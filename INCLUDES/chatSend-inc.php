<?php
if (isset($_POST['submit'])) {
    session_start();
    include 'dbh-inc.php';
    $friend = mysqli_real_escape_string($conn, $_POST['friend']);
    $chatRoomId = mysqli_real_escape_string($conn, $_POST['chatroom']);
    $user = $_SESSION['u_uid'];
    $userid = $_SESSION['u_id'];
    $text = mysqli_real_escape_string($conn, $_POST['chatText']);
    $insert = $text;
    $timeH = date("G:i:s");
    $timeD = date("Y-m-d");
    if (empty($text)) {
        header("Location: ../chat.php?send=empty&friend=$friend&chatroom=$chatRoomId");
    } //empty($text)
    else {
        $sql = "INSERT INTO chat (chat_room_id, chat_room_text, chat_room_sender, chat_room_sender_id, chat_room_timeh, chat_room_timed) VALUES ('$chatRoomId', '$insert', '$user', '$userid', '$timeH', '$timeD')";
        $result = mysqli_query($conn, $sql);
        header("Location: ../chat.php?send=success&friend=$friend&chatroom=$chatRoomId");
    }
} //isset($_POST['submit'])
