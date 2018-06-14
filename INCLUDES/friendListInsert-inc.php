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

         echo "<form id='formFriend' action='INCLUDES/friendFonctions-inc.php' method='POST'>
                  <div class='row'>
                    <div class='col-xs-3'><img id='friendImg' src='uploads/profile".$friendLink.".jpg' alt='friend img'/></div>
                    <div class='col-xs-4'><a class='link' href='profile.php?link=$friendLink'><p><input type='hidden' name='friend' value=".$friend." />".$friend."</p></a></div>
                    <div class='col-xs-5'>
                      <div class='btn-group'>
                        <button class='btn btn-primary glyphicon glyphicon-envelope' type='submit' name='chatCreate'></button>
                        <button class='btn btn-danger glyphicon glyphicon-remove' type='submit' name='delete'></button>
                      </div>
                    </div>
                  </div>
              </form>
            </br>";
    }
