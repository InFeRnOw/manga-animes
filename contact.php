<?php
session_start();
include 'INCLUDES/dbh-inc.php';
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
	// last request was more than 30 minutes ago
	session_unset();     // unset $_SESSION variable for the run-time
	session_destroy();   // destroy session data in storage
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

if (!isset($_SESSION['CREATED'])) {
    $_SESSION['CREATED'] = time();
} else if (time() - $_SESSION['CREATED'] > 1800) {
    // session started more than 30 minutes ago
    session_regenerate_id(true);    // change session ID for the current session and invalidate old session ID
    $_SESSION['CREATED'] = time();  // update creation time
}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Manga-Animes</title>
  		<meta charset="utf-8" />
  		<meta name="viewport" content="width=device-width, initial-scale=1" />
			<link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
			<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
		<link rel="stylesheet" href="CSS/main.css">
	</head>
	<body>
		<div class="container-fluid">
			<!-- Header -->
				<div id="header">

					<?php include 'INCLUDES/html-inc/htmlHeaderMain-inc.php' ?>

					<div class="divider-nav"></div>
        </div>

    	<!-- Page -->
            </div>
              <a class="btn" href="bug-report.php">Bug Report</a>
              <a class="btn">Suggestions</a>

          <!--   <h1>Contact us</h1>


            <form method="post" action="<?php echo strip_tags($_SERVER['REQUEST_URI']); ?>">
                    <p>Name <span style="color:#ff0000;">*</span>: <input type="text" name="nom" size="30" value="<?php echo $_SESSION['u_uid']?>"/> </p>
                    <p>Email <span style="color:#ff0000;">*</span>: <input type="text" name="email" size="30" value="<?php echo $_SESSION['u_email']?>"/></p>
                    <p>Message: <span style="color:#ff0000;">*</span>:</p>
                    <textarea name="message" cols="60" rows="10"></textarea>
                <!-- Ici pourra être ajouté un captcha anti-spam (plus tard) -->
               <!--     <p><input type="submit" name="submit" value="Send" /></p>
            </form> -->


        	<!-- Footer -->

				<div id="footer">

          <?php include 'INCLUDES/html-inc/htmlFooterMain-inc.php' ?>

				</div>


        </div>
    </body>
</html>
