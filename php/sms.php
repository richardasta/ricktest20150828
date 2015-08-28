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
/* Send an SMS using Twilio. */
require "services/Twilio.php";

function appendsmslog($file, $data)	{
        // Append if the fila already exists...
		if (file_exists($file))
		{
			file_put_contents($file,  $data, FILE_APPEND | LOCK_EX);
		}
        // Otherwise write a new file...
		else
		{
			file_put_contents($file, $data);
		}
	}

	// AccountSid and AuthToken from www.twilio.com/user/account
	$AccountSid = "AC9a27e1726bf3e796e9601c4691adbdfd";
	$AuthToken = "9ec5f838c5600f27a8558b25c0ebb5db";
	$from = "847-553-4253";

	try
	{

	// instantiate a new Twilio Rest Client
		$client = new Services_Twilio($AccountSid, $AuthToken);

		$name = $_POST['sms_cont_name'];
		$to   = $_POST['sms_cont_phone'];
		$my_name  = $_POST['sms_your_name'];
		$my_number = $_POST['sms_your_email'];

//		$sms_body="$name, $my_name is sending you this message and is interested in having you use the BuildClean dust control system in their construction. For more info and a free trial offer: http://bit.ly/buildclean-trial";
		$sms_body="$name, $my_name sent this and wants to show you the BuildClean dust control system for their construction. For more info and a free trial: http://buildclean-trial.com";
		$sms = $client->account->messages->sendMessage( $from, $to, $sms_body);

		echo "An sms message has been sent to $name at $to";

//		 echo "<p>$sms->body</p>";
//		 echo "<br/>";
//	     echo "<p>to $name is $sms->status</p>";

  	// append to log
		$date = date('Y-m-d H:i:s');
		$data_csv = "ContractorName:$name, ContractorMobile:$to, HomeOwner:$my_name, HomeOwnerNumber:$my_number, DateTime:$date, \n";
		appendsmslog("sms.log", $data_csv);
	}

  	//catch exception
	catch(Exception $e)
	{
		echo '<p>Message: ' .$e->getMessage() .'</p>';
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

