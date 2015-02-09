<?php 
include_once("header.php");
$sth = $dbh->prepare("SELECT id,name,email,designation,phone FROM worker where admin_id ='".$_SESSION['id']."'");
$sth->execute();
if(isset($_GET['status']))
{
$sth1 = $dbh->prepare("DELETE FROM worker WHERE id='".$_GET['id']."'");
$sth1->execute();
$sth2 = $dbh->prepare("DELETE FROM admin_worker_relation WHERE worker_id='".$_GET['id']."'");
$sth2->execute();
$sth3 = $dbh->prepare("DELETE FROM tea_entry WHERE who_paid_id='".$_GET['id']."'");
$sth3->execute();
$sth4 = $dbh->prepare("DELETE FROM payer_consumer_relation WHERE (payer_id='".$_GET['id']."' or consumer_id = '".$_GET['id']."')");
$sth4->execute();
header("location:view.php");
}
/* Fetch all of the remaining rows in the result set */
?>
	<body>
	<div class="container">
	<div class="navbar-header">
	  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
<a class="navbar-brand" href="view.php">View Tea Consumers</a></div>
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="viewteaentry.php">View Tea Entries</a></li>
		<li><a href="addnew.php">Add Consumer</a></li>
      </ul>
<ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php">Logout</a></li>
</ul>
</div>
	<div class="container">

    <section id="no-more-tables">
<table id="example" class="table table-striped table-bordered cf" cellspacing="0" width="100%">
					<thead class="cf">
					<tr>
	<th>name</th>
	<th>email</th>
	<th>designation</th>
	<th>phone</th>
	<th>Edit</th>
	<th>Delete</th>
	<th>View Amount History</th>
	</tr>
</thead>
<tbody>	
	<?php $result = $sth->fetchAll();
foreach ($result as $row) {
?>
	<tr>
	<td><?php echo $row['name'];?></td>
	<td><?php echo $row['email'];?></td>
	<td><?php echo $row['designation'];?></td>
	<td><?php echo $row['phone'];?></td>
	<td><a href = "edit.php?id=<?php echo $row['id'];?>">Edit</a></td>
	<td><a href = "?status=delete&id=<?php echo $row['id'];?>" onClick="alert('Do you really want to delete this worker?')">Delete </a></td>
	<td><a href = "viewamount.php?id=<?php echo $row['id'];?>">View</a></td>
	</tr>
	<?php } ?>
	</tbody>
	</table>
	</div>
	</div>
	<!-- script references -->
	<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/725b2a2115b/integration/bootstrap/3/dataTables.bootstrap.css">
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.2/css/jquery.dataTables.css">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="//cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/no-more-tables.css">
<script src="//cdn.datatables.net/plug-ins/725b2a2115b/integration/bootstrap/3/dataTables.bootstrap.js"></script>
<script>$(document).ready(function() {
    $('#example').dataTable({
	"bLengthChange" : false
	});
} );</script>
	</body>
</html>
