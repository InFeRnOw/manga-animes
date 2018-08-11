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
					<div class="divider-with-content"><h1>Our rules</h1></div>
  					<h2>1. Be friendly</h2>
            <p>Give advices, help others, try filling up your description and putting a profile picture.</p>
            <h2>2. Be respectful</h2>
            <p>Everyone makes mistakes, everyone has his own way of doing a post (will be corrected by admins/modos).</p>
            <h2>3. Copyrights</h2>
            <p>If your reference isn't your own personal referencement, please credit the real author (use a link if possible or a name/username).</p>
            <p>Please give credits to the author of images you use for the respect of his work and please understand that if an author of any image asks to take away one image, we will do so and ask for you to find a replacement.</p>
            <h2>4. Images posted by users</h2>
            <p>Do not post any innapropriate images, neither on a post nor on your profile picture.</p>
            <h2>5. Help the website</h2>
            <p>Please report any bugs encountered, so that we may fix as quick as possible.</p>
            <p>If you wanna participate in it's developpement please contact us (manga.animes.website@gmail.com).</p>
            <h2>6. Contact</h2>
            <p>Please do not abuse of the contact system, once sended it may take a while for an admin to see it (maximum 72H).</p>
            <h2>7. Multiple accounts</h2>
            <p>Please do not make double accounts, if you lost yours then you may do so but for contacting us (normally you should be able to get it back with the "forget username or password ?").</p>
            <h2>7. Suggestions</h2>
            <p>For suggestions, go to the contact section then to suggestions, please do not make absurd suggestions.</p>
					</section>
				</div>

      <!-- Footer -->

				<div id="footer">

          <?php include 'INCLUDES/html-inc/htmlFooterMain-inc.php' ?>

				</div>


        </div>
    </body>
</html>
