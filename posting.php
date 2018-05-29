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

			<!-- Main -->
				<section class="wrapper style1">
					<div class="container">
						<div id="content">

							<!-- Content -->

				<span class="image featured"><img src="images/banner.jpg" alt="" /></span>
          <?php include 'INCLUDES/errors-inc.php';  ?>
        <form action="INCLUDES/postMaker-inc.php" method="POST">
          <div class="container-fluid" style="text-align: center;">
              <div class="row">
              <div class="col-lg-4 col-md-4 col-xs-12"> <input type="text" name="title" placeholder="Title" style="border-color: black; margin-left: 0; width: 100%; border-radius:5px; height: 50px;"></div>
              <div class="col-lg-4 col-md-4 col-xs-12">
                          <SELECT class="selectpicker" name="status" size="1" style="border-color: black; margin-left: 0; width: 100%; border-radius:5px; height: 50px; margin-top: 9.5px;">
                                 <option value="" hidden disabled selected>Status</option>
                                 <OPTION value="In progress"><p>In progress</p>
                                 <OPTION value="On breack"><p>On breack</p>
                                 <OPTION value="Ended"><p>Ended</p>

                         </SELECT>
             </div>


                <div class="col-lg-4 col-md-4 col-xs-12">
                            <SELECT class="selectpicker" name="type" size="1" style="border-color: black; margin-left: 0; width: 100%; border-radius:5px; height: 50px; margin-top: 9.5px;">
                                 <option value="" hidden disabled selected>Type</option>
                                 <OPTION value="Shōnen"><p>Shōnen</p>
                                 <OPTION value="Shōjo"><p>Shōjo</p>
                                 <OPTION value="Seinen"><p>Seinen</p>
                                 <OPTION value="Josei"><p>Josei</p>
                                 <OPTION value="Harem"><p>Harem</p>
                                 <OPTION value="Reverse Harem"><p>Reverse Harem</p>
                                 <OPTION value="Romance"><p>Romance</p>
                                 <OPTION value="Comedy"><p>Comedy</p>
                                 <OPTION value="Ecchi"><p>Ecchi</p>
                                 <OPTION value="Mecha"><p>Mecha</p>
                                 <OPTION value="Lolicon"><p>Lolicon</p>
                                 <OPTION value="Shotacon"><p>Shotacon</p>
                                 <OPTION value="Drama"><p>Drama</p>
                                 <OPTION value="Supernatural"><p>Supernatural</p>
                                 <OPTION value="Slice of Life"><p>Slice of Life</p>
                                 <OPTION value="Hentai"><p>Hentai</p>
                                 <OPTION value="Yaoi"><p>Yaoi</p>
                                 <OPTION value="Yuri"><p>Yuri</p>

                          </SELECT>
             </div>
           </div>
             <div class="row">
         <div class="col-lg-12 col-xs-12"><textarea type="text" name="content" placeholder="Your content" style="border-color: black; height: auto; resize: none;"></textarea></div>
       </div>
             <div class="row">
         <div class="col-lg-12 col-xs-12"><button class="button" type="submit" name="submit">Post</button></div>
       </div>
     </div>
       </form>

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
