<?php
session_start();
include 'dbh-inc.php';
$actualUser = $_SESSION['u_uid'];
$sql = "SELECT * FROM chatrooms WHERE chat_to = '$actualUser' OR chat_from = '$actualUser' ORDER BY chat_id DESC";
$result = mysqli_query($conn, $sql);
$count = 0;
while ($row = mysqli_fetch_assoc($result)) {
    if ($row['chat_from'] !== $actualUser) {
        $friend = $row['chat_from'];
        $sql2 = "SELECT * FROM chatrooms WHERE chat_from = '$friend' AND chat_to = '$actualUser'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $chatRoomId = $row2['chat_id'];
        $sql3 = "SELECT * FROM chat WHERE chat_room_id = '$chatRoomId' AND chat_room_read = 0 AND chat_room_sender = '$friend' LIMIT 1";
        $result3 = mysqli_query($conn, $sql3);
        while ($row3 = mysqli_fetch_assoc($result3)) {
            $count++;
            $_SESSION['notifications_counter'] = $count;
            if ($count > 0) {
                echo '<li><a href="chat.php?chatroom='.$chatRoomId.'&user='.$friend.'"><b>Chat with '.$friend.'</b></a></li>';
            }
        }
    }
    else {
        $friend = $row['chat_to'];
        $sql2 = "SELECT * FROM chatrooms WHERE chat_to = '$friend' AND chat_from = '$actualUser'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $chatRoomId = $row2['chat_id'];
        $sql3 = "SELECT * FROM chat WHERE chat_room_id = '$chatRoomId' AND chat_room_read = 0 AND chat_room_sender = '$friend' LIMIT 1";
        $result3 = mysqli_query($conn, $sql3);
        while ($row3 = mysqli_fetch_assoc($result3)) {
            $count++;
            $_SESSION['notifications_counter'] = $count;
            if ($count > 0) {
                echo '<li><a href="chat.php?chatroom='.$chatRoomId.'&user='.$friend.'"><b>Chat with '.$friend.'</b></a></li>';
            }
        }
    }
} //$row = mysqli_fetch_assoc($result)

if ($count == 0) {
    echo '<li><b>No notifications</b></li>';
}
