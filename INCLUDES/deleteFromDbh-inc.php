<?php
session_start();
include 'dbh-inc.php';

///////////////
/*Bug Report*/
//////////////

if (isset($_POST['deleteBugReport'])) {
    $reportId = mysqli_real_escape_string($conn, $_POST['reportId']);
    $sql = "DELETE FROM bugreport WHERE bugr_id='$reportId'";
    $result = mysqli_query($conn, $sql);
    header("Location: ../staff-panel.php?report=deleted");
}
elseif (isset($_POST['chatCreate'])) {
    $actualUser = $_SESSION['u_uid'];
    $user = mysqli_real_escape_string($conn, $_POST['user']);
    $sql = "SELECT * FROM chatrooms WHERE chat_to = '$user' AND chat_from = '$actualUser' OR chat_from = '$user' AND chat_to = '$actualUser'";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck < 1) {
        $sql = "INSERT INTO chatrooms (chat_to, chat_from) VALUES ('$user', '$actualUser')";
        $result = mysqli_query($conn, $sql);
        $sql = "SELECT * FROM chatrooms WHERE chat_to = '$user' AND chat_from = '$actualUser' OR chat_from = '$user' AND chat_to = '$actualUser'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $chatRoomId = $row['chat_id'];
        header("Location: ../chat.php?chatroom=$chatRoomId&user=$user");
    } //$resultCheck < 1
    else {
        $sql = "SELECT * FROM chatrooms WHERE chat_to = '$user' AND chat_from = '$actualUser' OR chat_from = '$user' AND chat_to = '$actualUser'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $chatRoomId = $row['chat_id'];
        header("Location: ../chat.php?chatroom=$chatRoomId&user=$user");
    }
}
