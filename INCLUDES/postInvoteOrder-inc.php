<?php
session_start();
if (isset($_POST['submit'])) {
    include 'dbh-inc.php';

    $letter = mysqli_real_escape_string($conn, $_POST['alphabeticOrder']);
    $langage = mysqli_real_escape_string($conn, $_POST['lang']);

    if ($langage == "jap") {
      // alphabetic code here
      header("Location: ../In-vote.php?lang=$langage&letter=$letter");
    }
    else if($langage == "en") {
      header("Location: ../In-vote.php?lang=$langage&letter=$letter");
    }
    else {
      header("Location: ../In-vote.php");
    }
}
