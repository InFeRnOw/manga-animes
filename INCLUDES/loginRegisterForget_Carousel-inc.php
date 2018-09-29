<?php
session_start();
include 'dbh-inc.php';
$count = 0;
$sql = "SELECT * FROM posts WHERE p_active IN ('1', '2') ORDER BY rand() LIMIT 1";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $path = $row['p_img_src'];
    echo '<img class="img-responsive center-block" src="uploads/postsimages/postimg' . $path . '.jpg" alt="News pic slider">';
} //$row = mysqli_fetch_assoc($result)
