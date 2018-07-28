<?php
session_start();
include 'dbh-inc.php';

$userLink = $_GET['link'];
$sqlSearchUser = "SELECT * FROM profiles WHERE pf_link = '$userLink'";
$resultSearchUser = mysqli_query($conn, $sqlSearchUser);
$rowSearchUser = mysqli_fetch_assoc($resultSearchUser);
$user = $rowSearchUser['pf_user'];

$sql = "SELECT * FROM posts WHERE p_active = 1 AND p_user = '$user' ORDER BY p_id ASC";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $link = $row['p_link'];
    echo '<div class="container col-md-4">
              <a href="post.php?link=' . $link . '"><img src="uploads/postsimages/postimg' . $link . '.jpg" alt="Snow" style="width:100%; box-shadow: 1px 1px 12px grey; border-radius: 10px;"></a>
              <a href="post.php?link=' . $link . '">
                <div class="centered">
                  <div class="col-xs-12" style="overflow: hidden;"><b><h3 style="color: white; background: rgba(0,0,0, 0.75); border-radius: 5px; max-height: 28px; overflow: hidden;">' . $row["p_title"] . '</h3></b></div>
                  <div class="col-xs-12"><b><h3 style="color: white; background: rgba(0,0,0, 0.5); border-radius: 5px; margin-top: 0;">Season ' . $row["p_season"] . '</h3></b></div>
                </div>
              </a>
            </div>
            <style>
              /* Container holding the image and the text */
              .container {
                  position: relative;
                  text-align: center;
                  color: white;
                  margin-top: 10px;
              }

              /* Centered text */
              .centered {
                  position: absolute;
                  top: 50%;
                  left: 50%;
                  transform: translate(-50%, -50%);
              }
            </style>';
} //$row = mysqli_fetch_assoc($result)
