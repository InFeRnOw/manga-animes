<?php
session_start();
include_once "dbh-inc.php";
$id = $_SESSION['u_id'];

$filename = "../uploads/profile".$id."*";
$fileinfo = glob($filename);
$fileext = explode(".", $fileinfo[0]);
$fileActualExt = $fileext[1];

$file = "../uploads/profile".$id.".".$fileActualExt;

if (!unlink($file)) {
  header("Location: ../settings.php?delete=failed");
}
else {
  header("Location: ../setting.php?delete=success");
}

// $sql = "UPDATE profileimg SET userid='none',status=1 WHERE id='$id';";
$sql = "UPDATE profileimg SET status=1 WHERE userid='$id';";
mysqli_query($conn, $sql);

header("Location: ../settings.php?delete=success");
