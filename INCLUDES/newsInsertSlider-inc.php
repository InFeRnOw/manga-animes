<?php
session_start();
include 'dbh-inc.php';
$count = 0;
$sql = "SELECT * FROM posts WHERE p_active = 1 ORDER BY p_id DESC LIMIT 5";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $link = $row['p_link'];
    if ($count == 0) {
        $class = "item active";
        $count++;
    } //$count == 0
    else {
        $class = "item";
    }
    echo '<div id="container-slider" class="' . $class . ' center-block">
                 <a href="post.php?link=' . $link . '"><img class="img-responsive center-block" src="uploads/postsimages/postimg' . $link . '.jpg" alt="News pic slider"></a>
                 <div id="postBox">
                            <div class="container-fluid">
                             <div class="row">
                               <div class="col-xs-12">
                                 <div class="row">
                                   <div class="col-md-4 col-xs-12" style="color: white"><b><h3>' . $row["p_title"] . '</h3></b></div>
                                   <div class="col-md-4 col-xs-12" style="color: white"><b><h3>Season: ' . $row["p_season"] . '</h3></b></div>
                                   <div class="col-md-4 col-xs-12" style="color: white"><b><h3>Episodes: ' . $row["p_episodes"] . '</h3></b></div>
                                 </div>
                               </div>
                             </div>
                           </div>
                         </div>
               </div>';
} //$row = mysqli_fetch_assoc($result)
