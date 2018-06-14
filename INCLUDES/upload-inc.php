<?php
session_start();
include_once 'dbh-inc.php';
$id = $_SESSION['u_id'];

if (isset($_POST['submitProfile'])) {
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
            if ($fileSize < 625000) {
                $fileNameNew = "profile".$id.".".$fileActualExt;
                $fileNameOld = "profile".$id.".".$allowed;
                $fileDestination = '../uploads/'.$fileNameNew;
                if (move_uploaded_file($fileTmpName, $fileDestination)) {
                    $sql = "UPDATE profileimg SET status=0 WHERE userid='$id';";
                    $result = mysqli_query($conn, $sql);
                    header("Location: ../settings.php?set&upload=success");
                }
                else {
                    header("Location: ../settings.php?set&upload=failed");
                }
            }
            else {
                header("Location: ../settings.php?set&upload=toobigfile");
            }
        }
        else {
            header("Location: ../settings.php?set&upload=error");
        }
    }
    else {
        header("Location: ../settings.php?set&upload=invalidtype");
    }
}
