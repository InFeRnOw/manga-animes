<?php
    session_start();
    include_once 'INCLUDES/dbh-inc.php';
?>
<!DOCTYPE HTML>
<!--
	Arcana by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Register</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	</head>
	<body>
		<div id="page-wrapper">

			<!-- Header -->
				<div id="header">

					<!-- Logo -->
						<h1><a href="index.php" id="logo">Manga-Animes</a></h1>

					<!-- Nav -->
						<nav id="nav">
							<ul>
								<li><a href="index.php">Home</a></li>
								<li>
									<a href="#">Correspondence</a>
									<ul>
								        <li><a href="Top-Anime.php">Top Anime</a></li>
                                        <li><a href="Seasonal-Anime.php">Seasonal Anime</a></li>
										<li><a href="Alphabetic-order.php">Alphabetical order</a></li>
                                        <li><a href="In-vote.php">In vote</a></li>
									</ul>
								</li>
								<li><a href="News.php">News</a></li>
								<li><a href="Donate.php">Donate</a></li>
								<li><a href="login.php">Account</a></li>
							</ul>
						</nav>

				</div>

			<!-- Main -->
				<section class="wrapper style1">
					<div class="container">
						<div id="content">

							<!-- Content -->

				<span class="image featured"><img src="images/banner.jpg" alt="" /></span>
        <?php if(!isset($_GET['register'])) {
          echo "<form action='INCLUDES/register-inc.php' method='POST'>
            <input class='username' type='text' name='uid' placeholder='Username'>
            <input type='password' name='pass1' placeholder='Password'>
            <input type='password' name='pass2' placeholder='Confirm password'>
            <input type='text' name='email' placeholder='Email'>
                          <br/>
              <button class='button' type='submit' name='submit'>Register</button>
         </form>";
            exit();
        }
        else {
          $registerCheck = $_GET['register'];

            if($registerCheck == "empty") {
              echo "<p style='color: red;'>Some fields are empty !</p>";
            }
            elseif ($registerCheck == "emailinvalid") {
              echo "<p style='color: red;'>Invalid email !</p>";
            }
            elseif ($registerCheck == "emailtaken") {
              echo "<p style='color: red;'>Email is already used !</p>";
            }
            elseif ($registerCheck == "usernametaken") {
              echo "<p style='color: red;'>Username is already used !</p>";
            }
            elseif ($registerCheck == "passwordconfirm") {
              echo "<p style='color: red;'>Passwords do not match !</p>";
            }
        }  ?>
        <form action="INCLUDES/register-inc.php" method="POST">
          <input class="username" type="text" name="uid" placeholder="Username">
          <input type="password" name="pass1" placeholder="Password">
          <input type="password" name="pass2" placeholder="Confirm password">
          <input type="text" name="email" placeholder="Email">
                        <br/>
            <button class="button" type="submit" name="submit">Register</button>
       </form>

						</div>
					</div>
				</section>

			<!-- Footer -->
				<div id="footer">
					<div class="container">
						<div class="row">
							<section class="3u 6u(narrower) 12u$(mobilep)">
								<h3>Links to Stuff</h3>
								<ul class="links">
									<li><a href="#">Mattis et quis rutrum</a></li>
									<li><a href="#">Suspendisse amet varius</a></li>
									<li><a href="#">Sed et dapibus quis</a></li>
									<li><a href="#">Rutrum accumsan dolor</a></li>
									<li><a href="#">Mattis rutrum accumsan</a></li>
									<li><a href="#">Suspendisse varius nibh</a></li>
									<li><a href="#">Sed et dapibus mattis</a></li>
								</ul>
							</section>
							<section class="3u 6u$(narrower) 12u$(mobilep)">
								<h3>More Links to Stuff</h3>
								<ul class="links">
									<li><a href="#">Duis neque nisi dapibus</a></li>
									<li><a href="#">Sed et dapibus quis</a></li>
									<li><a href="#">Rutrum accumsan sed</a></li>
									<li><a href="#">Mattis et sed accumsan</a></li>
									<li><a href="#">Duis neque nisi sed</a></li>
									<li><a href="#">Sed et dapibus quis</a></li>
									<li><a href="#">Rutrum amet varius</a></li>
								</ul>
							</section>
							<section class="6u 12u(narrower)">
								<h3>Contact us</h3>
								<form>
									<div class="row 50%">
										<div class="6u 12u(mobilep)">
											<input type="text" name="name" id="name" placeholder="Name" />
										</div>
										<div class="6u 12u(mobilep)">
											<input type="email" name="email" id="email" placeholder="Email" />
										</div>
									</div>
									<div class="row 50%">
										<div class="12u">
											<textarea name="message" id="message" placeholder="Message" rows="5"></textarea>
										</div>
									</div>
									<div class="row 50%">
										<div class="12u">
											<ul class="actions">
												<li><input type="submit" class="button alt" value="Send Message" /></li>
											</ul>
										</div>
									</div>
								</form>
							</section>
						</div>
					</div>

					<!-- Icons -->
						<ul class="icons">
							<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
							<li><a href="https://github.com/InFeRnOw/manga-animes" class="icon fa-github"><span class="label">GitHub</span></a></li>
							<!-- <li><a href="#" class="icon fa-google-plus"><span class="label">Google+</span></a></li> -->
						</ul>

					<!-- Copyright -->
						<div class="copyright">
							<ul class="menu">
								<li>&copy; Manga-Animes. All rights reserved</li><li>Design: <a href="http://html5up.net">HTML5 UP</a> *modified*</li>
							</ul>
						</div>

				</div>

		</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

    </body>
</html>
