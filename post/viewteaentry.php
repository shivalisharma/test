<?php 
include_once("header.php");
$sth = $dbh->prepare("SELECT tea_entry.id,tea_entry.who_paid,tea_entry.money,tea_entry.date,tea_entry.shift FROM tea_entry left join worker on worker.id = tea_entry.who_paid_id left join admin_worker_relation on admin_worker_relation.worker_id = worker.id where admin_worker_relation.admin_id = ".$_SESSION['id']);
$sth->execute();
if(isset($_GET['status']))
{
$sth1 = $dbh->prepare("DELETE FROM tea_entry WHERE id='".$_GET['id']."'");
$sth1->execute();
$sthdel = $dbh->prepare("DELETE FROM payer_consumer_relation WHERE tea_rel_id='".$_GET['id']."'");
$sthdel->execute();
header("location:viewteaentry.php");
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
<a class="navbar-brand" href="view.php">View Tea Entry</a></div>
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="view.php">View Tea Consumers</a></li>
		<li><a href="addteaserve.php">Add Tea Entry</a></li>
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
	<th>Payer Name</th>
	<th>Consumer Names</th>
	<th>Amount(in Rs.)</th>
	<th>Date Time</th>
	<th>Shift</th>
	<th>Edit</th>
	<th>Delete</th>
	</tr>
</thead>
<tbody>	
	<?php $result = $sth->fetchAll();
	
foreach ($result as $row) {
?>
	<tr>
	<td><?php echo $row['who_paid'];?></td>
	<?php $sthtea = $dbh->prepare("SELECT name FROM worker left join payer_consumer_relation on payer_consumer_relation.consumer_id = worker.id WHERE payer_consumer_relation.tea_rel_id='".$row['id']."'");
    $sthtea->execute();
	$consumers =  $sthtea->fetchAll();
	$con_array = array();
    foreach ($consumers as $con_name) {
                $con_array[] = $con_name['name'];
            }
			$name = implode($con_array, ',');?> 
	  <td><?php echo $name;?></td>
	<td><?php echo $row['money'];?></td>
	<td><?php echo $row['date'];?></td>
	<td><?php echo $row['shift'];?></td>
	<td><a href = "editteaentry.php?id=<?php echo $row['id'];?>">Edit</a></td>
	<td><a href = "?status=delete&id=<?php echo $row['id'];?>" onClick="alert('Do you really want to delete this entry?')">Delete </a></td>
	</tr>
	<?php } ?>
	</tbody>
	</table>
	</div>
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
