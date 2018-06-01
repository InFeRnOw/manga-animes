<?php
    session_start();
    include_once 'INCLUDES/dbh-inc.php';

    $link = $_GET['link'];
    $sql = "SELECT * FROM posts WHERE p_link = '$link'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $title = $row['p_title'];
    $content = $row['p_content'];
    $type = $row['p_type'];
    $genre = $row['p_genre'];
    $id = $_SESSION['u_id'];
    $likes = $row['p_likes'];
    $dislikes = $row['p_dislikes'];
    $active = $row['p_active'];
    $titleen = $row['p_titleen'];
    $genre = $row['p_genre'];
    $statusmanga = $row['p_statusmanga'];
    $status = $row['p_status'];
?>
<!DOCTYPE HTML>
<!--
	Arcana by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title><?php echo $title; ?></title>
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
			<!-- Main -->
				<section class="wrapper style1">
					<div class="container">
						<div id="content">

							<!-- Content -->

								<article>
									<header>
                    <h2><?php echo $title;  ?></h2>
                    <h3><?php echo $titleen;  ?></h3>
                  </br>
                    <div class="container-fluid">
                      <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><p><?php echo "Type: ".$type;  ?></p></div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><p><?php echo "Genre: ".$genre;  ?></p></div>
                      </div>
                      <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><p><?php echo "Status Manga: ".$statusmanga;  ?></p></div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><p><?php echo "Status Anime: ".$status;  ?></p></div>
                      </div>
                    </div>
									</header>
                <?php if ($active == 0) {
                  $sql = "SELECT * FROM users WHERE user_id='$id'";
                  $result = mysqli_query($conn, $sql);
                  $row = mysqli_fetch_assoc($result);
                  if($row['rank'] <= 2 && isset($_SESSION['u_id'])) {
                    $_SESSION['link'] = $link;
                    echo "<form id=voteForm action='INCLUDES/vote-inc.php' method='POST'>
                    <div class='container-fluid'>
                      <div class='row'>
                      <div class='col-lg-3 col-sm-6 col-xs-12'>
                        <button style='color: rgba(0,102,0,1); margin-bottom: 5px;' class='button' type='submit' name='accept'>Accept</button>
                      </div>
                        <div class='col-lg-3 col-sm-6 col-xs-12'>
                          <button style='color: rgba(0,255,0,1); margin-bottom: 5px;' class='button' type='submit' name='like'>Like ".$likes."</button>
                        </div>
                        <div class='col-lg-3 col-sm-6 col-xs-12'>
                          <button style='color: red; margin-bottom: 5px;' class='button' type='submit' name='dislike'>Dislike ".$dislikes."</button>
                        </div>
                        <div class='col-lg-3 col-sm-6 col-xs-12'>
                          <button style='color: rgba(102,0,51,1); margin-bottom: 5px;' class='button' type='submit' name='deny'>Deny</button>
                        </div>
                      </div>
                    </div>
                    </form>";
                  }
                  else if($row['rank'] == 3 && isset($_SESSION['u_id'])) {
                    $_SESSION['link'] = $link;
                    echo "<form id=voteForm action='INCLUDES/vote-inc.php' method='POST'>
                    <div class='container-fluid'>
                      <div class='row'>
                        <div class='col-lg-6 col-sm-6 col-xs-12'>
                          <button style='color: rgba(0,255,0,1); margin-bottom: 5px;' class='button' type='submit' name='like'>Like ".$likes."</button>
                        </div>
                        <div class='col-lg-6 col-sm-6 col-xs-12'>
                          <button style='color: red; margin-bottom: 5px;' class='button' type='submit' name='dislike'>Dislike ".$dislikes."</button>
                        </div>
                      </div>
                    </div>
                    </form>";
                  }
                  else {
                    echo "<p style='color: red;'>You need to login or register in order to vote on this post !</p>";
                  }
                }
                ?>
									<span class="image featured"><img src="images/banner.jpg" alt="" /></span>

									<p><?php echo $content;  ?></p>
								</article>

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
