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
$studio = $_GET['studio'];
$adaptation = $_GET['adaptation'];
$type = $_GET['type'];
$linkMyAnime = $_GET['linkMyAnime'];
$genre = $_GET['genre'];
$imgLink = $row['p_img_src'];

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
else if(!isset($_GET['edit']) || isset($_GET['upload']) && !isset($_GET['edit'])) {
    $action = "INCLUDES/postMaker-inc.php";
    $name = "New post";
    $content = $_SESSION['contentTemp'];
}
else if($_GET['edit'] == 'blank' || isset($_GET['upload'])) {
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
      <?php if (!isset($_GET['edit'])) { echo '<script src="JS/editorTable.js"></script>'; }?>
		<link rel="stylesheet" href="CSS/main.css">
    <script>
    $(document).ready(function() {
         $('.selectpicker').selectpicker();
         $('#summernote').summernote();

         function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#imgPreview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInput").change(function(){
            readURL(this);
        });
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
                    <input type="text" name="studio" value="<?php echo $studio ?>" placeholder="Studio"/>
                  </div>
                  <div class="col-lg-4 col-md-4 col-xs-12 marginForm">
                    <select class="selectpicker" multiple="multiple" title="Genre" name="genre[]">
                      <?php

                      ?>
                      <option <?php if (strpos($genre, "Action") !== false) { echo "selected"; } ?> value="Action">Action</option>
                      <option <?php if (strpos($genre, "Adventure") !== false) { echo "selected"; } ?> value="Adventure">Adventure</option>
                      <option <?php if (strpos($genre, "Comedy") !== false) { echo "selected"; } ?> value="Comedy">Comedy</option>
                      <option <?php if (strpos($genre, "Drama") !== false) { echo "selected"; } ?> value="Drama">Drama</option>
                      <option <?php if (strpos($genre, "Slice of Life") !== false) { echo "selected"; } ?> value="Slice of Life">Slice of Life</option>
                      <option <?php if (strpos($genre, "Fantasy") !== false) { echo "selected"; } ?> value="Fantasy">Fantasy</option>
                      <option <?php if (strpos($genre, "Magic") !== false) { echo "selected"; } ?> value="Magic">Magic</option>
                      <option <?php if (strpos($genre, "Supernatural") !== false) { echo "selected"; } ?> value="Supernatural">Supernatural</option>
                      <option <?php if (strpos($genre, "Horror") !== false) { echo "selected"; } ?> value="Horror">Horror</option>
                      <option <?php if (strpos($genre, "Mystery") !== false) { echo "selected"; } ?> value="Mystery">Mystery</option>
                      <option <?php if (strpos($genre, "Psychological") !== false) { echo "selected"; } ?> value="Psychological">Psychological</option>
                      <option <?php if (strpos($genre, "Romance") !== false) { echo "selected"; } ?> value="Romance">Sci-fi</option>
                      <option <?php if (strpos($genre, "Cyberpunk") !== false) { echo "selected"; } ?> value="Cyberpunk">Cyberpunk</option>
                      <option <?php if (strpos($genre, "Game") !== false) { echo "selected"; } ?> value="Game">Game</option>
                      <option <?php if (strpos($genre, "Ecchi") !== false) { echo "selected"; } ?> value="Ecchi">Ecchi</option>
                      <option <?php if (strpos($genre, "Demons") !== false) { echo "selected"; } ?> value="Demons">Demons</option>
                      <option <?php if (strpos($genre, "Martial Arts") !== false) { echo "selected"; } ?> value="Martial Arts">Martial Arts</option>
                      <option <?php if (strpos($genre, "Historical") !== false) { echo "selected"; } ?> value="Historical">Historical</option>
                      <option <?php if (strpos($genre, "nentai") !== false) { echo "selected"; } ?> value="Hentai">Hentai</option>
                      <option <?php if (strpos($genre, "Isekai") !== false) { echo "selected"; } ?> value="Isekai">Isekai</option>
                      <option <?php if (strpos($genre, "Military") !== false) { echo "selected"; } ?> value="Military">Military</option>
                      <option <?php if (strpos($genre, "Mecha") !== false) { echo "selected"; } ?> value="Mecha">Mecha</option>
                      <option <?php if (strpos($genre, "Music") !== false) { echo "selected"; } ?> value="Music">Music</option>
                      <option <?php if (strpos($genre, "Parody") !== false) { echo "selected"; } ?> value="Parody">Parody</option>
                      <option <?php if (strpos($genre, "Police") !== false) { echo "selected"; } ?> value="Police">Police</option>
                      <option <?php if (strpos($genre, "Post-Apocalyptic") !== false) { echo "selected"; } ?> value="Post-Apocalyptic">Post-Apocalyptic</option>
                      <option <?php if (strpos($genre, "Reverse Harem") !== false) { echo "selected"; } ?> value="Reverse Harem">Reverse Harem</option>
                      <option <?php if (strpos($genre, "School") !== false) { echo "selected"; } ?> value="School">School</option>
                      <option <?php if (strpos($genre, "Shōnen-ai") !== false) { echo "selected"; } ?> value="Shōnen-ai">Shōnen-ai</option>
                      <option <?php if (strpos($genre, "Shōjo-ai") !== false) { echo "selected"; } ?> value="Shōjo-ai">Shōjo-ai</option>
                      <option <?php if (strpos($genre, "Space") !== false) { echo "selected"; } ?> value="Space">Space</option>
                      <option <?php if (strpos($genre, "Sports") !== false) { echo "selected"; } ?> value="Sports">Sports</option>
                      <option <?php if (strpos($genre, "Super Power") !== false) { echo "selected"; } ?> value="Super Power">Super Power</option>
                      <option <?php if (strpos($genre, "Tragedy") !== false) { echo "selected"; } ?> value="Tragedy">Tragedy</option>
                      <option <?php if (strpos($genre, "Vampire") !== false) { echo "selected"; } ?> value="Vampire">Vampire</option>
                      <option <?php if (strpos($genre, "Yuri") !== false) { echo "selected"; } ?> value="Yuri">Yuri</option>
                      <option <?php if (strpos($genre, "Yaoi") !== false) { echo "selected"; } ?> value="Yaoi">Yaoi</option>
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
                       <input type="number" name="season" value="<?php echo $season ?>" placeholder="Anime season">
                    </div>
                    <div class="col-lg-4 col-md-4 col-xs-12 marginForm">
                      <input id="episodes" type="number" name="episodes" value="<?php echo $episodes ?>" placeholder="Number of episodes">
                    </div>

                  </div>
                    <div class="row">
                    <div class="col-xs-12">
                      <h3><u>Banner</u></h3>
                      <h4 style="color: grey;"><u>Actual image</u></h4>
                      <?php if (!empty($imgLink)) {
                                echo '<img id="imgPreview" class="img-responsive center-block" src="uploads/postsimages/postimg'.$link.'.jpg?'.filemtime('uploads/postsimages/postimg'.$link.'.jpg').'">';
                            }
                            else {
                                echo '<img id="imgPreview" class="img-responsive center-block" src="#" alt="image preview">';
                            }
                       ?>
                      </br>
                      <input type="hidden" name="imgKeep" value="<?php echo $imgLink ?>" />
                      <input id="imgInput" class="btn btn-basic center-block" type="file" name="banner"/>
                      <p style="font-size:12px;">Optimal Résolution: 720x250</p>
                      <p style="font-size:12px;">Only jpg is supported and max 10MB</p>
                    </div>
                    <?php if (!isset($_GET['edit'])) {
                              echo '<div class="col-lg-6 col-md-6 col-xs-12 marginForm">
                                       <input type="text" name="linkMyAnime" value="' .$linkMyAnime. '" placeholder="MyAnimeList Link">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-xs-12 marginForm">
                                      <select id="adaptSelector" class="selectpicker" title="Adaptation From ..." name="adaptEditor">
                                         <option value="LightNovel">Adapted from light novel</option>
                                         <option value="Manga">Adapted from manga</option>
                                      </select>
                                    </div>';
                          }
                          else {
                              echo '<div class="col-xs-12 marginForm">
                                       <input type="text" name="linkMyAnime" value="' .$linkMyAnime. '" placeholder="MyAnimeList Link">
                                    </div>';
                          }?>
                  </div>
                      <h3><u>Description</u></h3>
                      <textarea id="summernote" name="content">
                        <?php if (isset($_GET['edit']) || $_GET['posting'] == "blank" || isset($_GET['upload'])) {
                                  $firstFix = stripslashes($content);
                                  $SecondFix = str_replace("rn","",$firstFix);
                                  echo $SecondFix;
                      				}
                                else {
        								echo '<table class="table table-bordered">
                                <tbody>
                                  <tr id="firstRow">
                                    <td>
                                      <h3><b style="background-color: rgb(255, 255, 255);">Anime Episodes</b></h3>
                                    </td>
                                    <td>
                                    <h3><b style="background-color: rgb(255, 255, 255);">Manga chapters</b></h3>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>';
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
