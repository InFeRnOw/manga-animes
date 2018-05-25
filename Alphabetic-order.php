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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
						<h1><a href="index.html" id="logo">Manga-Animes</a></h1>

					<!-- Nav -->
						<nav id="nav">
							<ul>
								<li><a href="index.php">Home</a></li>
								<li>
									<a href="#">Correspondence</a>
									<ul>
								        <li><a href="Top-Anime.php">Top Anime</a></li>
                                        <li><a href="Seasonal-Anime.php">Seasonal Anime</a></li>
										<li class="current"><a href="Alphabetic%20order.php">Alphabetical order</a></li>
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

								<article>
									<header>
										<h2>Alphabetic Order</h2>
										<p>Log in in order to do a new post!</p>
									</header>

                                      <div>

                                    <FORM>
                                        <SELECT name="AlphabeticOrder" size="1" >

                                 <OPTION value="A"><p>A</p>
                                 <OPTION value="B"><p>B</p>
                                 <OPTION value="C"><p>C</p>
                                 <OPTION value="D"><p>D</p>
                                 <OPTION value="E"><p>E</p>
                                 <OPTION value="F"><p>F</p>
                                 <OPTION value="G"><p>G</p>
                                 <OPTION value="H"><p>H</p>
                                 <OPTION value="I"><p>I</p>
                                 <OPTION value="J"><p>J</p>
                                 <OPTION value="K"><p>K</p>
                                 <OPTION value="L"><p>L</p>
                                 <OPTION value="M"><p>M</p>
                                 <OPTION value="N"><p>N</p>
                                 <OPTION value="O"><p>O</p>
                                 <OPTION value="P"><p>P</p>
                                 <OPTION value="Q"><p>Q</p>
                                 <OPTION value="R"><p>R</p>
                                 <OPTION value="S"><p>S</p>
                                 <OPTION value="T"><p>T</p>
                                 <OPTION value="U"><p>U</p>
                                 <OPTION value="V"><p>V</p>
                                 <OPTION value="W"><p>W</p>
                                 <OPTION value="X"><p>X</p>
                                 <OPTION value="Y"><p>Y</p>
                                 <OPTION value="Z"><p>Z</p>
                                 <OPTION value="n"><p>0->9</p>
                                 <OPTION value="Other"><p>Other</p>

                                        </SELECT>
                                    </FORM>

            </div>


    <script>
        $(document).ready(function () {
            $(".postBox").load("INCLUDES/postInsert-inc.php");
                setInterval(function(){
                 $('.postBox').load('INCLUDES/postInsert-inc.php');
             }, 1000);
        });
    </script>

                    <?php if(isset($_SESSION['u_id'])) {
                      echo '</br><a href="posting.php" class="button" style="background-color: rgba(59, 87, 135, 1) !important; color: white !important;">New post</a>';
                    }?>

                        <div class="post">
                            <?php include 'INCLUDES/postInsert-inc.php' ?>
                        </div>

								</article>
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
								<h3>Get In Touch</h3>
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
