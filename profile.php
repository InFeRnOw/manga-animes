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

					<section id="profile">
						<div class="container-fluid">
							<div class="divider-with-content"><h1>Description</h1></div>
              <?php if ($description == '') {
												echo '<p>No description !</p>';
										}
										else {
												echo $description;
										}
							 ?>
							<div class="divider-with-content"><h1>Posted by <?php echo $user ?></h1></div>
							<div class="row">
								<?php include 'INCLUDES/profilePostsOwnedInsert-inc.php'; ?>
								<?php $sql = "SELECT * FROM posts WHERE p_active IN ('1', '0') AND p_user = '$user' ORDER BY p_id ASC";
											$result = mysqli_query($conn, $sql);
											if (mysqli_fetch_assoc($result) == 0) {
													echo '<p>Nothing posted !</p>';
											}

											$postedByLinkMore = "profile.php?link=".$id."&more";
											$postedByLinkHide = "profile.php?link=".$id."&hide";

											$sqlPosts = "SELECT * FROM posts WHERE p_user = '$user' AND p_active IN ('1', '0')";
											$resultPosts = mysqli_query($conn, $sqlPosts);
											$resultCheckPosts = mysqli_num_rows($resultPosts);

											if ($resultCheckPosts > 3) {
													if (!isset($_GET['more'])) {
															echo '<div class="col-xs-12"><u><a href="'.$postedByLinkMore.'" style="color: grey; text-decoration: none;">Show more</a></u></br></div>';
													}
													elseif (isset($_GET['more'])) {
															echo '<div class="col-xs-12"><u><a href="'.$postedByLinkHide.'" style="color: grey; text-decoration: none;">Show less</a></u></br></div>';
													}
											}
							   ?>
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
