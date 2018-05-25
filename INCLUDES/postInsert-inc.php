<?php
session_start();
    include 'dbh-inc.php';
    $sql = "SELECT * FROM posts ORDER BY p_id DESC";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)) {
         echo "<div class='container-fluid' style='padding-top: 50px;'>
         <div class='row'>
         <div id='postBox' style='border: 1px solid rgba(0,0,0,0.5); border-radius: 15px; box-shadow: 2px 2px 2px rgba(0,0,0,0.5); background: rgba(204,204,204,1); width: 100%;'>
                <div class='col-lg-4'><h3 style='color: black;'><a class='linkPosts' href='#'>" .$row['p_title']. "</a></h3></div>
                <div class='col-lg-4'><h4 style='color: black;'>Status: " .$row['p_status']. "</h4></div>
                <div class='col-lg-4'><h4 style='color: black;'>Type: " .$row['p_type']. "</h4></div>
              </div>
          </div>
        </div>";
    }
// post.php?link=$row[p_link]
