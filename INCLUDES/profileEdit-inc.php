<?php
session_start();
include_once 'dbh-inc.php';
if (isset($_POST['submit'])) {
    $uid = $_SESSION['u_uid'];
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    if (empty($content)) {
        header("Location: ../settings.php?description=empty");
    } //empty($content)
    else {
        $sql = "UPDATE profiles SET pf_description='$content' WHERE pf_user='$uid';";
        $result = mysqli_query($conn, $sql);
        header("Location: ../settings.php?description=edited");
        exit();
    }
} //isset($_POST['submit'])
else {
    header("Location: ../settings.php?description=error");
}
