<?php
session_start();
if (isset($_POST['submit'])) {
    include 'dbh-inc.php';
    $uid = $_SESSION['u_uid'];
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $status = mysqli_real_escape_string($conn,$_POST['status']);
    $type = mysqli_real_escape_string($conn,$_POST['type']);
    $content = mysqli_real_escape_string($conn,$_POST['content']);
    if (empty($title) || empty($status) || empty($type)) {
        header("Location: ../posting.php?error=blank");
    }
    else {
        $sql = "INSERT INTO posts (p_user, p_title, p_status, p_type, p_content) VALUES ('$uid', '$title', '$status', '$type', '$content');";
        $result = mysqli_query($conn, $sql);
        header("Location: ../posting.php?post=success");
    }
}