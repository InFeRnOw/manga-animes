<?php
session_start();
include 'dbh-inc.php';
include 'panels-inc.php';
$link = $_GET['link'];
$sqlVarPosts = "SELECT * FROM posts WHERE p_link = '$link'";
$resultVarPosts = mysqli_query($conn, $sqlVarPosts);
$rowVarPosts = mysqli_fetch_assoc($resultVarPosts);
$title = $rowVarPosts['p_title'];
$pUser = $rowVarPosts['p_user'];
$content = $rowVarPosts['p_content'];
$type = $rowVarPosts['p_type'];
$genre = $rowVarPosts['p_genre'];
$id = $_SESSION['u_id'];
$active = $rowVarPosts['p_active'];
$titleen = $rowVarPosts['p_titleen'];
$genre = $rowVarPosts['p_genre'];
$statusmanga = $rowVarPosts['p_statusmanga'];
$status = $rowVarPosts['p_status'];
$adaptation = $rowVarPosts['p_adaptation'];
$season = $rowVarPosts['p_season'];
$episodes = $rowVarPosts['p_episodes'];
$linkMyAnime = $rowVarPosts['p_linkmyanime'];
$lastUserToEdit = $rowVarPosts['p_lastedited'];

if ($active == 0 || $active == 5) {
    $sql = "SELECT * FROM users WHERE user_id='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row['rank'] == 1 && isset($_SESSION['u_id'])) {
        $_SESSION['link'] = $link;
        adminPanelVote($lastUserToEdit);
    } //$row['rank'] <= 2 && isset($_SESSION['u_id'])
    else if ($row['rank'] == 3 && isset($_SESSION['u_id'])) {
        $_SESSION['link'] = $link;
        if ($_SESSION['u_uid'] == $pUser) {
            authorPanelVote($lastUserToEdit);
        } //$_SESSION['u_uid'] == $pUser
        else {
            votePanel($lastUserToEdit);
        }
    } //$row['rank'] == 3 && isset($_SESSION['u_id'])
    else {
        echo "<div class='divider-with-content'>
          <p style='color: red;'>You need to login or register in order to vote on this post !</p>
        </div>";
    }
} //$active == 0
if ($active == 1 || $active == 2) {
    $sql = "SELECT * FROM users WHERE user_id='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row['rank'] <= 2 && isset($_SESSION['u_id'])) {
        $_SESSION['link'] = $link;
        adminPanel($lastUserToEdit);
    } //$row['rank'] <= 2 && isset($_SESSION['u_id'])
    else if ($row['rank'] == 3 && isset($_SESSION['u_id'])) {
        $_SESSION['link'] = $link;
        if ($_SESSION['u_uid'] == $pUser) {
            authorPanel($lastUserToEdit);
        } //$_SESSION['u_uid'] == $pUser
    } //$row['rank'] == 3 && isset($_SESSION['u_id'])
} //$active == 1
