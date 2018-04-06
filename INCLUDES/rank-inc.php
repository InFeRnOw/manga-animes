<?php
session_start();
include 'dbh-inc.php';

    $rank = $_SESSION['u_rank'];
	if($rank == 1) {
		    echo '<script>
            window.location.href="login.php";
        </script>';
	}
	elseif($rank == 2) {
		
	}
	elseif($rank == 3) {
		
	}
	else {
		
	}