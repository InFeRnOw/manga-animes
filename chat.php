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
      $friend = $_GET['friend'];
      $chatRoomId = $_GET['chatroom'];
      $_SESSION['roomid'] = $_GET['chatroom'];
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

    <script>

    $('html, body').bind('scroll mousedown wheel DOMMouseScroll mousewheel keyup', function(e){
      if ( e.which > 0 || e.type == "mousedown" || e.type == "mousewheel"){
      $("#postBox").stop();
      }
      });

      $(function () {

        $('#chatForm').on('submit', function (e) {

          e.preventDefault();

              var friend = $("#chat-friend").val();
              var chatRoom = $("#chat-room").val();
              var chatText = $("#chat-text").val();
              var submit = $(".chat-submit").val();
              var dataString = friend + chatRoom + chatText;

          $.ajax({
            type: 'POST',
            url: 'INCLUDES/chatSend-inc.php',
            data: {friend: friend, chatroom: chatRoom, chatText: chatText, submit: submit},
            success: function () {
              $("#postBox").stop().animate({ scrollTop: $("#postBox")[0].scrollHeight}, 1000);
              $("#chat-text").val("");
              $('#postBox').load('INCLUDES/chatTextInsert-inc.php');
            }
          });

        });

      });
    </script>

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
								<div id="content">

									<!-- Content -->

										<article>
											<header>
                        <?php ?>
    									</header>

                      <script>
                          $(document).ready(function () {
                            $("#postBox").stop().animate({ scrollTop: $("#postBox")[0].scrollHeight}, 1000);
                              var timeout, clicker = $('#postBox');

                              clicker.mouseup(function(){
                                  timeout = setInterval(function(){
                                    $('#postBox').load('INCLUDES/chatTextInsert-inc.php');
                                    $("#postBox").stop().animate({ scrollTop: $("#postBox")[0].scrollHeight}, 1000);
                                  }, 1000);
                              });

                              clicker.mousedown(function(){
                                  clearInterval(timeout);
                              });

                          });

                      </script>
                                           <div id="postBox" style='border: 1px solid rgba(0,0,0,0.3); border-radius: 15px; box-shadow: 2px 2px 2px rgba(0,0,0,0.2); background: black; margin-top: 10px; padding-top: 20px; height: 500px; overflow-y: auto; overflow-x: none;'>
                                              <?php include 'INCLUDES/chatTextInsert-inc.php'?>
                                          </div>
                                        </br>
										</article>

						</div>
					</div>
          <form id="chatForm" action="INCLUDES/chatSend-inc.php" method="POST">
            <input id="chat-friend" type="hidden" name="friend" value="<?php echo $friend ?>">
            <input id="chat-room" type="hidden" name="chatroom" value="<?php echo $chatRoomId ?>">
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <input id="chat-text" type="text" name="chatText" maxlength="250" placeholder="Message..."/>
              </div>
              <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <button class="button chat-submit" type="submit" name="submit" style="width: 100%;">Send</button>
              </div>
              <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
            </div>
          </div>
        </form>
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
