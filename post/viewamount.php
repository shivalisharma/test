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
<a class="navbar-brand" href="viewteaentry.php">Record</a></div>
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
	
	</tr>
</thead>
<tbody>

<?php $dateresult = $sth->fetchAll();

foreach ($dateresult as $row) {
$sth1 = $dbh->prepare("SELECT who_paid FROM tea_entry where id=".$row['tea_rel_id']." and who_paid_id!='".$_GET['id']."'");
$sth1->execute();
$ds = $sth1->fetchAll();
foreach ($ds as $row1) {

?><tr>
	<td><?php echo $row1['who_paid'];?></td>
	<td><?php echo $row['amt'];?></td>
	  </tr>
	<?php } }?>
	</tbody>
	
	</table>
	</div>
	</div>
	</body>
	<body>
	<div class="container">
	<div class="navbar-header"></div>
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"></div>
	<div class="container">

    <section id="no-more-tables">
<table id="example1" class="table table-striped table-bordered cf" cellspacing="0" width="100%">
					<thead class="cf">
					<tr>
					<th>To whom you have to Get</th>
					<th>Amount</th>
	
	</tr>
</thead>
<tbody>

<?php $dataget = $sthget->fetchAll();

foreach ($dataget as $row2) {


?><tr>
	<td><?php echo $row2['name'];?></td>
	<td><?php echo $row2['amt'];?></td>
	  </tr>
	<?php } ?>
	</tbody>
	
	</table>
	</div>
	
	</div>
	</body>
	
	
	 <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
	  google.setOnLoadCallback(drawChartOne);
function drawChartOne() {
        var data = google.visualization.arrayToDataTable([
          ['Amount To Pay', 'Amount To Get'],
		   <?php 
foreach ($dateresult as $rown) {
$sth1 = $dbh->prepare("SELECT who_paid FROM tea_entry where id=".$rown['tea_rel_id']." and who_paid_id!='".$_GET['id']."'");
$sth1->execute();
$ds = $sth1->fetchAll();
foreach ($ds as $rowm) {
?>
          ['<?php echo "(Give Money To)".$rowm['who_paid'];?>',<?php echo $rown['amt'];?>],
		   <?php } }?>
		   <?php 
foreach ($dataget as $row4) {
?>
          ['<?php echo "(Take Money From)".$row4['name'];?>',<?php echo $row4['amt'];?>],
		   <?php }?>
        ]);

        var options = {
          title: 'Amount Statistics',
		  is3D: true,

        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
		}
		
    </script>
	
	<body>
	  <div id="piechart" class="chart_container" style="width: 430px; height: 350px;"></div>
  </body>
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
} );

$(document).ready(function() {
    $('#example1').dataTable({
	"bLengthChange" : false
	});
} );</script>
	
</html>
