<?php
session_start();
    include 'dbh-inc.php';
    if (!empty($_GET['letter'])) {
      $letter = $_GET['letter'];
      $sql = "SELECT * FROM posts WHERE p_active=1 AND p_titleen LIKE '$letter%'";
      $result = mysqli_query($conn, $sql);
      display($result);
    }
    else {
      $sql = "SELECT * FROM posts WHERE p_active = 1 ORDER BY p_title ASC";
      $result = mysqli_query($conn, $sql);
      display($result);
    }

    function display($result) {
      while($row = mysqli_fetch_assoc($result)) {
           echo "<div id='postBox' style='border: 1px solid rgba(0,0,0,0.3); border-radius: 15px; box-shadow: 2px 2px 2px rgba(0,0,0,0.2); background: white; margin-top: 10px; padding-top: 20px;'>
           <div class='container-fluid'>
            <div class='row'>
              <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
           <div class='row'>
                  <div class='col-lg-4 col-md-4 col-sm-12 col-xs-12'><a href='post.php?link=".$row['p_link']."'><h3 style='color: rgba(0,0,0,0.7);'>" .$row['p_titleen']. "</h3></a></div>
                  <div class='col-lg-4 col-md-4 col-sm-12 col-xs-12'><h4 style='color: rgba(0,0,0,0.7);'>Status: " .$row['p_status']. "</h4></div>
                  <div class='col-lg-4 col-md-4 col-sm-12 col-xs-12'><h4 style='color: rgba(0,0,0,0.7);'>Type: " .$row['p_type']. "</h4></div>
                  </div>
                </div>
              </div>
            </div>
          </div>";
      }
    }
