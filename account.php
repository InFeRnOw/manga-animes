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
										<li><a href="Alphabetic-order.php">Alphabetical order</a></li>
                                        <li><a href="In%20vote.php">In vote</a></li>

									</ul>
                    </li>
              <li><a href="News.php">News</a></li>
              <li><a href="Donate.php">Donate</a></li>
              <li class="current"><?php if (isset($_SESSION['u_id'])) {
              echo "<a href='account.php?status=logout'>Logout</a>";
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
										<?php echo '<h2>' .$_SESSION["u_uid"]. '</h2>';?>
										<p>Customize your profile</p>

                              <?php $id = $_SESSION['u_id'];
                                    $sql = "SELECT * FROM users";
                                    $result = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        if ($row = mysqli_fetch_assoc($result)) {
                                            $id = $_SESSION['u_id'];
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
                                                              <p style="font-size:12px;">Only jpg, jpeg, png and ico is supported</p>
                                                            </div>
                                                          </div>
                                                              <form action="INCLUDES/upload-inc.php" method="POST" enctype="multipart/form-data">
                                                                <div class="row">
                                                                <div class="col-lg-4 col-xs-1"></div>
                                                                  <div class="col-lg-4 col-xs-10"><input class="fileSelector btn btn-basic" type="file" name="avatar" style="width: 100%; margin-left: 0;"></div>
                                                                  <div class="col-lg-4 col-xs-1"></div>
                                                                  </div>
                                                                  <div class="row">
                                                                  <div class="col-lg-12 col-xs-12"><button class="fileSubmit button" type="submit" name="submit" style="border: 2px solid green">Save</button></div>
                                                                </div>
                                                              </form>
                                                            </div>
                                                            </br>
                                                          <div class="col-lg-12 col-xs-12">
                                                            <form action="INCLUDES/delete-inc.php" method="POST">
                                                                <button class="fileDelete button" type="submit" name="submit" style="border: 2px solid red">Delete</button>
                                                            </form>
                                                          </div>
                                                          </br>
                                                        </br>';
                                                    }
                                                    else {
                                                        echo '<div class="container-fluid">
                                                        <div class="row">
                                                          <div class="col-lg-12 col-xs-12">
                                                            <img class="avatarOfUser" src="images/symbol_questionmark.png">
                                                            <p style="font-size:12px;">Only jpg is supported</p>
                                                          </div>
                                                        </div>
                                                            <form action="INCLUDES/upload-inc.php" method="POST" enctype="multipart/form-data">
                                                              <div class="row">
                                                              <div class="col-lg-4 col-xs-1"></div>
                                                                <div class="col-lg-4 col-xs-10"><input class="fileSelector btn btn-basic" type="file" name="avatar" style="width: 100%; margin-left: 0;"></div>
                                                                <div class="col-lg-4 col-xs-1"></div>
                                                                </div>
                                                                <div class="row">
                                                                <div class="col-lg-12 col-xs-12"><button class="fileSubmit button" type="submit" name="submit">Save</button></div>
                                                              </div>
                                                            </form>
                                                          </div>
                                                          </br>';
                                                    }
                                                  }
                                                }
                                        }?>
									</header>

									<p>Phasellus quam turpis, feugiat sit amet ornare in, hendrerit in lectus.
									Praesent semper mod quis eget mi. Etiam eu ante risus. Aliquam erat volutpat.
									Aliquam luctus et mattis lectus sit amet pulvinar. Nam turpis nisi
									consequat etiam lorem ipsum dolor sit amet nullam.</p>

									<h3>And Yet Another Subheading</h3>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ac quam risus, at tempus
									justo. Sed dictum rutrum massa eu volutpat. Quisque vitae hendrerit sem. Pellentesque lorem felis,
									ultricies a bibendum id, bibendum sit amet nisl. Mauris et lorem quam. Maecenas rutrum imperdiet
									vulputate. Nulla quis nibh ipsum, sed egestas justo. Morbi ut ante mattis orci convallis tempor.
									Etiam a lacus a lacus pharetra porttitor quis accumsan odio. Sed vel euismod nisi. Etiam convallis
									rhoncus dui quis euismod. Maecenas lorem tellus, congue et condimentum ac, ullamcorper non sapien.
									Donec sagittis massa et leo semper a scelerisque metus faucibus. Morbi congue mattis mi.
									Phasellus sed nisl vitae risus tristique volutpat. Cras rutrum commodo luctus.</p>

									<p>Phasellus odio risus, faucibus et viverra vitae, eleifend ac purus. Praesent mattis, enim
									quis hendrerit porttitor, sapien tortor viverra magna, sit amet rhoncus nisl lacus nec arcu.
									Suspendisse laoreet metus ut metus imperdiet interdum aliquam justo tincidunt. Mauris dolor urna,
									fringilla vel malesuada ac, dignissim eu mi. Praesent mollis massa ac nulla pretium pretium.
									Maecenas tortor mauris, consectetur pellentesque dapibus eget, tincidunt vitae arcu.
									Vestibulum purus augue, tincidunt sit amet iaculis id, porta eu purus.</p>
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
