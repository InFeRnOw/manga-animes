<?php
session_start();
include 'dbh-inc.php';
    $sql = "SELECT * FROM garage WHERE g_id > 1 ORDER BY g_id DESC";
    $result = mysqli_query($conn, $sql);
    display($result);

function display($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div id='postBox' style='border: 1px solid rgba(0,0,0,0.3); border-radius: 15px; box-shadow: 2px 2px 2px rgba(0,0,0,0.2); margin-top: 10px; padding: 20px 0 20px 0'>
                   <div class='container-fluid'>
                    <div class='row'>
                      <div class='col-xs-12'>
                        <div class='row'>
                          <div class='col-md-4 col-xs-12'><h3>Somme</h3><div class='divider'></div><h4>" . $row['g_currency'] . "</h4><div class='divider'></div></div>
                          <div class='col-md-4 col-xs-12'><h3>Descrptif</h3><div class='divider'></div><h4>" . $row['g_description'] . "</h4><div class='divider'></div></div>
                          <div class='col-md-4 col-xs-12'><h3>Auteur</h3><div class='divider'></div><h4>" . $row['g_author'] . "</h4><div class='divider'></div></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>";
    } //$row = mysqli_fetch_assoc($result)
}
