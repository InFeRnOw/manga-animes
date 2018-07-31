<?php
session_start();
include 'dbh-inc.php';

if (isset($_POST['submit'])) {
    $name = $_SESSION['u_uid'];
    $email = $_SESSION['u_email'];
    $subject = mysqli_real_escape_string($conn, $_POST['bugSubject']);
    $text = mysqli_real_escape_string($conn, $_POST['bugText']);

    if (empty($text)) {
        header("Location: ../bug-report.php?report=empty");
        exit();
    }
    else {
        $sql = "INSERT INTO bugreport (bugr_author, bugr_email, bugr_subject, bugr_text) VALUES ('$name', '$email', '$subject', '$text');";
        $result = mysqli_query($conn, $sql);
        header("Location: ../bug-report.php?report=sucess");
    }
}
elseif (isset($_POST['delete'])) {
    $reportId = mysqli_real_escape_string($conn, $_POST['reportId']);
    $sql = "DELETE FROM bugreport WHERE bugr_id='$reportId'";
    $result = mysqli_query($conn, $sql);
    header("Location: ../staff-panel.php?report=deleted");
}
