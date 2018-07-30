<?php
session_start();
include 'dbh-inc.php';
if (isset($_POST['submit']) && isset($_SESSION['u_id'])) {
    $postLink = mysqli_real_escape_string($conn, $_POST['postLink']);
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);
    $user = $_SESSION['u_uid'];
    if (empty($comment)) {
        header("Location: ../post.php?link=$postLink&comment=empty");
    } //empty($text)
    else {
        $sql = "INSERT INTO postcomments (post_comment_content, post_comment_link, post_comment_author) VALUES ('$comment', '$postLink', '$user')";
        $result = mysqli_query($conn, $sql);
        header("Location: ../post.php?link=$postLink&comment=success");
    }
} //isset($_POST['submit'])
elseif (isset($_POST['deleteComment']) && isset($_SESSION['u_id'])) {
    $postLink = mysqli_real_escape_string($conn, $_POST['postLink']);
    $postCommentId = mysqli_real_escape_string($conn, $_POST['postCommentId']);
    $sql = "DELETE FROM postcomments WHERE post_comment_id = '$postCommentId'";
    $result = mysqli_query($conn, $sql);
    header("Location: ../post.php?link=$postLink&comment=delete");
} //isset($_POST['submit'])
