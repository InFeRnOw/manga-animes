<?php
session_start();
include 'dbh-inc.php';
$actualUser = $_SESSION['u_uid'];
$constant = 1;
$sql = "SELECT * FROM friends WHERE f_receiver = '$actualUser' AND f_status = 1 OR f_sender= '$actualUser' AND f_status = 1 ORDER BY f_id DESC";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    if ($row['f_sender'] == $actualUser) {
        $friend = $row['f_receiver'];
    } //$row['f_sender'] == $actualUser
    else {
        $friend = $row['f_sender'];
    }
    $sql2 = "SELECT * FROM profiles WHERE pf_user = '$friend'";
    $results = mysqli_query($conn, $sql2);
    $rows = mysqli_fetch_assoc($results);
    $friendLink = $rows['pf_link'];
    $sqlImg = "SELECT * FROM profileimg WHERE userid='$friendLink'";
    $resultImg = mysqli_query($conn, $sqlImg);
    if ($rowImg = mysqli_fetch_assoc($resultImg)) {
        if ($rowImg['status'] == 0) {
            $src = "uploads/profile".$friendLink.".jpg";
        }
        else {
            $src = "CSS/images/symbol_questionmark.png";
        }
    }
    echo "<form id='formFriend' action='INCLUDES/friendFonctions-inc.php' method='POST'>
                <div class='container-fluid'>
                  <div class='row'>
                    <div class='col-xs-2'><img id='friendImg' src='".$src."' alt='f img'/></div>
                    <div class='col-xs-5'><a class='link' href='profile.php?link=$friendLink'><p><input type='hidden' name='friend' value=".$friend." />".$friend."</p></a></div>
                    <div class='col-xs-5'>
                      <div>
                        <button class='btn btn-primary glyphicon glyphicon-envelope' type='submit' name='chatCreate'></button>
                        <button class='btn btn-danger glyphicon glyphicon-remove' type='submit' name='delete'></button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </br>";
} //$row = mysqli_fetch_assoc($result)
