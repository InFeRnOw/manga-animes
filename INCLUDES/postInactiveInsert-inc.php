<?php
session_start();
include 'dbh-inc.php';

$sql = "SELECT * FROM posts WHERE p_active = 3 OR p_active = 4 ORDER BY p_title ASC";
$result = mysqli_query($conn, $sql);
display($result);

function display($result) {
    while ($row = mysqli_fetch_assoc($result)) {
          $link = $row['p_link'];
          if ($row['p_active'] == 3 && $row['p_status'] !== "Currently Airing") {
              $reason = "Denied";
              $activeNum = 0;
          }
          elseif ($row['p_active'] == 4) {
              $reason = "Deleted";
              $activeNum = 1;
          }
          elseif ($row['p_active'] == 3) {
              $reason = "Denied";
              $activeNum = 5;
          }
        echo "<div id='postBox' style='border: 1px solid rgba(0,0,0,0.3); border-radius: 15px; box-shadow: 2px 2px 2px rgba(0,0,0,0.2); margin-top: 10px; padding: 20px 0 20px 0'>
                   <div class='container-fluid'>
                    <div class='row'>
                      <div class='col-xs-12'>
                        <div class='row'>
                          <div class='col-md-4 col-xs-12' style=''><a class='link' href='post.php?link=" . $link . "'><h4>" . $row['p_title'] . "</h4></a></div>
                          <div class='col-md-4 col-xs-12'><h4>".$reason." by " . $row['p_lastedited'] . "</h4></div>
                          <div class='col-md-4 col-xs-12'>
                            <form action='INCLUDES/vote-inc.php' method='POST'>
                              <input type='hidden' name='postLink' value='".$link."'/>
                              <input type='hidden' name='activeNum' value='".$activeNum."'/>
                              <button class='btn btn-group btn-success glyphicon glyphicon-ok' type='submit' name='reactivatePost'></button>
                              <button class='btn btn-danger glyphicon glyphicon-remove' type='submit' name='deletePostPerm'></button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>";
    } //$row = mysqli_fetch_assoc($result)
}
