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
						<div class="container-fluid">
              <div class="divider-with-content"><h1>Friends panel</h1></div>

							<?php include 'INCLUDES/errors-inc.php'; ?>

							<div class="row">
								<div class="col-md-4 col-xs-12"></div>
								<div id="friend-add" class="col-md-4 col-xs-12">
								<div class="row">
									<form action="INCLUDES/friendRequest-inc.php" method="post">
										<div class="col-xs-9">
											<input type="text" name="friend" placeholder="Add a friend"/>
										</div>
										<div class="col-xs-3">
											<button class="btn btn-primary" type="submit" name="friendAdd"><i class="glyphicon glyphicon-plus"></i></button>
										</div>
									</form>
								</div>
							</div>
							<div class="col-md-4 col-xs-12"></div>
							</div>
						</div>
          </section>

					<section id="friend">
						<div class="container-fluid">
              <div class="row">
                <div class="col-md-4 col-xs-12">
                  <div class="divider"></div>
                  <h1>Chat rooms</h1>
                  <div class="divider"></div>

									<div class="friend-container">
                  	<?php include 'INCLUDES/chatRoomInsert-inc.php'; ?>
									</div>

                </div>
                <div class="col-md-4 col-xs-12">
                  <div class="divider"></div>
                  <h1>Friends</h1>
                  <div class="divider"></div>

									<div class="friend-container">
                  	<?php include 'INCLUDES/friendListInsert-inc.php'; ?>
									</div>

                </div>
                <div class="col-md-4 col-xs-12">
                  <div class="divider"></div>
                  <h1>Friend requests</h1>
                  <div class="divider"></div>

									<div class="friend-container">
                  	<?php include 'INCLUDES/friendRequestInsert-inc.php'; ?>
									</div>

                </div>
              </div>
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
