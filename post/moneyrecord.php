<?php 
include_once("header.php");
$sth = $dbh->prepare("SELECT name FROM worker");
$sth->execute();
$sthdate = $dbh->prepare("SELECT date,shift,money,who_paid FROM tea_entry");
$sthdate->execute();
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
					<th>Date</th>
					<th>Payer/Paid Amount</th>
					<?php $result = $sth->fetchAll();
	
foreach ($result as $row) {
?>
	<th><?php echo $row['name'];?></th> <?php } ?>
	
	</tr>
</thead>
<tbody>
	
<?php $dateresult = $sthdate->fetchAll();
	
foreach ($dateresult as $row) {
?><tr>
	<td><?php echo $row['date']."/".$row['shift'];?></td>
	<td><?php echo $row['who_paid']."/".$row['money'];?></td>
	
	<?php $sthdividedamountperson = $dbh->prepare("SELECT count( payer_consumer_relation.consumer_id ) as amt,tea_entry.who_paid FROM payer_consumer_relation INNER JOIN tea_entry ON tea_entry.date = payer_consumer_relation.date WHERE tea_entry.date ='".$row['date']."'");
       $sthdividedamountperson->execute();
	    $m = $row['money'];
	   $cnt = $sthdividedamountperson->fetchAll();
	  
	   foreach($cnt as $c)
	   {
	   $cnt = $m/$c['amt'];
	  // $eachamt = $cnt; 
	   foreach ($result as $row1) {
	   if($row1['name'] == $c['who_paid'])
	   {
	   $eachamt = "0";
	   }
	   else
	   {
	   $eachamt = $cnt;
	   }
	   ?>
	    
	   <td><?php echo $row1['name']." have to pay ". $eachamt." to ".$c['who_paid'];?></td>
	   <?php
	   }
	   }?>
	  </tr>
	<?php } ?>
	</tbody>
	<tfoot>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th> </th>	
                                                    <th></th>
                                                   								
                                                </tr>
                                            </tfoot>
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
