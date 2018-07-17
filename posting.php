<?php
session_start();
include_once 'INCLUDES/dbh-inc.php';
$link = $_GET['link'];
$sql = "SELECT * FROM posts WHERE p_link = '$link'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$title = $_GET['title'];
$titleEn = $_GET['titleEn'];
$season = $_GET['season'];
$episodes = $_GET['episodes'];
$status = $_GET['status'];
$statusManga = $_GET['statusm'];
$adaptation = $_GET['adaptation'];
$type = $_GET['type'];
$linkMyAnime = $_GET['linkMyAnime'];

switch ($status) {
    case 'In progress':
        $one = 'selected';
        break;
    case 'On break':
        $two = 'selected';
        break;
    case 'Ended':
        $three = 'selected';
        break;
}
switch ($statusManga) {
    case 'In progress':
        $four = 'selected';
        break;
    case 'On break':
        $five = 'selected';
        break;
    case 'Ended':
        $six = 'selected';
        break;
}
switch ($adaptation) {
    case 'Full adaptation':
        $seven = 'selected';
        break;
    case 'Half adaptation':
        $eight = 'selected';
        break;
    case 'Not adapted':
        $nine = 'selected';
        break;
}
switch ($type) {
    case 'Kodomo':
        $ten = 'selected';
        break;
    case 'Shōnen':
        $eleven = 'selected';
        break;
    case 'Shōjo':
        $twelve = 'selected';
        break;
    case 'Seinen':
        $thirteen = 'selected';
        break;
    case 'Josei':
        $fourteen = 'selected';
        break;
    case 'Seijin':
        $fifteen = 'selected';
        break;
}
if (!isset($_SESSION['u_id'])) {
    header("Location: ../login.php");
}
else if(!isset($_GET['edit'])) {
    $action = "INCLUDES/postMaker-inc.php";
    $name = "New post";
    $content = $_SESSION['contentTemp'];
}
else if($_GET['edit'] == 'blank') {
    $content = $_SESSION['contentTemp'];
    $action = "INCLUDES/postEdit-inc.php";
    $name = "Edit post";
    $_SESSION['linkTemp'] = $link;
}
else {
    $action = "INCLUDES/postEdit-inc.php";
    $name = "Edit post";
    $content = $row['p_content'];
    $_SESSION['linkTemp'] = $link;
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
            <h2><?php echo $name ?></h2>
          </section>

          <?php include 'INCLUDES/errors-inc.php'?>
					<section id="post">
						<div class="container-fluid">
              <form action="<?php echo $action ?>" method="POST" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-lg-4 col-md-4 col-xs-12 marginForm">
                    <input type="text" name="title" value="<?php echo $title ?>" placeholder="Japanese Title">
                  </div>
                  <div class="col-lg-4 col-md-4 col-xs-12 marginForm">
                    <select class="selectpicker" title="Anime status" name="status">
                      <option <?php echo $one ?> value="In progress">In progress</option>
                      <option <?php echo $two ?> value="On break">On break</option>
                      <option <?php echo $three ?> value="Ended">Ended</option>
                    </select>
                 </div>
                 <div class="col-lg-4 col-md-4 col-xs-12 marginForm">
                  <select class="selectpicker" title="Type" name="type">
                    <option <?php echo $ten ?> value="Kodomo">Kodomo</option>
                    <option <?php echo $eleven ?> value="Shōnen">Shōnen</option>
                    <option <?php echo $twelve ?> value="Shōjo">Shōjo</option>
                    <option <?php echo $thirteen ?> value="Seinen">Seinen</option>
                    <option <?php echo $fourteen ?> value="Josei">Josei</option>
                    <option <?php echo $fifteen ?> value="Seijin">Seijin</option>
                  </select>
                 </div>
                </div>
                <div class="row">
                  <div class="col-lg-4 col-md-4 col-xs-12 marginForm">
                    <input type="text" name="titleEn" value="<?php echo $titleEn ?>" placeholder="English Title">
                  </div>
                  <div class="col-lg-4 col-md-4 col-xs-12 marginForm">
                    <select class="selectpicker" title="Manga status" name="statusManga">
                       <option <?php echo $four ?> value="In progress">In progress</option>
                       <option <?php echo $five ?> value="On break">On break</option>
                       <option <?php echo $six ?> value="Ended">Ended</option>
                    </select>
                  </div>
                  <div class="col-lg-4 col-md-4 col-xs-12 marginForm">
                    <select class="selectpicker" multiple="multiple" title="Genre" name="genre[]">
                       <option value="Action">Action</option>
                       <option value="Adventure">Adventure</option>
                       <option value="Comedy">Comedy</option>
                       <option value="Drama">Drama</option>
                       <option value="Slice of Life">Slice of Life</option>
                       <option value="Fantasy">Fantasy</option>
                       <option value="Magic">Magic</option>
                       <option value="Supernatural">Supernatural</option>
                       <option value="Horror">Horror</option>
                       <option value="Mystery">Mystery</option>
                       <option value="Psychological">Psychological</option>
                       <option value="Romance">Sci-fi</option>
                       <option value="Cyberpunk">Cyberpunk</option>
                       <option value="Game">Game</option>
                       <option value="Ecchi">Ecchi</option>
                       <option value="Demons">Demons</option>
                       <option value="Martial Arts">Martial Arts</option>
                       <option value="Historical">Historical</option>
                       <option value="Hentai">Hentai</option>
                       <option value="Isekai">Isekai</option>
                       <option value="Military">Military</option>
                       <option value="Mecha">Mecha</option>
                       <option value="Music">Music</option>
                       <option value="Parody">Parody</option>
                       <option value="Police">Police</option>
                       <option value="Post-Apocalyptic">Post-Apocalyptic</option>
                       <option value="Reverse Harem">Reverse Harem</option>
                       <option value="School">School</option>
                       <option value="Shōnen-ai">Shōnen-ai</option>
                       <option value="Shōjo-ai">Shōjo-ai</option>
                       <option value="Space">Space</option>
                       <option value="Sports">Sports</option>
                       <option value="Super Power">Super Power</option>
                       <option value="Tragedy">Tragedy</option>
                       <option value="Vampire">Vampire</option>
                       <option value="Yuri">Yuri</option>
                       <option value="Yaoi">Yaoi</option>
                     </select>
                   </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 col-xs-12 marginForm">
                      <select class="selectpicker" title="Adaptation" name="adaptation">
                         <option <?php echo $seven ?> value="Full adaptation">Full adaptation from manga</option>
                         <option <?php echo $eight ?> value="Half adaptation">Half manga adaptation/Half changed scenario</option>
                         <option <?php echo $nine ?> value="Not adapted">Not adapted</option>
                      </select>
                    </div>
                    <div class="col-lg-4 col-md-4 col-xs-12 marginForm">
                       <input type="text" name="season" value="<?php echo $season ?>" placeholder="Anime season">
                    </div>
                    <div class="col-lg-4 col-md-4 col-xs-12 marginForm">
                      <input type="text" name="episodes" value="<?php echo $episodes ?>" placeholder="Number of episodes">
                    </div>

                  </div>
                  <div class="row">
                    <div class="col-xs-12">
                      <h4><u>Banner</u></h4>
                      <input class="btn btn-basic center-block" type="file" name="banner"/>
                      <p style="font-size:12px;">Optimal Résolution: 720x250</p>
                      <p style="font-size:12px;">Only jpg is supported and max 10MB</p>

                      </br>
                    </div>
                   <div class="col-lg-4 col-md-4 col-xs-12 marginForm">
                       <input type="text" name="linkMyAnime" value="<?php echo $season ?>" placeholder="MyAnimeList Link">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-12">
                      <h4><u>Description</u></h4>
                      <textarea id="summernote" name="content">
                        <?php if (isset($_GET['edit'])) {
                      					echo $content;
                      				}
        											else {
        												echo '<table class="table table-bordered"><tbody><tr><td><h3><b style="background-color: rgb(255, 255, 255);">Anime Episodes</b></h3></td><td><h3><b style="background-color: rgb(255, 255, 255);">Manga chapters</b></h3></td></tr><tr><td><p style="text-align: center;">Episode 1...</p></td><td>Chapter 1...</td></tr><tr><td><p>Episode 2...</p></td><td>Chapter 2...</td></tr><tr><td>Etc...</td><td>Etc...</td></tr></tbody></table>';
        											}
  											?>
                      </textarea>
                    </div>
                  </div>
                    <button class="btn button-gray" type="submit" name="submit"><?php echo $name ?></button>
                  </form>
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
