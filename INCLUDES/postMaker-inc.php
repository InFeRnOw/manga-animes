<?php
session_start();
if (isset($_POST['submit'])) {
    include 'dbh-inc.php';
    $uid = $_SESSION['u_uid'];
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $status = mysqli_real_escape_string($conn,$_POST['status']);
    $type = mysqli_real_escape_string($conn,$_POST['type']);
    $content = mysqli_real_escape_string($conn,$_POST['content']);
    $pageLink = mt_rand(1,999999);
    $titleEn = mysqli_real_escape_string($conn,$_POST['titleEn']);
    $genre = mysqli_real_escape_string($conn,$_POST['genre']);
    $statusManga = mysqli_real_escape_string($conn,$_POST['statusManga']);
    if (empty($title) || empty($status) || empty($type) || empty($titleEn) || empty($genre) || empty($statusManga)) {
        header("Location: ../posting.php?error=blank");
    }
    else {
        $sql = "INSERT INTO posts (p_user, p_title, p_status, p_type, p_content, p_link, p_titleen, p_genre, p_statusmanga) VALUES ('$uid', '$title', '$status', '$type', '$content', '$pageLink', '$titleEn', '$genre', '$statusManga');";
        $result = mysqli_query($conn, $sql);
        header("Location: ../post.php?post=success&link=$pageLink");
    }
}
