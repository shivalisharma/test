<!DOCTYPE html>
<html>
<?php
include_once("config.php"); 
if (isset($_POST['submit'])) {
 try {
$result = $dbh->prepare("SELECT COUNT(*) FROM login_admin WHERE `username`='".$_POST['username']."' and `email` = '".$_POST['email']."'");
$result->execute();
$num=$result->fetchColumn();
if($num < 1){
        $STH = $dbh->prepare("INSERT INTO login_admin (username,email,password,message) VALUES (:username,:email,:password,:message)");
        $STH->bindParam(':username', $username);
        $STH->bindParam(':email', $email);
        $STH->bindParam(':password', $password);
		$STH->bindParam(':message', $message);

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
		$message = $_POST['message'];
        $STH->execute();
		$subject = "Login Credentials";
		$response = "Hello, your username is ".$_POST['username']." and Password is ".$_POST['password'];
		  /*Send Mail*/
                   require("phpmailer/class.phpmailer.php");
		           require("phpmailer/config.php");
                    $to = $_POST['email'];
                    $fromName =  'Test';
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
      // attempted to echo back the data, but nothing happens

}
else
{
echo "Username and Email already exist";
}
    } catch (PDOException $e) {
        echo $e->getMessage(); // no errors
    }
}?>
<head>
    <meta charset="utf-8" />
    <title>Registration form Template | PrepBootstrap</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />

    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">

<div class="page-header">
    <h1>Registration form</h1>
</div>

<!-- Registration form - START -->
<div class="container">
    <div class="row">
        <form role="form" method="post" action="">
            <div class="col-lg-6">
                <div class="well well-sm"><strong><span class="glyphicon glyphicon-asterisk"></span>Required Field</strong></div>
                <div class="form-group">
                    <label for="username">Enter Name</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="username" id="username" placeholder="Enter Name" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Enter Email</label>
                    <div class="input-group">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                  <div class="form-group">
                    <label for="password">Enter Password</label>
                    <div class="input-group">
                       <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="message">Enter Message</label>
                    <div class="input-group">
                        <textarea name="message" id="message" class="form-control" rows="5" required></textarea>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-info pull-right">
				<a class="btn btn-info pull-right" href="index.php">Login</a>
            </div>
        </form>
    </div>
</div>
</div>

</body>
</html>