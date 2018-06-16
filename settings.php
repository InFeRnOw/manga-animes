<?php
session_start();
include_once 'INCLUDES/dbh-inc.php';

if (!isset($_SESSION['u_id'])) {
    header("Location: ../login.php");
}
else {
    $id = $_SESSION['u_id'];

    $sql = "SELECT * FROM profiles WHERE pf_link='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $user = $row['pf_user'];
    $description = $row['pf_description'];
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
    <link rel="stylesheet" href="CSS/main.css">
    <script>
    $(document).ready(function() {
     $('.selectpicker').selectpicker();
     $('#summernote').summernote();
    });
    </script>
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
              <?php include 'INCLUDES/profilePictureEditInsert-inc.php' ?>
						</div>
          </section>

					<section id="description">
						<div class="container-fluid">
              <div class="row">

                <div class="divider-with-content"><h1>Description</h1></div>

                <form action="INCLUDES/profileEdit-inc.php" method="post">
                  <div class="col-xs-12">
                    <textarea id="summernote" name="content"><?php echo $description ?></textarea>
                  </div>
                  <div class="col-xs-12">
                    <button class="btn btn-success" type="submit" name="submit">Save</button>
                  </div>
                </form>
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
