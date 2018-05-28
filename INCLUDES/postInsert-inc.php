<?php
session_start();
    include 'dbh-inc.php';
    $sql = "SELECT * FROM posts ORDER BY p_id DESC";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)) {
         echo "<div>
         <div class='container-fluid' padding-top: 50px;>
          <div class='row'>
            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
         <div id='postBox' style='border: 1px solid rgba(0,0,0,0.3); border-radius: 15px; box-shadow: 2px 2px 2px rgba(0,0,0,0.2); background: white;'>
                <div class='col-lg-4'><h3 style='color: black;'><a class='linkPosts' href='https://manga-animes.com/post.php?link=".$row['p_link']."'>" .$row['p_title']. "</a></h3></div>
                <div class='col-lg-4'><h4 style='color: black;'>Status: " .$row['p_status']. "</h4></div>
                <div class='col-lg-4'><h4 style='color: black;'>Type: " .$row['p_type']. "</h4></div>
              </div>
            </div>
          </div>
        </div>
      </div>";
    }
// post.php?link=$row[p_link]
