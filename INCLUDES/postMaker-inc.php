<?php
session_start();
if (isset($_POST['submit'])) {
    include 'dbh-inc.php';
    $uid = $_SESSION['u_uid'];
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $status = mysqli_real_escape_string($conn,$_POST['status']);
    $type = mysqli_real_escape_string($conn,$_POST['type']);
    $content = mysqli_real_escape_string($conn,$_POST['content']);

    $pageLinkFirstPart = uniqid('post', TRUE);
    $pageLinkSecondPart = uniqid('end', TRUE);
    $pageLink = $pageLinkFirstPart . $pageLinkSecondPart;

    $titleEn = mysqli_real_escape_string($conn,$_POST['titleEn']);
    $genre = mysqli_real_escape_string($conn,$_POST['genre']);
    $statusManga = mysqli_real_escape_string($conn,$_POST['statusManga']);
    if (empty($title) || empty($status) || empty($type) || empty($titleEn) || empty($genre) || empty($statusManga) || empty($content)) {
        header("Location: ../posting.php?posting=blank&title=$title&status=$status&type=$type&titleEn=$titleEn&genre=$genre&statusManga=$statusManga&content=$content");
    }
    else {
        $sql = "INSERT INTO posts (p_user, p_title, p_status, p_type, p_content, p_link, p_titleen, p_genre, p_statusmanga) VALUES ('$uid', '$title', '$status', '$type', '$content', '$pageLink', '$titleEn', '$genre', '$statusManga');";
        $result = mysqli_query($conn, $sql);
        header("Location: ../post.php?posting=success&link=$pageLink");
    }
}
