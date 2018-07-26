<?php
session_start();
include 'dbh-inc.php';
$sql = "UPDATE posts SET p_vuesmostviewed = 0";
$result = mysqli_query($conn, $sql);
