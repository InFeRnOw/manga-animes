<?php
session_start();
include 'dbh-inc.php';

$link = $_GET['link'];

if (isset($_GET['more'])) {
    $sql = "SELECT * FROM postcomments WHERE post_comment_link = '$link' ORDER BY post_comment_id ASC";
    $result = mysqli_query($conn, $sql);
}
else {
    $sql = "SELECT * FROM postcomments WHERE post_comment_link = '$link' ORDER BY post_comment_id ASC LIMIT 3";
    $result = mysqli_query($conn, $sql);
}

while ($row = mysqli_fetch_assoc($result)) {
    $user = $row['post_comment_author'];
    $sqlGetProfile = "SELECT * FROM profiles WHERE pf_user = '$user'";
    $resultGetProfile = mysqli_query($conn, $sqlGetProfile);
    $rowProfile = mysqli_fetch_assoc($resultGetProfile);
    echo "<div border: 1px solid white; border-radius: 5px; box-shadow: 1px 1px 12px grey'>
            <div class='container-fluid'>
              <div class='row'>
                <div style='right: 0;'><a class='link' href='profile.php?link=" . $rowProfile['pf_link'] . "' style='color: black;'><b><p style='font-size: 26px;'>" . $row['post_comment_author'] . "</p></b></a></div>
                <div class='col-xs-12'><em><q style='font-size: 22px;'>" . $row['post_comment_content'] . "</q></em></div>
              </div>
            </div>";
    if ($_SESSION['u_uid'] == $row['post_comment_author'] && isset($_SESSION['u_id']) || $_SESSION['u_rank'] <= 2 && isset($_SESSION['u_id'])) {
       echo '<form action="INCLUDES/postComments-inc.php" method="POST">
                <button type="submit" name="deleteComment" style="background:none !important; color: grey; border:none; padding:0 !important; cursor: pointer; font-size: 16px;">delete</button>
                <input type="hidden" name="postCommentId" value="'.$row['post_comment_id'].'"/>
                <input type="hidden" name="postLink" value="'.$link.'">
             </form>';
    }
    echo "</div></br>";
} //$row = mysqli_fetch_assoc($result)
