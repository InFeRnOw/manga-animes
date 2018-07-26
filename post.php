<?php
session_start();
include_once 'INCLUDES/dbh-inc.php';
$link = $_GET['link'];
$sqlVisit = "UPDATE posts SET p_vues = p_vues + 1, p_vuesmostviewed = p_vuesmostviewed + 1 WHERE p_link='$link'";
$resultVisit = mysqli_query($conn, $sqlVisit);
$sqlCheck = "SELECT * FROM posts WHERE p_link='$link'";
$resultCheck = mysqli_query($conn, $sqlCheck);
$rowCheck = mysqli_fetch_assoc($resultCheck);
if ($rowCheck['p_seasoncenter'] > 0 && $rowCheck['p_episodescenter'] > 0) {
	$sqlVarPosts = "SELECT * FROM posts WHERE p_link = '$link'";
	$resultVarPosts = mysqli_query($conn, $sqlVarPosts);
	$rowVarPosts = mysqli_fetch_assoc($resultVarPosts);
	$title = $rowVarPosts['p_title'];
	$pUser = $rowVarPosts['p_user'];
	$content = $rowVarPosts['p_content'];
	$type = $rowVarPosts['p_type'];
	$genre = $rowVarPosts['p_genre'];
	$id = $_SESSION['u_id'];
	$active = $rowVarPosts['p_active'];
	$titleen = $rowVarPosts['p_titleen'];
	$genre = $rowVarPosts['p_genre'];
	$statusmanga = $rowVarPosts['p_statusmanga'];
	$status = $rowVarPosts['p_status'];
	$adaptation = $rowVarPosts['p_adaptation'];
	$season = $rowVarPosts['p_seasoncenter'];
	$episodes = $rowVarPosts['p_episodescenter'];
	$linkMyAnime = $rowVarPosts['p_linkmyanime'];
	$vues = $rowVarPosts['p_vues'];
}
else {
	$sqlVarPosts = "SELECT * FROM posts WHERE p_link = '$link'";
	$resultVarPosts = mysqli_query($conn, $sqlVarPosts);
	$rowVarPosts = mysqli_fetch_assoc($resultVarPosts);
	$title = $rowVarPosts['p_title'];
	$pUser = $rowVarPosts['p_user'];
	$content = $rowVarPosts['p_content'];
	$type = $rowVarPosts['p_type'];
	$genre = $rowVarPosts['p_genre'];
	$id = $_SESSION['u_id'];
	$active = $rowVarPosts['p_active'];
	$titleen = $rowVarPosts['p_titleen'];
	$genre = $rowVarPosts['p_genre'];
	$statusmanga = $rowVarPosts['p_statusmanga'];
	$status = $rowVarPosts['p_status'];
	$adaptation = $rowVarPosts['p_adaptation'];
	$season = $rowVarPosts['p_season'];
	$episodes = $rowVarPosts['p_episodes'];
	$linkMyAnime = $rowVarPosts['p_linkmyanime'];
	$vues = $rowVarPosts['p_vues'];
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
		<title><?php echo $title ?></title>
  		<meta charset="utf-8" />
  		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
			<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
		<link rel="stylesheet" href="CSS/main.css">
	</head>
  <script>
  $(document).ready(function() {
   $('.selectpicker').selectpicker();
   $('#show-panel').hide();
   $('#hide-panel').click(function(){
	  $('.divider-with-content').hide();
	  $('#show-panel').show();
   });
   $('#show-panel').click(function(){
	  $('.divider-with-content').show();
	  $('#show-panel').hide();
   });
  });
  </script>
	<body>
    <div class="container-fluid">
			<!-- Header -->
				<div id="header">

					<?php include 'INCLUDES/html-inc/htmlHeaderMain-inc.php' ?>

          <div class="divider-nav"></div>

				</div>

        <div id="page">
          <section id="header">
            <h2><?php echo $title ?></h2>
            <h3><?php echo $titleen ?></h3>
            <p><b><?php echo $genre ?></b></p>
          </br>
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-6 col-xs-12">
                  <div class="row">
                    <div class="col-md-4 col-xs-12"><p><?php echo "<em><u>Type</u></em></br> ".$type;  ?></p></div>
                    <div class="col-md-4 col-xs-12"><p><?php echo "<em><u>Status Manga</u></em></br> ".$statusmanga;  ?></p></div>
                    <div class="col-md-4 col-xs-12"><p><?php echo "<em><u>Status Anime</u></em></br> ".$status;  ?></p></div>
                  </div>
                </div>
                <div class="col-md-6 col-xs-12">
                  <div class="row">
                    <div class="col-md-4 col-xs-12"><p><?php echo "<em><u>Adaptation</u></em></br> ".$adaptation;  ?></p></div>
                    <div class="col-md-4 col-xs-12"><p><?php echo "<em><u>Season</u></em></br> ".$season;  ?></p></div>
                    <div class="col-md-4 col-xs-12"><p><?php echo "<em><u>Episodes</u></em></br> ".$episodes;  ?></p></div>
                  </div>
                </div>
              </div>
            </div>

            <?php echo '<img class="img-responsive center-block" src="uploads/postsimages/postimg'.$link.'.jpg?'.filemtime('uploads/postsimages/postimg'.$link.'.jpg').'">' ?>
            <div class="row">
							</br>
							<div class="col-xs-6">
								<p>
									<?php echo "<em><u>Author of post</u></em></br>".$pUser;?>
								</p>
							</div>
							<div class="col-xs-6">
								<p>
									<?php echo "<em><u>Number of visits</u></em></br>".$vues;?>
								</p>
							</div>
							</br>
                <div class="col-xs-12">
									<p><?php if ($linkMyAnime !== '') {
															echo "<em><u>MyAnimeList Link</u></em></br>".$linkMyAnime;
													 }?>
									</p>
								</div>
            	</br>
            </div>

          </br>

            <?php include 'INCLUDES/errors-inc.php' ?>

			<button id="show-panel" class="btn">Show panel</button>
            <?php include 'INCLUDES/panelFonctions-inc.php' ?>

          </section>

					<section id="post">
						<div class="container-fluid">
              				<?php echo $content  ?>
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
