<?php
session_start();
include 'INCLUDES/dbh-inc.php';

if ($_GET['logout']) {
	session_start(); //Start the current session
	session_unset();
	session_destroy(); //Destroy it! So we are logged out now
	header("Location: ../index.php?logout=success");
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
			<link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
			<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
		<link rel="stylesheet" href="CSS/main.css">
    <script> $(document).ready(function () { $("html").stop().animate({ scrollTop: $("html")[0].scrollHeight}, 1500); }); </script>
	</head>
	<body>
		<div class="container-fluid">
			<!-- Header -->
				<div id="header">

					<?php include 'INCLUDES/html-inc/htmlHeaderMain-inc.php' ?>

					<div class="divider-nav"></div>

				</div>

        <div id="page">
          <section id="header">
            <h1>Login</h1>
            <div class="divider"></div>
            <img src="CSS/images/charlotte.png" alt="Charlotte"/>
          </section>

					<section id="content">

            <?php
							$uid = $_GET['uid'];

							if (isset($_GET['register']) && $_GET['register'] == 'success') {
									echo '<form action="INCLUDES/register-inc.php" method="POST">
														<div class="col-xs-12">
															<input type="hidden" name="uid" value="'.$uid.'"/>
															<button class="btn" type="submit" name="emailResend" style="font-size: 12px; margin-bottom: 20px;">Email not received</button>
														</div>
												</form>';
							}
						 ?>
						 <?php include 'INCLUDES/errors-inc.php' ?>

            <form action='INCLUDES/login-inc.php' method='POST'>
  						<div class="container-fluid">
  							<div class="row">
  								<div class="col-xs-12">
                    <input type="text" name="uid" maxlength="12" placeholder="Username"/>
  								</div>
                </div>
                <div class="row">
  								<div class="col-xs-12">
                    <input type="password" name="pass" placeholder="Password"/>
  							  </div>
  							</div>
                <div class="row">
                  <div class="col-xs-12">
                    <button class="btn" type="submit" name="submit">Login</button>
									</br>
									</br>
										<p><a class="link" href="forget.php" style="color: grey">Forgot password ?</a></p>
										<p><a class="link" href="register.php" style="color: grey">Don't have an account ?</a></p>
                  </div>
                </div>
  						</div>
            </form>
					</section>
				</div>

			<!-- Footer -->
				<div id="footer">

          <?php include 'INCLUDES/html-inc/htmlFooterMain-inc.php' ?>

				</div>
			</div>
	</body>
</html>
