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
		<META NAME="TITLE" CONTENT="Manga Animes: A site for referencing your favorite mangas and animes">
		<META NAME="AUTHOR" CONTENT="Erwan FRANCO--TETU, Corentin COUVREUX">
		<META NAME="DESCRIPTION" CONTENT="Join our community to reference your favorite mangas and animes">
		<META NAME="KEYWORDS" CONTENT="manga, anime, mangas, animes, referencing, community">
		<META NAME="OWNER" CONTENT="Corentin COUVREUX">
		<META NAME="ROBOTS" CONTENT="index">
		<META NAME="Reply-to" CONTENT="couvreux_corentin@yahoo.fr">
		<META NAME="REVISIT-AFTER" CONTENT="15">
		<link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
			<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
		<link rel="stylesheet" href="CSS/main.css">
	</head>
	<body>
		<div class="container-fluid">
			<!-- Header -->
				<div id="header">

					<?php include 'INCLUDES/html-inc/htmlHeaderMain-inc.php' ?>

					<div class="divider-nav"></div>

					<!-- Banner -->
	            <div id="banner">
	              <div>
	                <h2><em>Manga-Animes: </em><span>A site for referencing your favorite mangas and animes</span></h2>
	              </div>
	            </div>

				</div>

        <div id="page">
          <section id="header">
						<div class="container-fluid">
	            <div class="row">
	              <div class="col-md-4 col-xs-12">
									<div class="divider"></div>
	                <span class="glyphicon glyphicon-pencil"></span>
									<h2>Rules</h2>
                                    <p>Be sure to read our rules to fit with our community!</p>
                                    <br/>
									<a class="btn" href="rules.php">See more</a>
									<div class="divider"></div>
								</div>
	              <div class="col-md-4 col-xs-12">
									<div class="divider hidden-xs"></div>
	                <span class="glyphicon glyphicon-euro"></span>
									<h2>Help us</h2>
                                    <p>As we don't put any ads on our website, we need your support to help us!</p>
									<a class="btn" href="donate.php">See more</a>
									<div class="divider"></div>
								</div>
	              <div class="col-md-4 col-xs-12">
					  <?php if (isset($_SESSION['u_id'])) {
						  echo '<div class="divider hidden-xs"></div>
					  				  <span class="glyphicon glyphicon-envelope"></span>
									  <h2>News</h2>
                    <p>Latest news about our website and the upcoming features!</p>
                    <br/>
									  <a class="btn" href="news.php">See more</a>
									  <div class="divider"></div>
								  </div>';
					  		}
							else {
								echo '<div class="divider hidden-xs"></div>
										<span class="glyphicon glyphicon-sunglasses"></span>
										<h2>New here??</h2>
										<p>Be sure to know how our website works with our QnA!</p>
                    <br/>
										<a class="btn" href="qna.php">See more</a>
										<div class="divider"></div>
									</div>';
							}	 ?>
	            </div>
						</div>
          </section>

						<div class="divider-with-content"><h1>Our ranks</h1></div>

					<section id="content">
						<div class="container-fluid">
							<div class="row">
								<div id="rank" class="col-md-6 col-xs-12">
									<div class="row">
										<div class="col-xs-4">
											<img src="CSS/images/king-image.jpg" alt="image 1"/>
										</div>
										<div class="col-xs-8">
											<h2>Admin</h2>
											<p>Has the power of a king.</p>
										</div>
									</div>
								</div>
								<div id="rank" class="col-md-6 col-xs-12">
									<div class="row">
										<div class="col-xs-4">
											<img src="CSS/images/modo-image.jpg" alt="image 2"/>
										</div>
										<div class="col-xs-8">
											<h2>Moderator</h2>
											<p>Helps and manages the community.</p>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div id="rank" class="col-md-6 col-xs-12">
									<div class="row">
										<div class="col-xs-4">
											<img src="CSS/images/Mikasa.jpg" alt="image 3"/>
										</div>
										<div class="col-xs-8">
											<h2>Member</h2>
											<p>Can do anything that concerns a user</p>
										</div>
									</div>
								</div>
								<div id="rank" class="col-md-6 col-xs-12">
									<div class="row">
										<div class="col-xs-4">
											<img src="CSS/images/Chiyuki.jpg" alt="image 4"/>
										</div>
										<div class="col-xs-8">
											<h2>Visitor</h2>
											<p>Can visit anything but can't interact like users</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</section>
				</div>

			<!-- Footer -->
				<div id="footer">

          <?php include 'INCLUDES/html-inc/htmlFooterMain-inc.php' ?>

				</div>
			</div>
	</body>
</html>
