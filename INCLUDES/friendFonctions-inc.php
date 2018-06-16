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
    } //$row['f_sender'] == $actualUser
    else {
        $friend = $row['f_sender'];
        $sql = "DELETE FROM friends WHERE f_sender='$friend' AND f_receiver='$actualUser';";
        $result = mysqli_query($conn, $sql);
        header("Location: ../friend.php?request=deleted&link=$link");
        exit;
    }
} //isset($_POST['delete'])
else if (isset($_POST['chatCreate'])) {
    $friend = mysqli_real_escape_string($conn, $_POST['friend']);
    $sql = "SELECT * FROM chatrooms WHERE chat_to = '$friend' AND chat_from = '$actualUser' OR chat_from = '$friend' AND chat_to = '$actualUser'";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck < 1) {
        $sql = "INSERT INTO chatrooms (chat_to, chat_from) VALUES ('$friend', '$actualUser')";
        $result = mysqli_query($conn, $sql);
        header("Location: ../friend.php?link=$link&chatroom=success");
    } //$resultCheck < 1
    else {
        header("Location: ../friend.php?link=$link&chatroom=exist");
    }
} //isset($_POST['chatCreate'])
else if (isset($_POST['chatOpen'])) {
    $friend = mysqli_real_escape_string($conn, $_POST['friend']);
    $chatRoomId = mysqli_real_escape_string($conn, $_POST['chatroom']);
    header("Location: ../chat.php?chatroom=$chatRoomId&user=$friend");
} //isset($_POST['chatOpen'])
else if (isset($_POST['chatDelete'])) {
    $friend = mysqli_real_escape_string($conn, $_POST['friend']);
    $chatRoomId = mysqli_real_escape_string($conn, $_POST['chatroom']);
    $sql = "DELETE FROM chatrooms WHERE chat_id = '$chatRoomId'";
    $result = mysqli_query($conn, $sql);
    $sql = "DELETE FROM chat WHERE chat_room_id = '$chatRoomId'";
    $result = mysqli_query($conn, $sql);
    header("Location: ../friend.php?chatroom=deleted");
} //isset($_POST['chatDelete'])
