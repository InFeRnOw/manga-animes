<?php
    session_start();
    include_once 'INCLUDES/dbh-inc.php';
    if (!isset($_SESSION['u_id'])) {
    echo '<script>
            window.location.href="login.php";
        </script>';
    }
    else if ($_GET['status'] == "logout") {
      session_start(); //Start the current session
      session_unset();
      session_destroy(); //Destroy it! So we are logged out now
      header("Location: ../index.php?logout=succes");
      exit();
    }
    else {
      $id = $_GET['link'];

      $sql = "SELECT * FROM profiles WHERE pf_link='$id'";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      $user = $row['pf_user'];
      $description = $row['pf_description'];
    }
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
    <link rel="stylesheet" href="assets/css/secondairy.css" />
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
                                        <li><a href="latestPost.php">Latest posts</a></li>
										<li><a href="Alphabetic-order.php">Alphabetical order</a></li>
                                        <li><a href="In%20vote.php">In vote</a></li>

									</ul>
                    </li>
              <li><a href="News.php">News</a></li>
              <li><a href="Donate.php">Donate</a></li>
              <li class="current"><?php if (isset($_SESSION['u_id'])) {
                if ($_SESSION['u_id'] !== $id) {
                  echo "<a href='account.php'>Account</a>";
                }
                else {
                  echo "<a href='account.php?status=logout'>Logout</a>";
                }
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
                <?php if ($_SESSION['u_id'] == $id) {
                echo '<div class="row 200%">
                <div class="8u 12u(narrower)">';
                }
                else {
                  echo '<div>
                  <div>';
                }?>
								<div id="content">

									<!-- Content -->

										<article>
											<header>
                        <?php if ($_SESSION['u_id'] == $id) {
                          echo '<h2>' .$user. ' <a href="settings.php" style="text-decoration: none; color: white !important;"><button class="btn glyphicon glyphicon-cog"></button></a></h2>';
                        }
                        else {
                          $to = $_GET['link'];
                          $from = $_SESSION['u_id'];
                          echo '<h2>'.$user.' <a href="chat.php?to='.$to.'&from='.$from.'" style="text-decoration: none; color: white !important;"><button class="btn glyphicon glyphicon-envelope"></button></a></h2>';
                        }
                        ?>

                                  <?php $id = $_GET['link'];
                                        $sql = "SELECT * FROM users";
                                        $result = mysqli_query($conn, $sql);
                                        if (mysqli_num_rows($result) > 0) {
                                            if ($row = mysqli_fetch_assoc($result)) {
                                                $id = $_GET['link'];
                                                $sqlImg = "SELECT * FROM profileimg WHERE userid='$id'";
                                                $resultImg = mysqli_query($conn, $sqlImg);
                                                if ($rowImg = mysqli_fetch_assoc($resultImg)) {
                                                        if ($rowImg['status'] == 0) {
                                                          $filename = "uploads/profile".$id."*";
                                                          $fileinfo = glob($filename);
                                                          $fileext = explode(".", $fileinfo[0]);
                                                          $fileActualExt = $fileext[1];
                                                            echo '<div class="container-fluid">
                                                              <div class="row">
                                                                <div class="col-lg-12 col-xs-12">
                                                                  <img class="avatarOfUser" src="../uploads/profile'.$id.'.'.$fileActualExt.'?'.mt_rand().'">
                                                                </div>
                                                              </div>
                                                            </br>
                                                          </br>';
                                                        }
                                                        else {
                                                            echo '<div class="container-fluid">
                                                            <div class="row">
                                                              <div class="col-lg-12 col-xs-12">
                                                                <img class="avatarOfUser" src="images/symbol_questionmark.png">
                                                              </div>
                                                            </div>
                                                          </br>';
                                                        }
                                                      }
                                                    }
                                            }?>
    									</header>
                      <h3>Description</h3>
                      <?php echo $description; ?>
										</article>

								</div>
							</div>
                      <?php if ($_SESSION['u_id'] == $id) {
                        include 'INCLUDES/errors-inc.php';
                        echo '<div class="4u 12u(narrower)">
          								<div id="sidebar">
          										<section>
                        <form action="INCLUDES/friendRequest-inc.php" method="POST">
                          <div class="container-fluid">
                            <h4>Add a friend</h4>
                            <div class="row">
                              <div class="col-lg-10 col-sm-10 col-xs-10"><input type=text name=userAdd placeholder="Add friend"></div>
                              <div class="col-lg-2 col-sm-2 col-xs-2"><button type="submit" name="addSubmit" style="width: auto !important; height: 2.8em; margin-top: 0.05em; border-radius: 50%; background-color: #37c0fb; color: white;"><b>Add</b></button></div>
                            </div>
                          </div>
                        </form>
                      </br>
                      <div class="container-fluid">
                       <h4>Friend Requests</h4>
                     </div>';
                       include "INCLUDES/friendRequestInsert-inc.php";
                      echo '</br>
                      <div class="container-fluid">
                       <h4>Friend list</h4>
                     </div>';
                        include "INCLUDES/friendListInsert-inc.php";
  											echo '<footer>
  					               <p>/* FOOTER */</p>
  											</footer>
  										</section>
                      </div>
      							</div>';
                      }
                      ?>
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
