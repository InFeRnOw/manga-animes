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
  header("Location: ../account.php?delete=failed");
}
else {
  header("Location: ../account.php?delete=success");
}

$sql = "UPDATE profileimg SET status=1 WHERE userid='$id';";
mysqli_query($conn, $sql);

header("Location: ../account.php?delete=success");
