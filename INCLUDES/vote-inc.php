<?php
session_start();
include_once 'dbh-inc.php';
$post = $_SESSION['link'];
if (isset($_POST['accept'])) {
    $sql = "SELECT * FROM posts WHERE p_link = '$post'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $likes = $row['p_likes'];
    $dislikes = $row['p_dislikes'];
    $sql = "UPDATE posts SET p_active=1 WHERE p_link='$post'";
    $result = mysqli_query($conn, $sql);
    header("Location: ../post.php?accept=success&link=$post");
    exit();
} //isset($_POST['accept'])
else if (isset($_POST['deny'])) {
    $sql = "SELECT * FROM posts WHERE p_link = '$post'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $file = "uploads/postsimages/postimg" . $post . ".jpg";
    unlink($file);
    $likes = $row['p_likes'];
    $dislikes = $row['p_dislikes'];
    $sql = "DELETE FROM posts WHERE p_link='$post'";
    $result = mysqli_query($conn, $sql);
    header("Location: ../in-vote.php?deny=success&link=$post");
    exit();
} //isset($_POST['deny'])
else if (isset($_POST['delete'])) {
    $sql = "SELECT * FROM posts WHERE p_link = '$post'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $file = "uploads/postsimages/postimg" . $post . ".jpg";
    unlink($file);
    $likes = $row['p_likes'];
    $dislikes = $row['p_dislikes'];
    $sql = "DELETE FROM posts WHERE p_link='$post'";
    $result = mysqli_query($conn, $sql);
    header("Location: ../alphabetic-order.php?delete=success&link=$post");
    exit();
} //isset($_POST['delete'])
else if (isset($_POST['like'])) {
    $user = $_SESSION['u_uid'];
    $sql = "SELECT * FROM votes WHERE v_link='$post'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row['v_user'] !== $user) {
        $sql = "SELECT * FROM posts WHERE p_link = '$post'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $likes = $row['p_likes'];
        $dislikes = $row['p_dislikes'];
        $sql = "UPDATE posts SET p_likes=p_likes + 1 WHERE p_link='$post'";
        $result = mysqli_query($conn, $sql);
        $sql = "INSERT INTO votes (v_user, v_link) VALUES ('$user', '$post')";
        $result = mysqli_query($conn, $sql);
        if ($likes == 49) {
            $sql = "UPDATE posts SET p_active=1 WHERE p_link='$post'";
            $result = mysqli_query($conn, $sql);
            $sql = "DELETE FROM votes WHERE v_link='$post'";
            $result = mysqli_query($conn, $sql);
            header("Location: ../alphabetic-order.php?vote=success&link=$post");
            exit();
        } //$likes == 49
        else {
            header("Location: ../post.php?vote=success&link=$post");
            exit();
        }
    } //$row['v_user'] !== $user
    else {
        header("Location: ../post.php?vote=already&link=$post");
    }
} //isset($_POST['like'])
else if (isset($_POST['dislike'])) {
    $user = $_SESSION['u_uid'];
    $sql = "SELECT * FROM votes WHERE v_link='$post'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row['v_user'] !== $user) {
        $sql = "SELECT * FROM posts WHERE p_link = '$post'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $likes = $row['p_likes'];
        $dislikes = $row['p_dislikes'];
        $sql = "UPDATE posts SET p_dislikes=p_dislikes + 1 WHERE p_link='$post'";
        $result = mysqli_query($conn, $sql);
        $sql = "INSERT INTO votes (v_user, v_link) VALUES ('$user', '$post')";
        $result = mysqli_query($conn, $sql);
        if ($dislikes == 49) {
            $sql = "DELETE FROM posts WHERE p_link='$post'";
            $result = mysqli_query($conn, $sql);
            $sql = "DELETE FROM votes WHERE v_link='$post'";
            $result = mysqli_query($conn, $sql);
            header("Location: ../in-vote.php?vote=success&link=$post");
            exit();
        } //$dislikes == 49
        else {
            header("Location: ../post.php?vote=success&link=$post");
            exit();
        }
    } //$row['v_user'] !== $user
    else {
        header("Location: ../post.php?vote=already&link=$post");
    }
} //isset($_POST['dislike'])
else if (isset($_POST['edit'])) {
    $sqlCheck = "SELECT * FROM posts WHERE p_link='$post'";
    $resultCheck = mysqli_query($conn, $sqlCheck);
    $rowCheck = mysqli_fetch_assoc($resultCheck);
    if ($rowCheck['p_seasoncenter'] > 0 && $rowCheck['p_episodescenter'] > 0) {
        $sql = "SELECT * FROM posts WHERE p_link='$post'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $title = $row['p_title'];
        $titleEn = $row['p_titleen'];
        $content = $row['p_content'];
        $status = $row['p_status'];
        $statusManga = $row['p_statusmanga'];
        $adaptation = $row['p_adaptation'];
        $type = $row['p_type'];
        $seasonc = $row['p_seasoncenter'];
        $episodesc = $row['p_episodescenter'];
        header("Location: ../posting-center.php?edit&link=$post&title=$title&titleEn=$titleEn&seasonc=$seasonc&episodesc=$episodesc&status=$status&statusm=$statusManga&adaptation=$adaptation&type=$type");
    }
    else {
        $sql = "SELECT * FROM posts WHERE p_link='$post'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $title = $row['p_title'];
        $titleEn = $row['p_titleen'];
        $content = $row['p_content'];
        $season = $row['p_season'];
        $episodes = $row['p_episodes'];
        $status = $row['p_status'];
        $statusManga = $row['p_statusmanga'];
        $adaptation = $row['p_adaptation'];
        $type = $row['p_type'];
        $myAnimeList = $row['p_linkmyanime'];
        header("Location: ../posting.php?edit&link=$post&title=$title&titleEn=$titleEn&season=$season&episodes=$episodes&status=$status&statusm=$statusManga&adaptation=$adaptation&type=$type&linkMyAnime=$myAnimeList");
    }
} //isset($_POST['edit'])
else {
    header("Location: ../in-vote.php?vote=error");
    exit();
}
