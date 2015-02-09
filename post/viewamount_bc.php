<?php 
include_once("header.php");
$sth = $dbh->prepare("SELECT sum(payer_consumer_relation.amount_to_pay) as amt,payer_consumer_relation.tea_rel_id,tea_entry.who_paid FROM payer_consumer_relation left join tea_entry on tea_entry.id = payer_consumer_relation.tea_rel_id where payer_consumer_relation.consumer_id=".$_GET['id']." Group by tea_entry.who_paid");
$sth->execute();

$sthget = $dbh->prepare("SELECT sum(payer_consumer_relation.amount_to_pay) as amt,payer_consumer_relation.consumer_id,worker.name FROM payer_consumer_relation left join worker on worker.id=payer_consumer_relation.consumer_id where payer_consumer_relation.payer_id=".$_GET['id']." and payer_consumer_relation.consumer_id !=".$_GET['id']." Group by payer_consumer_relation.consumer_id");
$sthget->execute();


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
<a class="navbar-brand" href="moneyrecord.php">Record</a></div>
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="view.php">View Tea Consumers</a></li>
		<li><a href="viewteaentry.php">View Tea Entry</a></li>
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
					<th>To whom you have to pay</th>
					<th>Amount</th>
					<th>To whom you have to get</th>
					<th>Amount</th>
	
	</tr>
</thead>
<tbody>

<?php $dateresult = $sth->fetchAll();
$dataget = $sthget->fetchAll();

$con_array = array();
$amt_array = array();
    foreach ($dataget as $con_name) {
                $con_array[] = $con_name['name'];
				 $amt_array[] = $con_name['amt'];
            }
			$name = implode($con_array, ',');
			$amt = implode($amt_array, ',');




foreach ($dateresult as $row) {
$sth1 = $dbh->prepare("SELECT who_paid FROM tea_entry where id=".$row['tea_rel_id']." and who_paid_id!='".$_GET['id']."'");
$sth1->execute();
$ds = $sth1->fetchAll();
foreach ($ds as $row1) {


?><tr>
	<td><?php echo $row1['who_paid'];?></td>
	<td><?php echo $row['amt'];?></td>
	<td><?php echo $name;?></td>
	<td><?php echo $amt;?></td>
	  </tr>
	<?php } } ?>
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
