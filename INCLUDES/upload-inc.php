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
    $allowed = array('jpg', 'jpeg', 'png', 'ico');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 500000) {
                $fileNameNew = "profile".$id.".".$fileActualExt;
                $fileDestination = '../uploads/'.$fileNameNew;
                if (move_uploaded_file($fileTmpName, $fileDestination)) {
                    $sql ="INSERT INTO profileimg (userid, status) VALUES ('$id', 0);";
                    $result = mysqli_query($conn, $sql);
                    header("Location: ../account.php?upload=success");
                }
                else {
                    header("Location: ../account.php?upload=failed");
                }
            }
            else {
                header("Location: ../account.php?upload=toobigfile");
            }
        }
        else {
            header("Location: ../account.php?upload=error");
        }
    }
    else {
        header("Location: ../account.php?upload=invalidtype");
    }
}
