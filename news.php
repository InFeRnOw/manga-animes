<?php
session_start();
include 'INCLUDES/dbh-inc.php';
$sql = "SELECT * FROM news WHERE n_id = 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$content = $row['n_content'];
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
	// last request was more than 30 minutes ago
	session_unset();     // unset $_SESSION variable for the run-time
	session_destroy();   // destroy session data in storage
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

if (!isset($_SESSION['CREATED'])) {
    $_SESSION['CREATED'] = time();
} else if (time() - $_SESSION['CREATED'] > 1800) {
    // session started more than 30 minutes ago
    session_regenerate_id(true);    // change session ID for the current session and invalidate old session ID
    $_SESSION['CREATED'] = time();  // update creation time
}
?>
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
		<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
			<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
		<link rel="stylesheet" href="CSS/main.css">
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
            <!-- Pour plus tard -->
          </section>

					<section id="news">

            <div class="divider-with-content"><h1>Most recent posts</h1></div>

            <div id="news-carousel" class="carousel slide" data-ride="carousel">

              <ol class="carousel-indicators">
                <li data-target="#news-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#news-carousel" data-slide-to="1"></li>
                <li data-target="#news-carousel" data-slide-to="2"></li>
								<li data-target="#news-carousel" data-slide-to="3"></li>
								<li data-target="#news-carousel" data-slide-to="4"></li>
              </ol>

              <div class="carousel-inner">

								<?php include 'INCLUDES/newsInsertSlider-inc.php' ?>

              </div>

              <a class="left carousel-control" href="#news-carousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#news-carousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>

						<?php if (isset($_SESSION['u_id'])) {
								  $id = $_SESSION['u_id'];
			                      $sql = "SELECT * FROM users WHERE user_id='$id'";
			                      $result = mysqli_query($conn, $sql);
			                      $row = mysqli_fetch_assoc($result);
			                      if($row['rank'] <= 2 && isset($_SESSION['u_id'])) {
				                      $_SESSION['link'] = $link;
				                      echo "<div class='divider-with-content'>
				                              <h1>News from admins</h1>
											  <button class='btn btn-basic' type='button'><a class='link' href='NewsPost.php'>Edit</a></button>
				                            </div>";
			                      }
								  else {
									  echo "<div class='divider-with-content'><h1>News from admins</h1></div>";
								  }

							  }
							  else {
								  echo "<div class='divider-with-content'><h1>News from admins</h1></div>";
							  }?>

              <?php echo $content ?>

					</section>
        </div>

			<!-- Footer -->
				<div id="footer">

          <?php include 'INCLUDES/html-inc/htmlFooterMain-inc.php' ?>

				</div>
			</div>
	</body>
</html>
