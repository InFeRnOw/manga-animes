<?php
session_start();
include 'dbh-inc.php';
$actualUser = $_SESSION['u_uid'];
$sql = "SELECT * FROM users WHERE rank = 3 ORDER BY user_uid DESC";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $user = $row['user_uid'];
    $sql2 = "SELECT * FROM profiles WHERE pf_user = '$user'";
    $results = mysqli_query($conn, $sql2);
    $rows = mysqli_fetch_assoc($results);
    $userLink = $rows['pf_link'];
    $sqlImg = "SELECT * FROM profileimg WHERE userid='$userLink'";
    $resultImg = mysqli_query($conn, $sqlImg);
    if ($rowImg = mysqli_fetch_assoc($resultImg)) {
        if ($rowImg['status'] == 0) {
            $src = "uploads/profile".$userLink.".jpg";
        }
        else {
            $src = "CSS/images/symbol_questionmark.png";
        }
    }
    echo "<form id='formUser' action='INCLUDES/userManagement-inc.php' method='POST'>
                <div class='container-fluid'>
                  <div class='row'>
                    <div class='col-md-3 col-xs-2'><img id='userImg' src='".$src."' alt='friend img'/></div>
                    <div class='col-xs-5'><a class='link' href='profile.php?link=$userLink'><p><input type='hidden' name='user' value=" . $user . " />" . $user . "</p></a></div>
                    <div class='col-md-4 col-xs-5'>
                      <div>
                        <button class='btn btn-primary glyphicon glyphicon-envelope' type='submit' name='chatCreate'></button>
                        <button class='btn btn-info glyphicon glyphicon-arrow-up' type='submit' name='uprank'></button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </br>";
} //$row = mysqli_fetch_assoc($result)
