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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
			<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
			<script src="/JS/donate.js"></script>
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

			<div id="page">
				<section id="post">
					<div class="divider-with-content"><h1>Donate</h1></div>
					<p>Help us by donating to us, with your donation we will be able to maintain our site online easier and it will encourage us to improve the site.</p>
					<div class="donate"></div>
					  <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
					      <input type="hidden" name="cmd" value="_donations">
					      <input type="hidden" name="business" value="couvreux_corentin@yahoo.fr">
					      <input type="hidden" name="lc" value="US">
								<h3><u>Amount</u></h3>
					      <input type="text" name="amount" placeholder="EUR">
								<p style="font-size:12px; color: grey;">For decimals numbers please use a dot (".")</p>
					      <input type="hidden" name="no_note" value="0">
					      <input type="hidden" name="cn" value="Add special instructions to the seller:">
					      <input type="hidden" name="no_shipping" value="2">
					      <input type="hidden" name="currency_code" value="EUR">
					      <input type="hidden" name="bn" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHosted">
					      <center>
										</br>
					          <input type="image" height="47" name="I1" src="https://www.paypalobjects.com/en_US/GB/i/btn/btn_donateCC_LG.gif" width="160" />
					      </center>
					  </form>
					</section>
				</div>

      <!-- Footer -->

				<div id="footer">

          <?php include 'INCLUDES/html-inc/htmlFooterMain-inc.php' ?>

				</div>


        </div>
    </body>
</html>
