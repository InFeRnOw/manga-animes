<?php
session_start();
include_once 'dbh-inc.php';
$id = $_SESSION['u_id'];

if (isset($_POST['submit'])) {
    $file = $_FILES['avatar'];
    $fileName = $_FILES['avatar']['name'];
    $fileTmpName = $_FILES['avatar']['tmp_name'];
    $fileSize = $_FILES['avatar']['size'];
    $fileError = $_FILES['avatar']['error'];
    $fileType = $_FILES['avatar']['type'];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 500000) {
                $fileNameNew = "profile".$id.".".$fileActualExt;
                $fileNameOld = "profile".$id.".".$allowed;
                $fileDestination = '../uploads/'.$fileNameNew;
                if (move_uploaded_file($fileTmpName, $fileDestination)) {
                    $sql = "UPDATE profileimg SET status=0 WHERE userid='$id';";
                    $result = mysqli_query($conn, $sql);
                    header("Location: ../settings.php?upload=success");
                }
                else {
                    header("Location: ../settings.php?upload=failed");
                }
            }
            else {
                header("Location: ../settings.php?upload=toobigfile");
            }
        }
        else {
            header("Location: ../settings.php?upload=error");
        }
    }
    else {
        header("Location: ../settings.php?upload=invalidtype");
    }
}
