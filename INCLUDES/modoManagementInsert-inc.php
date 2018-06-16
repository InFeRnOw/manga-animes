<?php
session_start();
include 'dbh-inc.php';
$actualUser = $_SESSION['u_uid'];
$sql = "SELECT * FROM users WHERE rank = 2 ORDER BY user_uid DESC";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $modo = $row['user_uid'];
    $sql2 = "SELECT * FROM profiles WHERE pf_user = '$modo'";
    $results = mysqli_query($conn, $sql2);
    $rows = mysqli_fetch_assoc($results);
    $modoLink = $rows['pf_link'];
    $sqlImg = "SELECT * FROM profileimg WHERE userid='$modoLink'";
    $resultImg = mysqli_query($conn, $sqlImg);
    if ($rowImg = mysqli_fetch_assoc($resultImg)) {
        if ($rowImg['status'] == 0) {
            $src = "uploads/profile".$modoLink.".jpg";
        }
        else {
            $src = "CSS/images/symbol_questionmark.png";
        }
    }
    echo "<form id='formUser' action='INCLUDES/userManagement-inc.php' method='POST'>
                <div class='container-fluid'>
                  <div class='row'>
                    <div class='col-md-3 col-xs-2'><img id='userImg' src='".$src."' alt='friend img'/></div>
                    <div class='col-xs-5'><a class='link' href='profile.php?link=$modoLink'><p><input type='hidden' name='user' value=" . $modo . " />" . $modo . "</p></a></div>
                    <div class='col-md-4 col-xs-5'>
                      <div>
                        <button class='btn btn-primary glyphicon glyphicon-envelope' type='submit' name='chatCreate'></button>
                        <button class='btn btn-danger glyphicon glyphicon-arrow-down' type='submit' name='derank'></button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </br>";
} //$row = mysqli_fetch_assoc($result)
