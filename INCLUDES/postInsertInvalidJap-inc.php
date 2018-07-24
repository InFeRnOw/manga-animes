<?php
session_start();
include 'dbh-inc.php';
if (!empty($_GET['letter'])) {
    $letter = $_GET['letter'];
    $sql = "SELECT * FROM posts WHERE p_active=0 AND p_title LIKE '$letter%'";
    $result = mysqli_query($conn, $sql);
    display($result);
} //!empty($_GET['letter'])
else {
    $sql = "SELECT * FROM posts WHERE p_active = 0 ORDER BY p_title ASC";
    $result = mysqli_query($conn, $sql);
    display($result);
}
function display($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div id='postBox' style='border: 1px solid rgba(0,0,0,0.3); border-radius: 15px; box-shadow: 2px 2px 2px rgba(0,0,0,0.2); background: white; margin-top: 10px; padding: 20px 0 20px 0;'>
           <div class='container-fluid'>
            <div class='row'>
              <div class='col-xs-12'>
           <div class='row'>
                  <div class='col-md-4 col-xs-12' style=''><a class='link' href='post.php?link=" . $row['p_link'] . "'><h4>" . $row['p_title'] . "</h4></a></div>
                  <div class='col-md-4 col-xs-12'><h4>Season: " . $row['p_season'] . "</h4></div>
                  <div class='col-md-4 col-xs-12'><h4>Episodes: " . $row['p_episodes'] . "</h4></div>
                  </div>
                </div>
              </div>
            </div>
          </div>";
    } //$row = mysqli_fetch_assoc($result)
}
