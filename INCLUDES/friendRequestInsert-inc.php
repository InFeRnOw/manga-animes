<?php
session_start();
include 'dbh-inc.php';
$receiver = $_SESSION['u_uid'];
$sql = "SELECT * FROM friends WHERE f_receiver = '$receiver' AND f_status = 0 ORDER BY f_id DESC";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $friend = $row['f_sender'];
    $sql2 = "SELECT * FROM profiles WHERE pf_user = '$friend'";
    $results = mysqli_query($conn, $sql2);
    $rows = mysqli_fetch_assoc($results);
    $friendLink = $rows['pf_link'];

    $sqlImg = "SELECT * FROM profileimg WHERE userid='$friendLink'";
    $resultImg = mysqli_query($conn, $sqlImg);
    $rowImg = mysqli_fetch_assoc($resultImg);
        if ($rowImg['status'] == 0) {
            $src = "uploads/profile".$friendLink.".jpg";
        }
        else {
            $src = "CSS/images/symbol_questionmark.png";
        }
    echo "<form id='formFriend' action='INCLUDES/friendRequestResult-inc.php' method='POST'>
                 <div class='container-fluid'>
                  <div class='row'>
                    <div class='col-xs-2'><img id='friendImg' src='".$src."' alt='f img'/></div>
                    <div class='col-xs-5'><a class='link' href='profile.php?link=" . $friendLink . "'><p><input type='hidden' name='friend' value=" . $row['f_sender'] . " />" . $row['f_sender'] . "</p></a></div>
                    <div class='col-xs-5'>
                      <div>
                        <button class='btn btn-group btn-success glyphicon glyphicon-ok' type='submit' name='acceptRequest'></button>
                        <button class='btn btn-danger glyphicon glyphicon-remove' type='submit' name='refuseRequest'></button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </br>";

} //$row = mysqli_fetch_assoc($result)
