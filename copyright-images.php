<?php
session_start();
include 'INCLUDES/dbh-inc.php';

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
	</head>
	<body>
		<div class="container-fluid">
			<!-- Header -->
				<div id="header">

					<?php include 'INCLUDES/html-inc/htmlHeaderMain-inc.php' ?>

					<div class="divider-nav"></div>

            </div>
            <!-- Page -->
          <div class="page">
                <h1>Images Reports</h1>
                <h3><u>Images used by the website</u></h3>
                <p>We respect the authors of the images we use but unfortunately, we were unable to find most of the authors. So if any of the pictures used on this site belongs to you and that you disagree with its use, please use this section to report it to us. We will contact you as soon as possible in order to find agreements or if asked we will remove it immediately after having proof that the image in question is indeed yours.</p>
                <h3><u>Images posted by a member of the community</u></h3>
                <p>If an image in a post belongs to you and you disagree with it being posted on this website, you can use this section to report it to us. We will put you in contact with the author of the post in question for possible arrangements. In case of failure to do so, we will ask the author to remove the image and in extreme cases the post in question shall be deleted.</p>

                    <form id="reportForm" action="INCLUDES/imagesReport-inc.php" method="POST">
                        <div style>
													<div class="row">
														<div class="col-md-4"></div>
														<div class="col-md-4 col-xs-12">
	                            <dl class="unit">
	                                <dt>Name <span style="color:#ff0000;">*</span></dt>
	                                <dd>
	                                <input type="text" name="nom" size="30" value="<?php echo $_SESSION['u_uid']?>" readonly="readonly"/>
	                                </dd>
	                            </dl>
														</div>
														<div class="col-md-4"></div>
													</div>
													<div class="row">
														<div class="col-md-4"></div>
														<div class="col-md-4 col-xs-12">
	                            <dl class="unit">
	                             <dt>Email <span style="color:#ff0000;">*</span></dt>
	                                <dd>
	                                <input type="text" name="email" size="30" value="<?php echo $_SESSION['u_email']?>" readonly="readonly"/>
	                                </dd>
	                            </dl>
														</div>
														<div class="col-md-4"></div>
													</div>
													<div class="row">
														<div class="col-md-4"></div>
														<div class="col-md-4 col-xs-12">
	                            <dl class="unit">
	                                <dd>
	                                <input type="hidden" name="imgSubject" value="Images-copyright"/>
	                                </dd>
	                            </dl>
														</div>
													</div>
													<div class="row">
														<div class="col-md-4"></div>
														<div class="col-md-4 col-xs-12">
	                            <dl class="unit">
	                                <dt>Reasons | Expectations | Instructions <span style="color:#ff0000;">*</span></dt>
	                                <dd>
	                                <i>Please write your reasons, expectations or instructions. (500 Characters max)</i> </br>
	                            		<textarea id="bugText" name="imgText" style="width: 100%; resize: vertical; min-height: 150px; border-radius: 5px; box-shadow: 1px 1px 3px #555; border: 1px solid lightgrey;" maxlength="500"> </textarea>   </dd>
	                            </dl>
														</div>
														<div class="col-md-4"></div>
													</div>
                       <!-- <p>Name <span style="color:#ff0000;">*</span> <input type="text" name="nom" size="30" value="<?php echo $_SESSION['u_uid']?>"/> </p>
                        <p>Email <span style="color:#ff0000;">*</span> <input type="text" name="email" size="30" value="<?php echo $_SESSION['u_email']?>"/></p>
                        <dd>Summary <span style="color:#ff0000;">*</span> <i>Enter a one-line summary of the issue.</i></dd>
                        <input type="text" name="nom" size="30"/>
                        <dd>Description <span style="color:#ff0000;">*</span> <i>Describe the bug here.</i></dd>
                        <textarea name="message" cols="60" rows="10"></textarea>
                <!-- Ici pourra être ajouté un captcha anti-spam (plus tard) -->
											 <div class="row">
												 <div class="col-md-4"></div>
                       	 <div class="col-md-4 col-xs-12"><button type="submit" name="submit">Send</button></div>
											 	 <div class="col-md-4"></div>
											</div>
                    </form>
                </div>
            </div>
         </div>
            <!-- Footer -->

				<div id="footer">

          <?php include 'INCLUDES/html-inc/htmlFooterMain-inc.php' ?>

				</div>


        </div>
    </body>
</html>
