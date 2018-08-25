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
    $sql = "UPDATE posts SET p_active='1' WHERE p_link='$post'";
    $result = mysqli_query($conn, $sql);
    $sqlGet = "SELECT * FROM posts WHERE p_link='$post'";
    $resultGet = mysqli_query($conn, $sqlGet);
    $resultGetRows = mysqli_fetch_assoc($resultGet);
    $title = $resultGetRows["p_title"];
    $season = $resultGetRows["p_season"];
    $pageLinkTitle = str_replace(" ", "_", $title);
    $pageLinkSeason = "_" . $season;
    $pageLink = $pageLinkTitle . $pageLinkSeason;
    $sqlChangeLink = "UPDATE posts SET p_link='$pageLink' WHERE p_link='$post'";
    $resultChangeLink = mysqli_query($conn, $sqlChangeLink);
    header("Location: ../post.php?posting=accepted&link=$pageLink");
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
    $user = $_SESSION['u_uid'];
    $sql = "UPDATE posts SET p_active='3', p_lastedited='$user' WHERE p_link='$post'";
    $result = mysqli_query($conn, $sql);
    header("Location: ../in-vote.php?posting=denied&link=$post");
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
    $user = $_SESSION['u_uid'];
    $sql = "UPDATE posts SET p_active='4', p_lastedited='$user' WHERE p_link='$post'";
    $result = mysqli_query($conn, $sql);
    header("Location: ../alphabetic-order.php?posting=deleted&link=$post");
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
            $sql = "UPDATE posts SET p_active='1' WHERE p_link='$post'";
            $result = mysqli_query($conn, $sql);
            $sql = "DELETE FROM votes WHERE v_link='$post'";
            $result = mysqli_query($conn, $sql);
            $sqlGet = "SELECT * FROM posts WHERE p_link='$post'";
            $resultGet = mysqli_query($conn, $sqlGet);
            $resultGetRows = mysqli_fetch_assoc($resultGet);
            $title = $resultGetRows["p_title"];
            $season = $resultGetRows["p_season"];
            $pageLinkTitle = str_replace(" ", "_", $title);
            $pageLinkSeason = "_" . $season;
            $pageLink = $pageLinkTitle . $pageLinkSeason;
            $sqlChangeLink = "UPDATE posts SET p_link='$pageLink' WHERE p_link='$post'";
            $resultChangeLink = mysqli_query($conn, $sqlChangeLink);
            header("Location: ../post.php?posting=votesuccess&link=$pageLink");
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
            $sql = "UPDATE posts SET p_active='3', p_lastedited='Vote' WHERE p_link='$post'";
            $result = mysqli_query($conn, $sql);
            $sql = "DELETE FROM votes WHERE v_link='$post'";
            $result = mysqli_query($conn, $sql);
            header("Location: ../in-vote.php?posting=votedeny&link=$post");
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
        $_SESSION['SaveTemp_title'] = $row['p_title'];
        $_SESSION['SaveTemp_titleEn'] = $row['p_titleen'];
        $_SESSION['contentTemp'] = $row['p_content'];
        $_SESSION['SaveTemp_status'] = $row['p_status'];
        $_SESSION['SaveTemp_statusManga'] = $row['p_statusmanga'];
        $_SESSION['SaveTemp_adaptation'] = $row['p_adaptation'];
        $_SESSION['SaveTemp_type'] = $row['p_type'];
        $_SESSION['SaveTemp_season'] = $row['p_seasoncenter'];
        $_SESSION['SaveTemp_episodes'] = $row['p_episodescenter'];
        $_SESSION['SaveTemp_genre'] = $row['p_genre'];
        $_SESSION['SaveTemp_Creator'] = $row['p_imgcreditsname'];
        $_SESSION['SaveTemp_CreatorPage'] = $row['p_imgcreditslink'];
        header("Location: ../posting-center.php?edit&link=$post");
    }
    else {
        $sql = "SELECT * FROM posts WHERE p_link='$post'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $_SESSION['SaveTemp_title'] = $row['p_title'];
        $_SESSION['SaveTemp_titleEn'] = $row['p_titleen'];
        $_SESSION['contentTemp'] = $row['p_content'];
        $_SESSION['SaveTemp_season'] = $row['p_season'];
        $_SESSION['SaveTemp_episodes'] = $row['p_episodes'];
        $_SESSION['SaveTemp_status'] = $row['p_status'];
        $_SESSION['SaveTemp_studio'] = $row['p_studio'];
        $_SESSION['SaveTemp_adaptation'] = $row['p_adaptation'];
        $_SESSION['SaveTemp_type'] = $row['p_type'];
        $_SESSION['SaveTemp_linkMyAnime'] = $row['p_linkmyanime'];
        $_SESSION['SaveTemp_genre'] = $row['p_genre'];
        $_SESSION['SaveTemp_Creator'] = $row['p_imgcreditsname'];
        $_SESSION['SaveTemp_CreatorPage'] = $row['p_imgcreditslink'];
        header("Location: ../posting.php?edit&link=$post");
    }
} //isset($_POST['edit'])
else if (isset($_POST['deletePostPerm'])) {
    $postLink = mysqli_real_escape_string($conn, $_POST['postLink']);
    $file = "uploads/postsimages/postimg" . $postLink . ".jpg";
    unlink($file);
    $sql = "DELETE FROM posts WHERE p_link='$postLink'";
    $result = mysqli_query($conn, $sql);
    header("Location: ../staff-panel.php?post=delete&link=$post#inactivePosts");
    exit();
}
else if (isset($_POST['reactivatePost'])) {
    $postLink = mysqli_real_escape_string($conn, $_POST['postLink']);
    $activeNum = mysqli_real_escape_string($conn, $_POST['activeNum']);
    $sql = "UPDATE posts SET p_active=$activeNum WHERE p_link='$postLink'";
    $result = mysqli_query($conn, $sql);
    header("Location: ../staff-panel.php?post=reactive&link=$post#inactivePosts");
    exit();
}
else {
    header("Location: ../in-vote.php?vote=error");
    exit();
}
