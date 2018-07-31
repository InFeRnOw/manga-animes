<?php
include 'dbh-inc.php';

$sql = "SELECT * FROM bugreport";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result)) {
    $user = $row['bugr_author'];
    $sqlGetPf = "SELECT * FROM profiles WHERE pf_user='$user'";
    $resultGetPf = mysqli_query($conn, $sqlGetPf);
    $rowGetPf = mysqli_fetch_assoc($resultGetPf);
    echo "<div style='border: 1px solid rgba(0,0,0,0.3); border-radius: 15px; box-shadow: 2px 2px 2px rgba(0,0,0,0.2); margin-top: 10px; padding: 20px 0 20px 0'>
             <div class='container-fluid'>
                <div class='row'>
                  <div class='col-md-4 col-xs-12' style=''><h4>From</h4><a class='link' href='post.php?link=" . $rowGetPf['pf_link'] . "'><h4>" . $row['bugr_author'] . "</h4></a></div>
                  <div class='col-md-4 col-xs-12'><h4>Email: " . $row['bugr_email'] . "</h4></div>
                  <div class='col-md-4 col-xs-12'><h4>Subject: " . $row['bugr_subject'] . "</h4></div>
                </div>
              </div>
            </div>";
}
