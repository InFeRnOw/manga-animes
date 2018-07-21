<?php
session_start();
include_once 'INCLUDES/dbh-inc.php';
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
switch ($_GET['lang']) {
    case 'jap':
        $one = 'selected';
        break;
    case 'en':
        $two = 'selected';
        break;
}
switch ($_GET['letter']) {
    case 'A':
        $A = 'selected';
        break;
    case 'B':
        $B = 'selected';
        break;
		case 'C':
				$C = 'selected';
				break;
		case 'D':
				$D = 'selected';
				break;
		case 'E':
        $E = 'selected';
        break;
    case 'F':
        $F = 'selected';
        break;
		case 'G':
				$G = 'selected';
				break;
		case 'H':
				$H = 'selected';
				break;
		case 'I':
        $I = 'selected';
        break;
    case 'J':
        $J = 'selected';
        break;
		case 'K':
				$K = 'selected';
				break;
		case 'L':
				$L = 'selected';
				break;
		case 'M':
        $M = 'selected';
        break;
    case 'N':
        $N = 'selected';
        break;
		case 'O':
				$O = 'selected';
				break;
		case 'P':
				$P = 'selected';
				break;
		case 'Q':
        $Q = 'selected';
        break;
    case 'R':
        $R = 'selected';
        break;
		case 'S':
				$S = 'selected';
				break;
		case 'T':
				$T = 'selected';
				break;
		case 'U':
        $U = 'selected';
        break;
    case 'V':
        $V = 'selected';
        break;
		case 'W':
				$W = 'selected';
				break;
		case 'X':
				$X = 'selected';
				break;
		case 'Y':
        $Y = 'selected';
        break;
    case 'Z':
        $Z = 'selected';
        break;
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
            <h2>Animes Center</h2>
            <?php if($_SESSION['u_rank'] <= 2) {
                    echo '<a href="posting-center.php?posting=new" class="btn button-link">New post</a>';
                  }?>
          </section>

                <form action="INCLUDES/postAnimesCenter.php" method="POST">
                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-md-4 col-xs-12">
                        <select class="selectpicker" title="Letter" name="animesCenter">
                            <option <?php echo $A ?> value="A">A</option>
                            <option <?php echo $B ?> value="B">B</option>
                            <option <?php echo $C ?> value="C">C</option>
                            <option <?php echo $D ?> value="D">D</option>
                            <option <?php echo $E ?> value="E">E</option>
                            <option <?php echo $F ?> value="F">F</option>
                            <option <?php echo $G ?> value="G">G</option>
                            <option <?php echo $H ?> value="H">H</option>
                            <option <?php echo $I ?> value="I">I</option>
                            <option <?php echo $J ?> value="J">J</option>
                            <option <?php echo $K ?> value="K">K</option>
                            <option <?php echo $L ?> value="L">L</option>
                            <option <?php echo $M ?> value="M">M</option>
                            <option <?php echo $N ?> value="N">N</option>
                            <option <?php echo $O ?> value="O">O</option>
                            <option <?php echo $P ?> value="P">P</option>
                            <option <?php echo $Q ?> value="Q">Q</option>
                            <option <?php echo $R ?> value="R">R</option>
                            <option <?php echo $S ?> value="S">S</option>
                            <option <?php echo $T ?> value="T">T</option>
                            <option <?php echo $U ?> value="U">U</option>
                            <option <?php echo $V ?> value="V">V</option>
                            <option <?php echo $W ?> value="W">W</option>
                            <option <?php echo $W ?> value="X">X</option>
                            <option <?php echo $Y ?> value="Y">Y</option>
                            <option <?php echo $Z ?> value="Z">Z</option>
                          </select>
                        </div>
                        <div class="col-md-4 col-xs-12">
                          <select class="selectpicker" title="Langage" name="lang">
                            <option <?php echo $one ?> value="jap">Japanese Title</option>
                            <option <?php echo $two ?> value="en">English Title</option>
                          </select>
                       </div>
                       <div class="col-md-4 col-xs-12">
                         <button class="btn button-gray glyphicon glyphicon-refresh" type="submit" name="submit"></button>
                       </div>
                     </div>
                   </div>
                  </form>

                  <div class="divider"></div>

					<section id="content">
						<div class="container-fluid">

                        <!-- To modify -->

              <?php if ($_GET['lang'] == 'en') {
                      include 'INCLUDES/postInsertAnime-centerEn-inc.php';
                    }
                    else {
                      include 'INCLUDES/postInsertAnime-centerJap-inc.php';
                    }?>
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
