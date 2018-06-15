<?php
session_start();
    include 'dbh-inc.php';

    $count = 0;

    $sql = "SELECT * FROM posts WHERE p_active = 1 ORDER BY p_id DESC LIMIT 3";
    $result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($result)) {
      $link = $row['p_link'];
      if ($count == 0) {
        $class = "item active";
        $count++;
      }
      else {
        $class = "item";
      }
         echo '<div id="container-slider" class="'.$class.' center-block">
                 <a href="post.php?link='.$link.'"><img class="img-responsive center-block" src="uploads/postsimages/postimg'.$link.'.jpg" alt="News pic slider"></a>
               </div>';
    }
