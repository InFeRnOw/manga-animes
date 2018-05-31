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
		<title>Manga-Animes</title>
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
								<li class="current"><a href="index.php">Home</a></li>
								<li>
									<a href="#">Correspondence</a>
									<ul>
								        <li><a href="Top-Anime.php">Top Anime</a></li>
                                        <li><a href="Seasonal-Anime.php">Seasonal Anime</a></li>
										<li><a href="Alphabetic-order.php">Alphabetical order</a></li>
                                        <li><a href="In%20vote.php">In vote</a></li>
									</ul>
								</li>
								<li><a href="News.php">News</a></li>
								<li><a href="Donate.php">Donate</a></li>
                <li><?php if (isset($_SESSION['u_id'])) {
                echo '<a href="account.php">Account</a>';
                }
                else {
                  echo '<a href="login.php">Login</a>';
                } ?></li>
							</ul>
						</nav>

				</div>

			<!-- Banner -->
				<section id="banner">
					<header>
						<h2>Manga-Animes: <em>A site for referencing your favorite mangas and animes</em></h2>
						<a href="Rules.php" class="button">Our rules</a>
					</header>
				</section>

			<!-- Highlights -->
				<section class="wrapper style1">
					<div class="container">
						<div class="row 200%">
							<section class="4u 12u(narrower)">
								<div class="box highlight">
									<i class="icon major fa-paper-plane"></i>
									<h3>News</h3>
									<p>Latest news about our website and the upcoming features!</p>
                                       <a href="News.php" class="button">News</a>
								</div>
							</section>
							<section class="4u 12u(narrower)">
								<div class="box highlight">
									<i class="icon major fa-pencil"></i>
									<h3>Help us!</h3>
                                    <p>As we don't put any ad on our website, we need your support to help us!</p>
                                       <a href="Donate.php" class="button">Donate</a>
								</div>
							</section>
							<section class="4u 12u(narrower)">
								<div class="box highlight">
									<i class="icon major fa-wrench"></i>
									<h3>Join us!</h3>
									<p>If you want to be able to post a correspondence, be sure to join us!</p>
                                       <a href="register.php" class="button">Join us!</a>
								</div>
							</section>
						</div>
					</div>
				</section>

			<!-- Gigantic Heading -->
				<section class="wrapper style2">
					<div class="container">
						<header class="major">
						</header>
					</div>
				</section>

			<!-- Posts -->
				<section class="wrapper style1">
					<div class="container">
						<div class="row">
							<section class="6u 12u(narrower)">
								<div class="box post">
									<a href="#" class="image left"><img src="images/pic01.jpg" alt="" /></a>
									<div class="inner">
										<h3>Admin</h3>
										<p>The power of a king.</p>
									</div>
								</div>
							</section>
							<section class="6u 12u(narrower)">
								<div class="box post">
									<a href="#" class="image left"><img src="images/pic02.jpg" alt="" /></a>
									<div class="inner">
										<h3>Moderator</h3>
                                        <p>Can post whatever he wants and helps us manage the commuity.</p>
									</div>
								</div>
							</section>
						</div>
						<div class="row">
							<section class="6u 12u(narrower)">
								<div class="box post">
									<a href="#" class="image left"><img src="images/pic03.jpg" alt="" /></a>
									<div class="inner">
										<h3>Member</h3>
										<p>Can suggest a correspondence.</p>
									</div>
								</div>
							</section>
							<section class="6u 12u(narrower)">
								<div class="box post">
									<a href="#" class="image left"><img src="images/pic04.jpg" alt="" /></a>
									<div class="inner">
										<h3>No rank</h3>
										<p>Can see all correspondence.</p>
									</div>
								</div>
							</section>
						</div>
					</div>
				</section>

			<!-- CTA -->
				<section id="cta" class="wrapper style3">
					<div class="container">
						<header>
							<h2>Join our community and help us grow !</h2>
							<a href="register.php" class="button">Register now</a>
						</header>
					</div>
				</section>

			<!-- Footer -->
				<div id="footer">
					<div class="container">
						<div class="row">
							<section class="3u 6u(narrower) 12u$(mobilep)">
								<h3>Links to Stuff</h3>
								<ul class="links">
									<li><a href="Bonus.php">Mattis et quis rutrum</a></li>
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
