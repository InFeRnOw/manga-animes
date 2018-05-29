<?php

if (isset($_POST['submit'])) {
    session_start(); //Start the current session
    session_unset();
    session_destroy(); //Destroy it! So we are logged out now
    header("Location: ../index.php?logout=succes");
    exit();
}
