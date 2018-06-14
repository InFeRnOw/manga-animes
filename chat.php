<?php
    session_start();
    include_once 'INCLUDES/dbh-inc.php';
    if (!isset($_SESSION['u_id'])) {
    echo '<script>
            window.location.href="login.php";
        </script>';
    }
    else {
      $friend = $_GET['friend'];
      $chatRoomId = $_GET['chatroom'];
      $_SESSION['roomid'] = $_GET['chatroom'];
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
    <script src="JS/chat.js"></script>
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
              <h1>Chatting with <?php echo $friend ?></h1>

              <div class="divider"></div>

						</div>
          </section>

					<section id="chat">
						<div class="container-fluid">
              <div class="row">
                <div id="postBox">

                  <?php include 'INCLUDES/chatTextInsert-inc.php' ?>

                </div>

                <?php include 'INCLUDES/errors-inc.php'; ?>

                <form id="chatForm" action="INCLUDES/chatSend-inc.php" method="POST">
                  <input id="chat-friend" type="hidden" name="friend" value="<?php echo $friend ?>">
                  <input id="chat-room" type="hidden" name="chatroom" value="<?php echo $chatRoomId ?>">
                <div class="row">
                  <div class="col-sm-9 col-xs-12">
                    <input id="chat-text" type="text" name="chatText" maxlength="250" placeholder="Message..."/>
                  </div>
                  <div class="col-sm-3 col-xs-12">
                    <button class="btn btn-classic chat-submit" type="submit" name="submit">Send</button>
                  </div>
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
