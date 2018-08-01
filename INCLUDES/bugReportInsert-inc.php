<?php
include 'dbh-inc.php';

$sql = "SELECT * FROM bugreport";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result)) {
    $user = $row['bugr_author'];
    $reportId = $row['bugr_id'];
    $sqlGetPf = "SELECT * FROM profiles WHERE pf_user='$user'";
    $resultGetPf = mysqli_query($conn, $sqlGetPf);
    $rowGetPf = mysqli_fetch_assoc($resultGetPf);
    echo "<div class='col-md-4 col-xs-12' style='border: 1px solid rgba(0,0,0,0.3); border-radius: 15px; box-shadow: 2px 2px 2px rgba(0,0,0,0.2); margin-top: 10px; height: 205px; overflow-y: auto;'>
             <div class='container-fluid'>
               <div class='row'>
                  <div class='col-xs-12' style=''><h4><b><u>From</u></b></h4><a class='link' href='profile.php?link=" . $rowGetPf['pf_link'] . "' style='text-decoration: none; color: black;'><h4>" . $user . "</h4></a></div>
                  <div class='col-xs-12'><h4><b><u>Email</u></b></h4><h4>" . $row['bugr_email'] . "</h4></div>
                  <div class='col-xs-12'><h4><b><u>Subject</u></b></h4><h4>" . $row['bugr_subject'] . "</h4></div>
                  <div class='col-xs-12' style='word-break: break-all;'><h4><b><u>Text</u></b></h4><h4>" . $row['bugr_text'] . "</h4></div>
                  <div class='col-xs-12'>
                    <form action='INCLUDES/bugReport-inc.php' method='POST'>
                      <input type='hidden' name='user' value=" . $user . " />
                      <button class='btn btn-primary glyphicon glyphicon-envelope' type='submit' name='chatCreate' style='margin-bottom: 8.5px'></button>
                      <input type='hidden' name='reportId' value='".$reportId."'/>
                      <button class='btn btn-danger' type='submit' name='delete' style='margin-bottom: 5px'>X</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>";
}
