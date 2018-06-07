<?php
session_start();
include_once 'dbh-inc.php';

if (isset($_POST['accept'])) {
  $post = $_SESSION['link'];
  $sql = "SELECT * FROM posts WHERE p_link = '$post'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);

  $likes = $row['p_likes'];
  $dislikes = $row['p_dislikes'];

  $sql = "UPDATE posts SET p_active=1 WHERE p_link='$post'";
  $result = mysqli_query($conn, $sql);
  header("Location: ../post.php?accept=success&link=$post");
  exit();
}
else if(isset($_POST['deny'])) {
  $post = $_SESSION['link'];
  $sql = "SELECT * FROM posts WHERE p_link = '$post'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);

  $likes = $row['p_likes'];
  $dislikes = $row['p_dislikes'];

  $sql = "DELETE FROM posts WHERE p_link='$post'";
  $result = mysqli_query($conn, $sql);
  header("Location: ../In%20vote.php?deny=success&link=$post");
  exit();
}
else if(isset($_POST['like'])) {
  $post = $_SESSION['link'];
  $user = $_SESSION['u_uid'];

  $sql = "SELECT * FROM votes WHERE v_link='$post'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);

  if($row['v_user'] !== $user) {
    $sql = "SELECT * FROM posts WHERE p_link = '$post'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $likes = $row['p_likes'];
    $dislikes = $row['p_dislikes'];

    $sql = "UPDATE posts SET p_likes=p_likes + 1 WHERE p_link='$post'";
    $result = mysqli_query($conn, $sql);

    $sql = "INSERT INTO votes (v_user, v_link) VALUES ('$user', '$post')";
    $result = mysqli_query($conn, $sql);

    if($likes == 9) {
      $sql = "UPDATE posts SET p_active=1 WHERE p_link='$post'";
      $result = mysqli_query($conn, $sql);

      $sql = "DELETE FROM votes WHERE v_link='$post'";
      $result = mysqli_query($conn, $sql);
      header("Location: ../Alphabetic-order.php?vote=success&link=$post");
      exit();
    }
    else {
      header("Location: ../post.php?vote=success&link=$post");
      exit();
    }
  }
  else {
    header("Location: ../post.php?vote=already&link=$post");
  }
}
else if(isset($_POST['dislike'])) {
  $post = $_SESSION['link'];
  $user = $_SESSION['u_uid'];

  $sql = "SELECT * FROM votes WHERE v_link='$post'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);

  if($row['v_user'] !== $user) {
    $sql = "SELECT * FROM posts WHERE p_link = '$post'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $likes = $row['p_likes'];
    $dislikes = $row['p_dislikes'];

    $sql = "UPDATE posts SET p_dislikes=p_dislikes + 1 WHERE p_link='$post'";
    $result = mysqli_query($conn, $sql);

    $sql = "INSERT INTO votes (v_user, v_link) VALUES ('$user', '$post')";
    $result = mysqli_query($conn, $sql);

    if($dislikes == 9) {
      $sql = "DELETE FROM posts WHERE p_link='$post'";
      $result = mysqli_query($conn, $sql);

      $sql = "DELETE FROM votes WHERE v_link='$post'";
      $result = mysqli_query($conn, $sql);
      header("Location: ../In%20vote.php?vote=success&link=$post");
      exit();
    }
    else {
      header("Location: ../post.php?vote=success&link=$post");
      exit();
    }
  }
  else {
    header("Location: ../post.php?vote=already&link=$post");
  }
}
else if(isset($_POST['edit'])) {
  $post = $_SESSION['link'];
  $sql = "SELECT * FROM posts WHERE p_link='$post'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);

  $title = $row['p_title'];
  $titleEn = $row['p_titleen'];
  $content = $row['p_content'];

  header("Location: ../posting.php?edit=editing&link=$post&title=$title&status=$status&type=$type&titleEn=$titleEn&genre=$genre&statusManga=$statusManga&content=$content");
}
else {
  header("Location: ../In%20vote.php?vote=error");
  exit();
}
