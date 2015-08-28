<!DOCTYPE html>
<html>
	<head>
		<title>BuildClean Trial</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap -->
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/bootstrap-theme.min.css">
		<link rel="stylesheet" type="text/css" href="../css/jquery.bxslider.css">
		<link rel="stylesheet" type="text/css" href="../css/bc.css">
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->
		<style>
		</style>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<a href="http://buildclean.com" class="no-underline">
					<div id="logo">
						&nbsp;
					</div></a>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<div class="divider"></div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<?php
					require 'includes/PHPMailerAutoload.php';
					$eol = PHP_EOL;

					$buildclean_email = 'brian.paich@itwconstruction.com';

					$em_cont_name = $_POST['em_cont_name'];
					$em_cont_email = $_POST['em_cont_email'];
					$em_your_name = $_POST['em_your_name'];
					$em_your_email = $_POST['em_your_email'];

					//Create a new PHPMailer instance
					$mail_contractor = new PHPMailer();
					$mail_visitor = new PHPMailer();
					$mail_buildclean = new PHPMailer();
					//Set who the message is to be sent from
					$mail_contractor -> setFrom($em_your_email, $em_your_name);
					$mail_visitor -> setFrom($buildclean_email, 'buildclean.com');
					$mail_buildclean -> setFrom($em_your_email, $em_your_name);

					//$mail -> addReplyTo('aaronzygmunt@gmail.com', 'AZ Reply');

					$mail_contractor -> addAddress($em_cont_email, $em_cont_name);
					$mail_visitor -> addAddress($em_your_email, $em_your_name);
					$mail_buildclean -> addAddress($buildclean_email, 'Brian Paich');

					//Set the subject line
					$mail_contractor -> Subject = 'Dust control during our remodel';
					$mail_visitor -> Subject = "Your message was sent to $em_cont_name";
					$mail_buildclean -> Subject = 'Buildclean Web Trial';

					$mail_body_contractor = "
	<p>From: $em_your_name<br>$eol
Email: $em_your_email<br>$eol
I'm interested in having you use BuildClean's Dust Control System. The attachment will tell you more about it and how to get a free trial of BuildClean to use on our remodel. Thanks.</p>$eol
<p>Learn more at <a href='http://buildclean.com'>buildclean.com</a>.</p>";

					$mail_body_visitor = "An email with the BuildClean trial offer has been sent to " . $em_cont_name . ".  Thank you." . $eol . $eol . "Buildclean.com";

					$mail_body_buildclean = "You received a request for a brochure to be sent.$eol$eol
From: $em_your_name$eol
Email: $em_your_email$eol
Contractor Name: $em_cont_name$eol
Contractor Email: $em_cont_email$eol";

					$mail_contractor -> msgHTML($mail_body_contractor);
					$mail_visitor -> msgHTML($mail_body_visitor);
					$mail_buildclean -> msgHTML($mail_body_buildclean);

					//Replace the plain text body with one created manually
					//		$mail -> AltBody = 'This is a plain-text message body';
					//Attach an image file
					$mail_contractor -> addAttachment('../BuildClean_Dust_Control.pdf');

					//send the message, check for errors
					if (!$mail_contractor -> send()) {
						echo "Mailer Error: " . $mail -> ErrorInfo;
					} else {
						if (!$mail_visitor -> send()) {
						echo "Mailer Error: " . $mail_visitor -> ErrorInfo;
						} else {
							if (!$mail_buildclean -> send()) {
								echo "Mailer Error: " . $mail_buildclean -> ErrorInfo;
							} else {
								echo "Thank You<br>";
								echo "A message has been sent to $em_cont_name at $em_cont_email";
							}
						}
					}
					?>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<div class="divider"></div>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-12 bc-footer">
					<h3>BuildClean makes remodeling more livable.</h3>
					<p>
						<sup>*</sup>BuildClean offers a 7-day free trial to professional remodeling contractors that are first time BuildClean users.Trial use requires a signed loaner agreement.
						<br>
						&copy;2013 Illinois Tools Works
					</p>
				</div>
			</div>
		</div>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://code.jquery.com/jquery.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="../js/bootstrap.min.js"></script><script src="../js/jquery.bxslider.min.js"></script>
	</body>
</html>

