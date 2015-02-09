<?php 
include("config.php");
if(isset($_POST['submit'])){

  $alphabet = "abcdefghijklmnopqrstuwxyz";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 4; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
	$password = implode($pass);
	$password1 = md5($password);
		//echo $pass;
	$subject = "New Login Password";
	$response = "Hello,<br> Your new password is <b>".$password."</b>.";
                           /*Send Mail*/
                   require("phpmailer/class.phpmailer.php");
		           require("phpmailer/config.php");
                    $to = $_POST['email'];
                    $fromName =  'Shivali';
					$fromEmail = 'noreply@fieldo.se';
					//start phpmailer code 
					//$response = $password;
					$mail = new PHPmailer();
					$mail->SetLanguage("en", "phpmailer/language");
					$mail->From = $fromEmail;
					$mail->IsHTML(true);
					$mail->FromName = $fromName;
					$mail->Host = $smtp;
					$mail->Mailer   = "smtp";
					$mail->Password = $smtp_pass;
					$mail->Username = $smtp_user;
					$mail->Subject = $subject;
					$mail->SMTPAuth  =  "true";
					$mail->Body = $response;
					$mail->AddAddress($to);
					$mail->AddReplyTo($fromEmail,$fromName);
					$mail->Send();
					$mail->ClearAddresses();
					$mail->ClearAttachments();
					
$result = $dbh->prepare("UPDATE login_admin set `password` = '".$password1."'WHERE `email`=:email");
$result->bindParam(":email" ,$_POST['email']);
$result->execute();
/*End Mail Code*/
    header("location:index.php?id=1");
}
/* Fetch all of the remaining rows in the result set */
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Bootstrap Login Form</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		 <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />

    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	</head>
	<body>
<!--login modal-->
<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h1 class="text-center">Forgot Password</h1>
      </div>
      <div class="container">
    <div class="row">
          <form role="form" method="post" action="">
		  <div class="col-lg-6">
			<div class="form-group">
			
			<label for="email">Enter Email</label>
			<div class="input-group">
                        <input type="text" class="form-control" name="email" id="email" placeholder="email" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
					 </div>
            <div class="form-group">
			<input type="submit" name="submit" id="submit" value="submit" class="btn btn-info pull-right">
            </div>
			</div>
          </form>
      </div>
	  </div>
      <div class="modal-footer">
      </div>
  </div>
  </div>
</div>
	<!-- script references -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>