<?php
    session_start();
    include_once 'INCLUDES/dbh-inc.php';
    if (!isset($_SESSION['u_id'])) {
    echo '<script>
            window.location.href="login.php";
        </script>';
    }
    else if ($_GET['status'] == "logout") {
      session_start(); //Start the current session
      session_unset();
      session_destroy(); //Destroy it! So we are logged out now
      header("Location: ../index.php?logout=succes");
      exit();
    }
    else {

      $id = $_SESSION['u_id'];
      header("Location: ../profile.php?link=$id");
    }
?>
