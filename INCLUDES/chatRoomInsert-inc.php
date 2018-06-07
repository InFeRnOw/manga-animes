<?php
session_start();
    include 'dbh-inc.php';

      $from = $_GET['from'];
      $sql = "SELECT * FROM chatrooms WHERE chat_to='$from' OR chat_from='$from'";
      $result = mysqli_query($conn, $sql);
      display($result);

    function display($result) {
      while($row = mysqli_fetch_assoc($result)) {
           echo "<div id='postBox' style='border: 1px solid rgba(0,0,0,0.3); border-radius: 15px; box-shadow: 2px 2px 2px rgba(0,0,0,0.2); background: white; margin-top: 10px; padding-top: 20px;'>
           <div class='container-fluid'>
            <div class='row'>
              <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
           <div class='row'>
                  <div class='col-lg-4 col-md-4 col-sm-12 col-xs-12'><a href='post.php?room=".$row['chat_id']."'><h3 style='color: rgba(0,0,0,0.7);'>" .$row['chat_to']. " & " .$row['chat_from']. "</h3></a></div>
                  <div class='col-lg-4 col-md-4 col-sm-12 col-xs-12'><h4 style='color: rgba(0,0,0,0.7);'>Status: " .$row['']. "...</h4></div>
                  <div class='col-lg-4 col-md-4 col-sm-12 col-xs-12'><h4 style='color: rgba(0,0,0,0.7);'>Type: " .$row['']. "...</h4></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </br>
      </br>";
      }
    }
