<?php
    session_start();
    include_once 'INCLUDES/dbh-inc.php';

    $link = $_GET['link'];
    $sql = "SELECT * FROM posts WHERE p_link = '$link'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $title = $row['p_title'];
    $pUser = $row['p_user'];
    $content = $row['p_content'];
    $type = $row['p_type'];
    $genre = $row['p_genre'];
    $id = $_SESSION['u_id'];
    $active = $row['p_active'];
    $titleen = $row['p_titleen'];
    $genre = $row['p_genre'];
    $statusmanga = $row['p_statusmanga'];
    $status = $row['p_status'];
    $adaptation = $row['p_adaptation'];
    $season = $row['p_season'];
    $episodes = $row['p_episodes'];
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

          </br>

            <?php include 'INCLUDES/errors-inc.php' ?>

            <?php if ($active == 0) {
                    $sql = "SELECT * FROM users WHERE user_id='$id'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    if($row['rank'] <= 2 && isset($_SESSION['u_id'])) {
                      $_SESSION['link'] = $link;
                      echo "<div class='divider-with-content'>
                              <h2>Staff panel</h2>
                              <form id=voteForm action='INCLUDES/vote-inc.php' method='POST'>
                              <div class='container-fluid'>
                                <div class='row'>
                                  <div class='col-xs-4'>
                                    <button class='btn btn-success' type='submit' name='accept'>Accept</button>
                                  </div>
                                  <div class='col-xs-4'>
                                    <button class='btn btn-secondairy' type='submit' name='edit'>Edit</button>
                                  </div>
                                  <div class='col-xs-4'>
                                    <button class='btn btn-danger' type='submit' name='deny'>Deny</button>
                                  </div>
                                </div>
                                </br>
                                <div class='row'>
                                  <div class='col-xs-6'>
                                    <button class='btn btn-primary' type='submit' name='like'><i class='glyphicon glyphicon-thumbs-up'></i></button>
                                  </div>
                                  <div class='col-xs-6'>
                                    <button class='btn btn-danger' type='submit' name='dislike'><i class='glyphicon glyphicon-thumbs-down'></i></button>
                                  </div>
                                </div>
                              </div>
                              </form>
                            </div>";
                    }
                    else if($row['rank'] == 3 && isset($_SESSION['u_id'])) {
                      $_SESSION['link'] = $link;
                      if($_SESSION['u_uid'] == $pUser) {
                        echo "<div class='divider-with-content'>
                                <h2>Author panel</h2>
                                <form id=voteForm action='INCLUDES/vote-inc.php' method='POST'>
                                <div class='container-fluid'>
                                  <div class='row'>
                                    <div class='col-lg-3 col-xs-6'>
                                      <button class='btn btn-secondairy' type='submit' name='edit'>Edit</button>
                                    </div>
                                    <div class='col-lg-3 col-xs-6'>
                                      <button class='btn btn-danger' type='submit' name='deny'>Delete</button>
                                    </div>
                                    </br>
                                    <div class='col-lg-3 col-xs-6'>
                                      <button class='btn btn-primary' type='submit' name='like'><i class='glyphicon glyphicon-thumbs-up'></i></button>
                                    </div>
                                    <div class='col-lg-3 col-xs-6'>
                                      <button class='btn btn-danger' type='submit' name='dislike'><i class='glyphicon glyphicon-thumbs-down'></i></button>
                                    </div>
                                  </div>
                                </div>
                                </form>
                              </div>";
                      }
                      else {
                        echo "<div class='divider-with-content'>
                                <h2>Vote panel</h2>
                                <form id=voteForm action='INCLUDES/vote-inc.php' method='POST'>
                                <div class='container-fluid'>
                                  <div class='row'>
                                    <div class='col-xs-6'>
                                      <button class='btn btn-primary' type='submit' name='like'><i class='glyphicon glyphicon-thumbs-up'></i></button>
                                    </div>
                                    <div class='col-xs-6'>
                                      <button class='btn btn-danger' type='submit' name='dislike'><i class='glyphicon glyphicon-thumbs-down'></i></button>
                                    </div>
                                  </div>
                                </div>
                              </form>
                            </div>";
                      }
                    }
                    else {
                      echo "<div class='divider-with-content'>
                              <p style='color: red;'>You need to login or register in order to vote on this post !</p>
                            </div>";
                    }
                  }?>

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
