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
    $imgCreditsName = $rowVarPosts['p_imgcreditsname'];
    $imgCreditsLink = $rowVarPosts['p_imgcreditslink'];
    $path = $rowVarPosts['p_img_src'];
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
	$studio = $rowVarPosts['p_studio'];
	$status = $rowVarPosts['p_status'];
	$adaptation = $rowVarPosts['p_adaptation'];
	$season = $rowVarPosts['p_season'];
	$episodes = $rowVarPosts['p_episodes'];
	$linkMyAnime = $rowVarPosts['p_linkmyanime'];
	$vues = $rowVarPosts['p_vues'];
    $imgCreditsName = $rowVarPosts['p_imgcreditsname'];
    $imgCreditsLink = $rowVarPosts['p_imgcreditslink'];
    $path = $rowVarPosts['p_img_src'];
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
	  $('.panel').hide();
	  $('#show-panel').show();
   });
   $('#show-panel').click(function(){
	  $('.panel').show();
	  $('#show-panel').hide();
   });

	 function scrollToHash(hashName) {
   		location.hash = "#" + hashName;
	 }

	 <?php if (isset($_GET['comment']) || isset($_GET['more']) || isset($_GET['hide'])) {
	 					echo 'scrollToHash("commentSection");';
	 			 }
		?>
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
            <h2><u><?php echo $title ?></u></h2>
            <h3><u><?php echo $titleen ?></u></h3>
            <p><b><?php echo $genre ?></b></p>
          </br>
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-6 col-xs-12">
                  <div class="row">
                    <div class="col-md-4 col-xs-12"><p><?php echo "<em><u>Type</u></em></br> ".$type;  ?></p></div>
                    <div class="col-md-4 col-xs-12"><p><?php if ($active == 2) {echo "<em><u>Manga Status</u></em></br> ".$statusmanga;}else {echo "<em><u>Studio</u></em></br> ".$studio;} ?></p></div>
                    <div class="col-md-4 col-xs-12"><p><?php if ($active == 2) {echo "<em><u>Anime Status</u></em></br> ".$status;}else {echo "<em><u>Season Status</u></em></br> ".$status;} ?></p></div>
                  </div>
                </div>
                <div class="col-md-6 col-xs-12">
                  <div class="row">
                    <div class="col-md-4 col-xs-12"><p><?php echo "<em><u>Adaptation</u></em></br> ".$adaptation;  ?></p></div>
                    <div class="col-md-4 col-xs-12"><p><?php if ($active == 2) {echo "<em><u>Anime seasons</u></em></br> ".$season;}else {echo "<em><u>Season</u></em></br> ".$season;} ?></p></div>
                    <div class="col-md-4 col-xs-12"><p><?php if ($active == 2) {echo "<em><u>Anime episodes</u></em></br> ".$episodes;}else {echo "<em><u>Episodes</u></em></br> ".$episodes;} ?></p></div>
                  </div>
                </div>
              </div>
            </div>

            <?php echo '<img class="img-responsive center-block" src="uploads/postsimages/postimg'.$path.'.jpg?'.filemtime('uploads/postsimages/postimg'.$path.'.jpg').'">' ?>
            
            <div class="row">
                </br>
                <div class="col-xs-6"><p><?php echo "<em><u>Creator of the banner</u></em></br> ".$imgCreditsName;  ?></p></div>
                <div class="col-xs-6"> 
                    <p style="word-break: break-all;"><?php if ($imgCreditsLink !== '') {
                                   echo "<em><u>Artist's works page</u></em></br><a href='".$imgCreditsLink."' style='text-decoration: none; background: white; color: grey; box-shadow: none;'>".$imgCreditsLink."</a>";
													 }
											?>
									</p>
				</div>
                </br>
        
            <div class="row">
							</br>
							<div class="col-xs-6">
								<p>
									<?php $sqlGetUserId = "SELECT * FROM users WHERE user_uid = '$pUser'";
												$resultGetUserId = mysqli_query($conn, $sqlGetUserId);
												$rowGetUserId = mysqli_fetch_assoc($resultGetUserId);
												$userId = $rowGetUserId['user_id'];
									 ?>
									<?php echo "<em><u>Author of post</u></em></br><a href='profile.php?link=".$userId."' style='text-decoration: none; background: white; color: grey; box-shadow: none;'>".$pUser."</a>";?>
								</p>
							</div>
							<div class="col-xs-6">
								<p>
									<?php echo "<em><u>Number of visits</u></em></br>".$vues;?>
								</p>
							</div>
							</br>
                <div class="col-xs-12">
									<p style="word-break: break-all;"><?php if ($linkMyAnime !== '') {
															echo "<em><u>MyAnimeList Link</u></em></br><a href='".$linkMyAnime."' style='text-decoration: none; background: white; color: grey; box-shadow: none;'>".$linkMyAnime."</a>";
													 }
											?>
									</p>
								</div>
            	</br>
            </div>

          </br>

            <?php include 'INCLUDES/errors-inc.php' ?>

			<button id="show-panel" class="btn" style="margin-bottom: 10px">Show panel</button>
            <?php include 'INCLUDES/panelFonctions-inc.php' ?>

          </section>

					<section id="post">
						<div class="container-fluid">
              	<?php echo $content  ?>
						</div>
						<div id="commentSection" class="divider-with-content">
							<h1>Comments</h1>
							<?php include 'INCLUDES/errors-inc.php'; ?>
						</div>
							<?php include 'INCLUDES/postCommentsInsert-inc.php';

										$CommentLinkPageMore = "post.php?link=".$link."&more";
										$CommentLinkPageHide = "post.php?link=".$link."&hide";

										$sqlComments = "SELECT * FROM postcomments WHERE post_comment_link = '$link'";
										$resultComments = mysqli_query($conn, $sqlComments);
										$resultCheckComments = mysqli_num_rows($resultComments);

										if ($resultCheckComments > 3) {
												if (!isset($_GET['more'])) {
														echo '<u><a href="'.$CommentLinkPageMore.'" style="color: grey; text-decoration: none;">See more comments</a></u></br>';
												}
												elseif (isset($_GET['more'])) {
														echo '<u><a href="'.$CommentLinkPageHide.'" style="color: grey; text-decoration: none;">Show less comments</a></u></br>';
												}
										}
							 ?>
							<?php if (isset($_SESSION['u_id'])) {
												echo '</br>
															<form action="INCLUDES/postComments-inc.php" method="POST">
																<input type="hidden" name="postLink" value="'.$link.'">
																<div class="row">
																	<div class="col-sm-1 col-xs-12"></div>
															    <div class="col-sm-8 col-xs-12" style="margin-bottom: 10px;">
																		<input type="text" name="comment" maxlength="256" placeholder="Comment this post..." style="width: 100%;"/>
																	</div>
																	<div class="col-sm-2 col-xs-12" style="margin-bottom: 10px;">
																		<button class="btn btn-classic" type="submit" name="submit" style="width: 100%;">Comment</button>
																  </div>
																	<div class="col-sm-1 col-xs-12"></div>
																</div>
															</form>';
										}
										else {
												echo '</br><p style="color: red;">Login, in order to comment on this post !</p>';
										} ?>
					</section>
				</div>

			<!-- Footer -->
				<div id="footer">

          <?php include 'INCLUDES/html-inc/htmlFooterMain-inc.php' ?>

				</div>
      </div>
	</body>
</html>
