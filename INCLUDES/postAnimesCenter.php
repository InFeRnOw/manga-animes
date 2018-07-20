<?php
session_start();
if (isset($_POST['submit'])) {
    include 'dbh-inc.php';
    $letter = mysqli_real_escape_string($conn, $_POST['animesCenter']);
    $langage = mysqli_real_escape_string($conn, $_POST['lang']);
    if ($langage == "jap") {
        // alphabetic code here
        header("Location: ../animes-center.php?lang=$langage&letter=$letter");
    } //$langage == "jap"
    else if ($langage == "en") {
        header("Location: ../animes-center.php?lang=$langage&letter=$letter");
    } //$langage == "en"
    else {
        header("Location: ../animes-center.php");
    }
} //isset($_POST['submit'])
