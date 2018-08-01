<?php
session_start();
include 'dbh-inc.php';

if (isset($_POST['submit'])) {
    $name = $_SESSION['u_uid'];
    $email = $_SESSION['u_email'];
    $subject = mysqli_real_escape_string($conn, $_POST['bugSubject']);
    $text = mysqli_real_escape_string($conn, $_POST['bugText']);

    if (empty($text)) {
        header("Location: ../bug-report.php?report=empty");
        exit();
    }
    else {
        $sql = "INSERT INTO bugreport (bugr_author, bugr_email, bugr_subject, bugr_text) VALUES ('$name', '$email', '$subject', '$text');";
        $result = mysqli_query($conn, $sql);
        header("Location: ../bug-report.php?report=success");
    }
}
elseif (isset($_POST['delete'])) {
    $reportId = mysqli_real_escape_string($conn, $_POST['reportId']);
    $sql = "DELETE FROM bugreport WHERE bugr_id='$reportId'";
    $result = mysqli_query($conn, $sql);
    header("Location: ../staff-panel.php?report=deleted#bugReports");
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
