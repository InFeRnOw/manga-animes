<?php
session_start();
if (isset($_POST['friendAdd'])) {
    include 'dbh-inc.php';
    $link = $_SESSION['u_id'];
    $sender = $_SESSION['u_uid'];
    $actualUser = $_SESSION['u_uid'];
    $receiver = mysqli_real_escape_string($conn, $_POST['friend']);
    //Error handlers
    //Check if inputs are empty
    if (empty($sender) || empty($receiver) || $receiver == $sender) {
        header("Location: ../friend.php?add=error&link=$link");
        exit();
    } //empty($sender) || empty($receiver) || $receiver == $sender
    else {
        $sql = "SELECT * FROM users WHERE user_uid = '$receiver'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck < 1) {
            header("Location: ../friend.php?add=noexist&link=$link");
            exit();
        } //$resultCheck < 1
        else {
            $sql = "SELECT * FROM users WHERE user_uid = '$receiver'";
            $result = mysqli_query($conn, $sql);
            if ($row = mysqli_fetch_assoc($result)) {
                $status = $row['user_active'];
                if ($status == 0) {
                    header("Location: ../friend.php?add=userNotActive&link=$link");
                    exit();
                } //$status == 0
                else {
                    $sql = "SELECT * FROM friends WHERE f_receiver = '$actualUser' AND f_sender = '$receiver' OR f_sender= '$actualUser' AND f_receiver = '$receiver'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $resultCheck = mysqli_num_rows($result);
                    if ($resultCheck > 0) {
                        header("Location: ../friend.php?add=alreadyAdded&link=$link");
                    } //$resultCheck > 0
                    else {
                        $sql = "INSERT INTO friends (f_sender, f_receiver, f_status) VALUES ('$sender', '$receiver', 0)";
                        $result = mysqli_query($conn, $sql);
                        header("Location: ../friend.php?add=success&link=$link");
                        exit();
                    }
                }
            } //$row = mysqli_fetch_assoc($result)
        }
    } //$row = mysqli_fetch_assoc($result)
} //isset($_POST['friendAdd'])
else {
    header("Location: ../index.php?add=errorUnknown");
    exit();
}
