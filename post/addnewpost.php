<?php
include_once("header.php");
if($_SESSION['id']=="")
{
header("location:indexpost.php");
}
if (isset($_POST['submit'])) {
    try {
        $STH = $dbh->prepare("INSERT INTO posts (title,description,username,user_id) VALUES (:title,:description,:username,:user_id)");
        $STH->bindParam(':title', $title);
        $STH->bindParam(':description', $description);
        $STH->bindParam(':username', $username);
		$STH->bindParam(':user_id', $user_id);

        $title = $_POST['title'];
        $description = $_POST['description'];
        $username = $_SESSION['username'];
		$user_id = $_SESSION['id'];
        //$STH->execute();
	   // $lastid =  $dbh->lastInsertId();
	    // $STH1 = $dbh->prepare("INSERT INTO admin_worker_relation (admin_id,worker_id) VALUES (".$_SESSION['id'].",".$lastid.")");
		if($STH->execute())
		{
		header("location:post.php");
		}
      // attempted to echo back the data, but nothing happens


    } catch (PDOException $e) {
        echo $e->getMessage(); // no errors
    }
}?>
<body>

<div class="container">

<div class="page-header">
    <h1>Add New</h1>
</div>

<!-- Registration form - START -->
<div class="container">
    <div class="row">
        <form role="form" method="post" action="">
            <div class="col-lg-6">
                <div class="well well-sm"><strong><span class="glyphicon glyphicon-asterisk"></span>Required Field</strong></div>
                <div class="form-group">
                    <label for="title">Enter Title</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="title" id="title" placeholder="Enter Title" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Enter Description</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="description" name="description" placeholder="Enter Description" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
               <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-info pull-right" onClick="alert('New Post Created')">
			   <a class="btn btn-info pull-right" href="post.php">Cancel</a>
            </div>
        </form>
    </div>
</div>
<!-- Registration form - END -->

</div>

</body>
</html>