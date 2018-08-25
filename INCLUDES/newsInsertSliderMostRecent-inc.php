<?php
session_start();
include 'dbh-inc.php';
$count = 0;
$sql = "SELECT * FROM posts WHERE p_active = 1 ORDER BY p_id DESC LIMIT 5";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $link = $row['p_link'];
    $path = $row['p_img_src'];
    if ($count == 0) {
        $class = "item active";
        $count++;
    } //$count == 0
    else {
        $class = "item";
    }
    echo '<div id="container-slider" class="' . $class . ' center-block">
              <a href="post.php?link=' . $link . '"><img class="img-responsive center-block" src="uploads/postsimages/postimg' . $path . '.jpg" alt="News pic slider"></a>
              <div class="container-fluid">
                 <div class="row">
                   <div class="col-xs-12">
                     <div class="row">
                       <div class="col-xs-12" style="overflow: hidden;"><b><h3 style="color: white; background: rgba(0,0,0, 0.6); border-radius: 5px; max-height: 28px; overflow: hidden;">' . $row["p_title"] . '</h3></b></div>
                       <div class="col-xs-12"><b><h3 style="color: white; background: rgba(0,0,0, 0.3); border-radius: 5px; margin-top: 0;">Season ' . $row["p_season"] . '</h3></b></div>
                     </div>
                   </div>
                 </div>
               </div>
           </div>';
} //$row = mysqli_fetch_assoc($result)
