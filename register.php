<!DOCTYPE HTML>
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
            <h1>Sign up</h1>
            <div class="divider"></div>
            <img src="CSS/images/fullmetal-alchemy.jpg" alt="Fullmetal Alchemy"/>
          </section>

					<section id="content">

            <?php include 'INCLUDES/errors-inc.php'?>

            <?php if ($_GET['uid'] || $_GET['email']) {
                    $username = $_GET['uid'];
                    $userEmail = $_GET['email'];
                  }?>

            <form action="INCLUDES/register-inc.php" method="post">
  						<div class="container-fluid">
  							<div class="row">
  								<div class="col-xs-12">
                    <input type="text" name="uid" value="<?php echo $username ?>" maxlength="12" placeholder="Username"/>
  								</div>
                </div>
                <div class="row">
  								<div class="col-xs-12">
                    <input type="text" name="email" value="<?php echo $userEmail ?>" placeholder="Email"/>
  								</div>
                </div>
                <div class="row">
  								<div class="col-xs-12">
                    <input type="password" name="pass1" placeholder="Password"/>
  							  </div>
  							</div>
                <div class="row">
  								<div class="col-xs-12">
                    <input type="password" name="pass2" placeholder="Password confirm"/>
  							  </div>
  							</div>
                <div class="row">
                  <div id="rank" class="col-xs-12">
                    <button class="btn" type="submit" name="submit">Login</button>
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
