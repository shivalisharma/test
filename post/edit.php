<?php
include_once("header.php");
$result = $dbh->prepare("SELECT id,name,email,designation,phone FROM worker WHERE id = ?");
$result->execute(array($_GET['id']));
$num=$result->fetchAll();
if($num > 0){
if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $designation = $_POST['designation'];
		$phone = $_POST['phone'];
        $STH = $dbh->prepare("UPDATE worker set name=? ,email=?,designation=?,phone=? where id=?");
		$count=0;
		if($STH->execute(array($name, $email, $designation,$phone, $_GET['id'])))
		{
		$count++;
		}
        if($count > 0)
		{
		 header("location:view.php");
		}
		else
		{
		echo "Some Error";
		}
}
} 

?>
<body>

<div class="container">

<div class="page-header">
    <h1>EDIT</h1>
</div>

<!-- Registration form - START -->
<div class="container">
    <div class="row">
	<?php 
foreach ($num as $row) {?>
        <form role="form" method="post" action="">
            <div class="col-lg-6">
                <div class="well well-sm"><strong><span class="glyphicon glyphicon-asterisk"></span>Required Field</strong></div>
                <div class="form-group">
                    <label for="name">Enter Name</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" value = "<?php echo $row['name'];?>" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Enter Email</label>
                    <div class="input-group">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value = "<?php echo $row['email'];?>" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                  <div class="form-group">
                    <label for="designation">Enter designation</label>
                    <div class="input-group">
                       <input type="text" class="form-control" id="designation" name="designation" placeholder="Enter designation" value = "<?php echo $row['designation'];?>" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
				<div class="form-group">
                    <label for="phone">Enter Contact No.</label>
                    <div class="input-group">
                       <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone" value = "<?php echo $row['phone'];?>" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-info pull-right" onClick="alert('Do you really want to edit Details?')">
				<a class="btn btn-info pull-right" href="view.php">Cancel</a>
            </div>
        </form>
		<?php } ?>
    </div>
</div>
<!-- Registration form - END -->

</div>

</body>
</html>
