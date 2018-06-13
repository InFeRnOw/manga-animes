<?php
session_start();
if (isset($_POST['submit'])) {
    include 'dbh-inc.php';
    $uid = $_SESSION['u_uid'];
    $pageLink = $_SESSION['link'];

    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $status = mysqli_real_escape_string($conn,$_POST['status']);
    $type = mysqli_real_escape_string($conn,$_POST['type']);
    $content = mysqli_real_escape_string($conn,$_POST['content']);

    $titleEn = mysqli_real_escape_string($conn,$_POST['titleEn']);
    $genre = mysqli_real_escape_string($conn,$_POST['genre']);
    $statusManga = mysqli_real_escape_string($conn,$_POST['statusManga']);
    $adaptation = mysqli_real_escape_string($conn,$_POST['adaptation']);
    $season = mysqli_real_escape_string($conn,$_POST['season']);
    $episodes = mysqli_real_escape_string($conn,$_POST['episodes']);
    
    if (empty($title) || empty($status) || empty($type) || empty($titleEn) || empty($genre) || empty($statusManga) || empty($content)|| empty($adaptation) || empty($season) || empty($episodes)) {
        header("Location: ../posting.php?edit=editing&posting=blank&title=$title&status=$status&type=$type&titleEn=$titleEn&genre=$genre&statusManga=$statusManga&content=$content&adaptation=$adaptation&season=$season&episodes=$episodes");
    }
    else {
        $sql = "UPDATE posts SET p_title='$title', p_status='$status', p_type='$type', p_content='$content', p_titleen='$titleEn', p_genre='$genre', p_statusmanga='$statusManga', p_adaptation='$adaptation', p_season='$season', p_episodes='$episodes' WHERE p_link='$pageLink';";
        $result = mysqli_query($conn, $sql);
        header("Location: ../post.php?posting=success&link=$pageLink");
    }
}
