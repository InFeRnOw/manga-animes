<?php
session_start();
if (isset($_POST['submit'])) {
    include 'dbh-inc.php';
    $letter = mysqli_real_escape_string($conn, $_POST['alphabeticOrder']);
    $langage = mysqli_real_escape_string($conn, $_POST['lang']);
    if ($langage == "jap") {
        // alphabetic code here
        header("Location: ../currently-airing.php?lang=$langage&letter=$letter");
    } //$langage == "jap"
    else if ($langage == "en") {
        header("Location: ../currently-airing.php?lang=$langage&letter=$letter");
    } //$langage == "en"
    else {
        header("Location: ../currently-airing.php");
    }
} //isset($_POST['submit'])
