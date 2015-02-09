<?php
include_once("header.php");
if (isset($_POST['submit'])) {
    try {
$result = $dbh->prepare("SELECT COUNT(*) FROM worker WHERE `name`='".$_POST['name']."' and `email` = '".$_POST['email']."'");
	$result->execute();
$num=$result->fetchColumn();
if($num < 1){
        $STH = $dbh->prepare("INSERT INTO worker (name,email,designation,phone,admin_id) VALUES (:name,:email,:designation,:phone,:admin)");
        $STH->bindParam(':name', $name);
        $STH->bindParam(':email', $email);
        $STH->bindParam(':designation', $designation);
		$STH->bindParam(':phone', $phone);
		$STH->bindParam(':admin', $admin);

        $name = $_POST['name'];
        $email = $_POST['email'];
        $designation = $_POST['designation'];
		$phone = $_POST['phone'];
		$admin = $_SESSION['id'];
        $STH->execute();
	   $lastid =  $dbh->lastInsertId();
	    $STH1 = $dbh->prepare("INSERT INTO admin_worker_relation (admin_id,worker_id) VALUES (".$_SESSION['id'].",".$lastid.")");
		if($STH1->execute())
		{
		header("location:view.php");
		}
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
<body>

<div class="container">

<div class="page-header">
    <h1>Add New Tea Consumer</h1>
</div>

<!-- Registration form - START -->
<div class="container">
    <div class="row">
        <form role="form" method="post" action="">
            <div class="col-lg-6">
                <div class="well well-sm"><strong><span class="glyphicon glyphicon-asterisk"></span>Required Field</strong></div>
                <div class="form-group">
                    <label for="name">Enter Name</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" required>
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
                    <label for="designation">Enter designation</label>
                    <div class="input-group">
                       <input type="text" class="form-control" id="designation" name="designation" placeholder="Enter designation" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
				<div class="form-group">
                    <label for="designation">Enter Contact No.</label>
                    <div class="input-group">
                       <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
				
               <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-info pull-right">
			   <a class="btn btn-info pull-right" href="view.php">Cancel</a>
            </div>
        </form>
    </div>
</div>
<!-- Registration form - END -->

</div>

</body>
</html>