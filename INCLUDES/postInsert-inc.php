<?php
session_start();

function displayJap($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div id='postBox' style='border: 1px solid rgba(0,0,0,0.3); border-radius: 15px; box-shadow: 2px 2px 2px rgba(0,0,0,0.2); background: white; margin-top: 10px; padding: 20px 0 20px 0'>
           <div class='container-fluid'>
            <div class='row'>
              <div class='col-xs-12'>
           <div class='row'>
                  <div class='col-md-4 col-xs-12'><a class='link' href='post.php?link=" . $row['p_link'] . "'><h4>" . $row['p_title'] . "</h4></a></div>
                  <div class='col-md-4 col-xs-12'><h4>Season: " . $row['p_season'] . "</h4></div>
                  <div class='col-md-4 col-xs-12'><h4>Episodes: " . $row['p_episodes'] . "</h4></div>
                  </div>
                </div>
              </div>
            </div>
          </div>";
    } //$row = mysqli_fetch_assoc($result)
}

function displayJapAnime($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div id='postBox' style='border: 1px solid rgba(0,0,0,0.3); border-radius: 15px; box-shadow: 2px 2px 2px rgba(0,0,0,0.2); background: white; margin-top: 10px; padding: 20px 0 20px 0'>
           <div class='container-fluid'>
            <div class='row'>
              <div class='col-xs-12'>
           <div class='row'>
                  <div class='col-md-4 col-xs-12'><a class='link' href='post.php?link=" . $row['p_link'] . "'><h4>" . $row['p_title'] . "</h4></a></div>
                  <div class='col-md-4 col-xs-12'><h4>Status: " . $row['p_status'] . "</h4></div>
                  <div class='col-md-4 col-xs-12'><h4>Type: " . $row['p_type'] . "</h4></div>
                  </div>
                </div>
              </div>
            </div>
          </div>";
    } //$row = mysqli_fetch_assoc($result)
}

function displayEn($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div id='postBox' style='border: 1px solid rgba(0,0,0,0.3); border-radius: 15px; box-shadow: 2px 2px 2px rgba(0,0,0,0.2); background: white; margin-top: 10px; padding: 20px 0 20px 0'>
           <div class='container-fluid'>
            <div class='row'>
              <div class='col-xs-12'>
           <div class='row'>
                  <div class='col-md-4 col-xs-12'><a class='link' href='post.php?link=" . $row['p_link'] . "'><h4>" . $row['p_titleen'] . "</h4></a></div>
                  <div class='col-md-4 col-xs-12'><h4>Season: " . $row['p_season'] . "</h4></div>
                  <div class='col-md-4 col-xs-12'><h4>Episodes: " . $row['p_episodes'] . "</h4></div>
                  </div>
                </div>
              </div>
            </div>
          </div>";
    } //$row = mysqli_fetch_assoc($result)
}

function displayEnAnime($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div id='postBox' style='border: 1px solid rgba(0,0,0,0.3); border-radius: 15px; box-shadow: 2px 2px 2px rgba(0,0,0,0.2); background: white; margin-top: 10px; padding: 20px 0 20px 0'>
           <div class='container-fluid'>
            <div class='row'>
              <div class='col-xs-12'>
           <div class='row'>
                  <div class='col-md-4 col-xs-12'><a class='link' href='post.php?link=" . $row['p_link'] . "'><h4>" . $row['p_titleen'] . "</h4></a></div>
                  <div class='col-md-4 col-xs-12'><h4>Status: " . $row['p_status'] . "</h4></div>
                  <div class='col-md-4 col-xs-12'><h4>Type: " . $row['p_type'] . "</h4></div>
                  </div>
                </div>
              </div>
            </div>
          </div>";
    } //$row = mysqli_fetch_assoc($result)
}

function insertJap($p_active) {

    include 'dbh-inc.php';

    if (!empty($_GET['letter'])) {
        $letter = $_GET['letter'];
        $sql = "SELECT * FROM posts WHERE p_active = $p_active AND p_title LIKE '$letter%'";
        $result = mysqli_query($conn, $sql);
        displayJap($result);
    } //!empty($_GET['letter'])
    else {
        $sql = "SELECT * FROM posts WHERE p_active = $p_active ORDER BY p_title ASC";
        $result = mysqli_query($conn, $sql);
        displayJap($result);
    }
}

function insertEn($p_active) {

    include 'dbh-inc.php';

    if (!empty($_GET['letter'])) {
        $letter = $_GET['letter'];
        $sql = "SELECT * FROM posts WHERE p_active = $p_active AND p_titleen LIKE '$letter%'";
        $result = mysqli_query($conn, $sql);
        displayEn($result);
    } //!empty($_GET['letter'])
    else {
        $sql = "SELECT * FROM posts WHERE p_active = $p_active ORDER BY p_title ASC";
        $result = mysqli_query($conn, $sql);
        displayEn($result);
    }
}

function insertAnimeEn($p_active) {

    include 'dbh-inc.php';

    if (!empty($_GET['letter'])) {
        $letter = $_GET['letter'];
        $sql = "SELECT * FROM posts WHERE p_active = $p_active AND p_titleen LIKE '$letter%'";
        $result = mysqli_query($conn, $sql);
        displayEnAnime($result);
    } //!empty($_GET['letter'])
    else {
        $sql = "SELECT * FROM posts WHERE p_active = $p_active ORDER BY p_title ASC";
        $result = mysqli_query($conn, $sql);
        displayEnAnime($result);
    }
}
function insertAnimeJap($p_active) {

    include 'dbh-inc.php';

    if (!empty($_GET['letter'])) {
        $letter = $_GET['letter'];
        $sql = "SELECT * FROM posts WHERE p_active = $p_active AND p_titleen LIKE '$letter%'";
        $result = mysqli_query($conn, $sql);
        displayJapAnime($result);
    } //!empty($_GET['letter'])
    else {
        $sql = "SELECT * FROM posts WHERE p_active = $p_active ORDER BY p_title ASC";
        $result = mysqli_query($conn, $sql);
        displayJapAnime($result);
    }
}
