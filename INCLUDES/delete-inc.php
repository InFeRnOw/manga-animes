<?php
session_start();
include_once "dbh-inc.php";
$id = $_SESSION['u_id'];
if (isset($_POST['submitProfile'])) {
    $filename = "../uploads/profile" . $id . "*";
    $fileinfo = glob($filename);
    $fileext = explode(".", $fileinfo[0]);
    $fileActualExt = $fileext[1];
    $file = "../uploads/profile" . $id . ".jpg";
    if (!unlink($file)) {
        header("Location: ../settings.php?set&delete=failed");
    } //!unlink($file)
    else {
        header("Location: ../settings.php?set&delete=success");
        $sql = "UPDATE profileimg SET status=1 WHERE userid='$id';";
        mysqli_query($conn, $sql);
    }
} //isset($_POST['submitProfile'])
// $sql = "UPDATE profileimg SET userid='none',status=1 WHERE id='$id';";
