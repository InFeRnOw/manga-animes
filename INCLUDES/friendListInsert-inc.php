<?php
session_start();
    include 'dbh-inc.php';
    $actualUser = $_SESSION['u_uid'];
    $constant = 1;

    $sql = "SELECT * FROM friends WHERE f_receiver = '$actualUser' AND f_status = 1 OR f_sender= '$actualUser' AND f_status = 1 ORDER BY f_id DESC";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)) {
        if ($row['f_sender'] == $actualUser) {
          $friend = $row['f_receiver'];
        }
        else {
          $friend = $row['f_sender'];
        }
        $sql2 = "SELECT * FROM profiles WHERE pf_user = '$friend'";
        $results = mysqli_query($conn, $sql2);
        $rows = mysqli_fetch_assoc($results);
        $friendLink = $rows['pf_link'];

         echo "<style>a:hover {text-decoration:none; font-weight: bold}</style>
         <form action='INCLUDES/friendDelete-inc.php' method='POST'>
         <div class='container-fluid'>
          <div class='row'>
          <div class='col-lg-10 col-sm-10 col-xs-10' style='margin-top: 0.5em;'><a href='profile.php?link=$friendLink'><p style='color: black;'><input type=hidden name=sender value=".$friend." />".$friend."</p></a></div>
          <div class='col-lg-2 col-sm-2 col-xs-2'><button class='glyphicon glyphicon-remove' type='submit' name='delete' style='width: auto !important; height: 2.8em; margin-top: 0.05em; border-radius: 50%; background-color: #37c0fb; color: white;'></button></div>
          </div>
        </div>
      </form>";
    }
