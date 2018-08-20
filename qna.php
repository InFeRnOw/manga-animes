<?php
session_start();
include 'INCLUDES/dbh-inc.php';
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
	// last request was more than 30 minutes ago
	$uid = $_SESSION['u_uid'];
	$sqlStatus = "UPDATE users SET user_online = 0 WHERE user_uid='$uid'";
	$resultStatus = mysqli_query($conn, $sqlStatus);
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
			<script src="/JS/donate.js"></script>
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

			<div id="page">
				<section id="post">
					<div class="divider-with-content"><h1>Questions and Answers!</h1></div>

            <p>Hey! Welcome to manga-animes.com, you'll see here all the informations needed!</p>

            <h2>What is the aim of our website ?</h2>
            <p>The aim of our website is to show correspondences between mangas and animes. (E.T, the Season one of XX just ended, the Season 2 is in one year, I can't wait and I want to read the manga! But at which chapter is the season one ending?). We know that there are some threads on forums that are telling you the correspondences but our website will regroup everything!</p>

            <h2>We need you!</h2>
            <p>In order to reference all the correspondences we need you!</p>

            <h2>How can I post a correspondence ?</h2>
            <p>Eveything is explained <a class="link" href="tuto.php"> HERE!</a></p>

            <h2>How can I contact a moderator or an Admin ?</h2>
            <p>We will soon have a <a class="link" href="qna.php?call=staff">"live contact"</a> for contacting an admin or a moderator! </p>

						<h2>I found a bug on the website, how can I report it ?</h2>
            <p>We have a <a class="link" href="bug-report.php">"bug report"</a> section in the <a class="link" href="contact.php">"Contact"</a></p>

						<h2>There is an image I would like to remove for copyright reasons, how can I do so ?</h2>
            <p>We have an <a class="link" href="copyright-images.php">"images"</a> section in <a class="link" href="contact.php">"Contact"</a></p>

            <h2>Why are we using Rōmaji instead of Japanese?</h2>
            <p>As most of the users are non-japanese we use Rōmaji instead of traditional Japanese. In the future updates we will add the traditional Japanese!</p>


					</section>
				</div>

      <!-- Footer -->

				<div id="footer">

          <?php include 'INCLUDES/html-inc/htmlFooterMain-inc.php' ?>

				</div>


        </div>
    </body>
</html>
