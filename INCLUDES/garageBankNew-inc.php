<?php
session_start();
if (isset($_POST['plus'])) {
    include 'dbh-inc.php';
    $uid = $_SESSION['u_uid'];
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $currency = mysqli_real_escape_string($conn, $_POST['currency']);
    $currencyForDb = '<span style="color: green">+ '.$currency.'</span>';

    if (empty($currency) || empty($description)) {
        header("Location: ../garage.php?posting=blank");
    }
    else {
        $sql = "INSERT INTO garage (g_id, g_currency, g_description, g_author) VALUES (NULL, '$currencyForDb', '$description', '$uid')";
        $result = mysqli_query($conn, $sql);

        $sql = "SELECT * FROM  garage WHERE g_id=1";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $currentCurrency = $row['g_currency'];
        $newCurrency = $currentCurrency + $currency;

        $sql = "UPDATE garage SET g_currency = $newCurrency WHERE g_id=1";
        $result = mysqli_query($conn, $sql);

        header("Location: ../garage.php?posting=success");
    }
} //isset($_POST['plus'])

if (isset($_POST['minus'])) {
    include 'dbh-inc.php';
    $uid = $_SESSION['u_uid'];
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $currency = mysqli_real_escape_string($conn, $_POST['currency']);
    $currencyForDb = '<span style="color: red">- '.$currency.'</span>';

    if (empty($currency) || empty($description)) {
        header("Location: ../garage.php?posting=blank");
    } //empty($title) || empty($status) || empty($type) || empty($titleEn) || empty($newGenre) || empty($statusManga) || empty($content) || empty($season) || empty($episodes) || empty($adaptation)
    else {
        $sql = "INSERT INTO garage (g_id, g_currency, g_description, g_author) VALUES (NULL, '$currencyForDb', '$description', '$uid')";
        $result = mysqli_query($conn, $sql);

        $sql = "SELECT * FROM  garage WHERE g_id=1";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $currentCurrency = $row['g_currency'];
        $newCurrency = $currentCurrency - $currency;

        $sql = "UPDATE garage SET g_currency = $newCurrency WHERE g_id=1";
        $result = mysqli_query($conn, $sql);

        header("Location: ../garage.php?posting=success");
    }
} //isset($_POST['submit'])
