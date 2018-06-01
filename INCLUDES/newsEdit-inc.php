<?php
include_once 'dbh-inc.php';
if (isset($_POST['submit'])) {
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    if(empty($content)) {
      header("Location: ../NewsPost.php?news=empty");
    }
    else {
      $sql = "SELECT * FROM news WHERE n_id = 1";
      $result = mysqli_query($conn, $sql);
          if ($row = mysqli_fetch_assoc($result)) {
                  $sql = "UPDATE news SET n_content='$content' WHERE n_id=1;";
                  $result = mysqli_query($conn, $sql);
                  header("Location: ../News.php?news=edited");
                  exit();
        }
    }
}
else {
  header("Location: ../NewsPost.php?news=error");
}
