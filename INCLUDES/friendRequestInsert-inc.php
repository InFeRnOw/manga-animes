<?php
session_start();
    include 'dbh-inc.php';
    $receiver = $_SESSION['u_uid'];

    $sql = "SELECT * FROM friends WHERE f_receiver = '$receiver' AND f_status = 0 ORDER BY f_id DESC";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)) {
         echo "<form action='INCLUDES/friendRequestResult-inc.php' method='POST'>
         <div class='container-fluid'>
          <div class='row'>
          <div class='col-lg-8 col-sm-8 col-xs-8' style='margin-top: 0.5em;'><p><input type=hidden name=sender value=".$row['f_sender']." />".$row['f_sender']."</p></div>
          <div class='col-lg-2 col-sm-2 col-xs-2'><button class='glyphicon glyphicon-plus' type='submit' name='acceptRequest' style='width: 2em !important; height: 2.8em; margin-top: 0.05em; border-radius: 50%; background-color: #37c0fb; color: white;'></></button></div>
          <div class='col-lg-2 col-sm-2 col-xs-2'><button class='glyphicon glyphicon-minus' type='submit' name='refuseRequest' style='width: 2em !important; height: 2.8em; margin-top: 0.05em; border-radius: 50%; background-color: #37c0fb; color: white;'></button></div>
          </div>
        </div>
      </form>";
    }
