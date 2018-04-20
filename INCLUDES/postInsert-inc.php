<?php
session_start();
    include 'dbh-inc.php';
    $sql = "SELECT * FROM posts ORDER BY p_id DESC";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)) {
         echo "<div id='postBox' style='border: 1px solid rgba(0,0,0,0.5); border-radius: 15px; box-shadow: 2px 2px 2px black; background: rgba(0,0,0,0.65)'>
             <div class='titleBox' style='float: left;margin-left: 2%;padding: 0px 7.5px 7.5px 5px;>
                <h3 style='color: white;'>" .$row['p_title']. "</h3>
                <h4>Status: " .$row['p_status']. "</h4>
                <h4>Type: " .$row['p_type']. "</h4>";
    }
