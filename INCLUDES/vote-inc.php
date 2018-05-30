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
  $sql = "SELECT * FROM posts WHERE p_link = '$post'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);

  $likes = $row['p_likes'];
  $dislikes = $row['p_dislikes'];

  $sql = "UPDATE posts SET p_likes=p_likes + 1 WHERE p_link='$post'";
  $result = mysqli_query($conn, $sql);

  if($likes == 99) {
    $sql = "UPDATE posts SET p_active=1 WHERE p_link='$post'";
    $result = mysqli_query($conn, $sql);
    header("Location: ../Alphabetic-order.php?vote=success&link=$post");
    exit();
  }
  else {
    header("Location: ../post.php?vote=success&link=$post");
    exit();
  }
}
else if(isset($_POST['dislike'])) {
  $post = $_SESSION['link'];
  $sql = "SELECT * FROM posts WHERE p_link = '$post'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);

  $likes = $row['p_likes'];
  $dislikes = $row['p_dislikes'];

  $sql = "UPDATE posts SET p_dislikes=p_dislikes + 1 WHERE p_link='$post'";
  $result = mysqli_query($conn, $sql);
  if($dislikes == 99) {
    $sql = "DELETE FROM posts WHERE p_link='$post'";
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
  header("Location: ../In%20vote.php?vote=error");
  exit();
}
