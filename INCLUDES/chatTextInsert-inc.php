<?php
session_start();
    include 'dbh-inc.php';

      $from = $_GET['from'];
      $sql = "SELECT * FROM chat WHERE chat_room_id='$chatId'";
      $result = mysqli_query($conn, $sql);
      display($result);

    function display($result) {
      while($row = mysqli_fetch_assoc($result)) {
           echo "<div id='postBox' style='border: 1px solid rgba(0,0,0,0.3); border-radius: 15px; box-shadow: 2px 2px 2px rgba(0,0,0,0.2); background: white; margin-top: 10px; padding-top: 20px;'>
           <div class='container-fluid'>
            <div class='row'>
              <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
           <div class='row'>
                  <p class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>" .$row['chat_text']. "</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </br>
      </br>";
      }
    }
