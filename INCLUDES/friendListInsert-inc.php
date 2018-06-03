<?php
session_start();
    include 'dbh-inc.php';
    $actualUser = $_SESSION['u_uid'];

    $sql = "SELECT * FROM friends WHERE f_receiver = '$actualUser' AND f_status = 1 OR f_sender= '$actualUser' AND f_status = 1 ORDER BY f_id DESC";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)) {
        if ($row['f_sender'] == $actualUser) {
          $friend = $row['f_receiver'];
        }
        else {
          $friend = $row['f_sender'];
        }
         echo "<form action='INCLUDES/friendDelete-inc.php' method='POST'>
         <div class='container-fluid'>
          <div class='row'>
          <div class='col-lg-10 col-sm-10 col-xs-10' style='margin-top: 0.5em;'><p><input type=hidden name=sender value=".$friend." />".$friend."</p></div>
          <div class='col-lg-2 col-sm-2 col-xs-2'><button type='submit' name='refuseRequest' style='width: 2em !important; height: 2.8em; margin-top: 0.05em; border-radius: 50%; background-color: #37c0fb; color: white;'>-</button></div>
          </div>
        </div>
      </form>";
    }
