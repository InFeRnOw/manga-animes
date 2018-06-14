<?php
		session_start();
		include 'INCLUDES/dbh-inc.php';

    if (!isset($_SESSION['u_id'])) {
    echo '<script>
            window.location.href="login.php";
        </script>';
    }
    else {
      $id = $_GET['link'];

      $sql = "SELECT * FROM profiles WHERE pf_link='$id'";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      $user = $row['pf_user'];
      $description = $row['pf_description'];

      $currentUser = $_SESSION['u_uid'];

      $sql = "SELECT * FROM chatrooms WHERE chat_to='$user' AND chat_from='$currentUser' OR chat_to='$currentUser' AND chat_from='$user'";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      $chatRoomId = $row['chat_id'];
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
		<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
			<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
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
						<div class="container-fluid">
	            <h2><?php echo $user ?></h2>
              <?php include 'INCLUDES/profilePictureInsert-inc.php' ?>
						</div>
          </section>

					<section id="content">
						<div class="container-fluid">
							<div class="divider-with-content"><h1>Description</h1></div>
              <?php echo $description ?>
						</div>
					</section>
				</div>

			<!-- Footer -->
				<div id="footer">

          <?php include 'INCLUDES/html-inc/htmlFooterMain-inc.php' ?>

				</div>
			</div>
	</body>
</html>
