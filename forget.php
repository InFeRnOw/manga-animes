<?php
session_start();
include 'INCLUDES/dbh-inc.php';
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
            <h1>Forget</h1>
            <div class="divider"></div>
            <?php include 'INCLUDES/loginRegisterForget_Carousel-inc.php'; ?>
          </section>

					<section id="content">

            <?php include 'INCLUDES/errors-inc.php'?>

            <form action='INCLUDES/forget-inc.php' method='POST'>
      				<div class='container-fluid'>
      				   <div class='row'>
      				      <div class='col-xs-12'>
                      <input class='email' type='text' name='email' placeholder='email'>
                    </div>
                    <div class="col-xs-12">
      					      <button class='btn' type='submit' name='submit'>Submit</button>
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
