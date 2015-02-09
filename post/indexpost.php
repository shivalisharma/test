<?php 
include("config.php");
if(isset($_POST['submit'])){
$result = $dbh->prepare("SELECT COUNT(*) as tot,username,password,id FROM login_admin WHERE (`username`=:username and `password` = :password) OR (`email`=:username and `password` = :password)");
$result->bindParam(":username" ,$_POST['username']);
$result->bindParam(":password" ,md5($_POST['password']));
$result->execute();
$result = $result->fetchAll();
foreach ($result as $row) { 
 $id=$row['id'];
 $username=$row['username'];
 $num = $row['tot'];
}
//print_r($num); die();
//$num=$result->fetchColumn();
if($num > 0){
     session_start();
	 $_SESSION['id'] = $id;
	  $_SESSION['username'] = $username;
    header("location:post.php");
}else{
    header("location:indexpost.php");
}
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
          <h1 class="text-center">Login</h1>
      </div>
      <div class="container">
	  <?php if(!empty($_GET['id']))
	  { ?>
	  <div style="align:center;color:red">
	 <?php echo "Mail sent to your account";?>
	 </div>
	  <?php } else
	  {
	  } ?>
    <div class="row">
          <form role="form" method="post" action="">
		  <div class="col-lg-6">
			<div class="form-group">
			
			<label for="username">Enter Username</label>
			<div class="input-group">
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
					 </div>
			<div class="form-group">
			
			<label for="password">Enter Password</label>
			<div class="input-group">
                        <input type="password" class="form-control" name="password" id="password" placeholder="password" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
					 </div>
            <div class="form-group">
			<input type="submit" name="submit" id="submit" value="submit" class="btn btn-info pull-right">
              <span style="align:left"><a href="register.php">Register</a></span>
			  <span style="align:left"><a href="forgot.php">Forgot Password</a></span>
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