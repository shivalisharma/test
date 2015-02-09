<?php
include_once("header.php");
$result = $dbh->prepare("SELECT id,who_paid,money,date,shift,who_paid_id FROM tea_entry WHERE id = ?");
$result->execute(array($_GET['id']));
$num=$result->fetchAll();
if($num > 0){
if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $money = $_POST['money'];
        $date = $_POST['date'];
		$shift = $_POST['shift'];
		$sthid = $dbh->prepare("SELECT id FROM worker where name = '".$_POST['name']."'");
        $sthid->execute();
	    $resultid = $sthid->fetchAll(); 
		foreach ($resultid as $id)
		{
		 $u_id = $id['id'];
		 }
		
		
        $STH = $dbh->prepare("UPDATE tea_entry set who_paid=? ,money=?,date=?,shift=?,who_paid_id=? where id=?");
		$count=0;
		if($STH->execute(array($name, $money, $date,$shift,$u_id, $_GET['id'])))
		{
		$count++;
		}
        if($count > 0)
		{
		 header("location:viewteaentry.php");
		}
		else
		{
		echo "Some Error";
		}
}
}

 if (isset($_POST['consumer']) && is_array($_POST['consumer']) && count($_POST['consumer']) > 0) {
                     $amt = $money/count($_POST['consumer']);
                     $sth1 = $dbh->prepare("DELETE FROM payer_consumer_relation WHERE tea_rel_id='".$_GET['id']."'");
                     $sth1->execute();
                    foreach ($_POST['consumer'] as $consumer_id) {
					
					$STHREL = $dbh->prepare("INSERT INTO payer_consumer_relation (tea_rel_id,consumer_id,date,amount_to_pay,payer_id) VALUES (:tea_rel_id,:consumer_id,:date,:amt,:u_id)");
					$STHREL->bindParam(':tea_rel_id', $_GET['id']);
                    $STHREL->bindParam(':consumer_id', $consumer_id);
                    $STHREL->bindParam(':date', $date); 
					$STHREL->bindParam(':amt', $amt);
                    $STHREL->bindParam(':u_id', $u_id);						
                    $STHREL->execute();					
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
					
					 <select id='name' name='name' class="form-control" placeholder="Enter Name" required>
					  <?php
					$sth = $dbh->prepare("SELECT id,name FROM worker");
                    $sth->execute();
				   $result = $sth->fetchAll();
                   foreach ($result as $row1) {
                   ?>
					  <option value='<?php echo $row1['name'];?>'<?php if($row1['name']==$row['who_paid']){echo"selected='selected'";}?>><?php echo $row1['name'];?></option>
                      <?php } ?>
							</select>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="money">Enter Amount</label>
                    <div class="input-group">
					  <input type="text" class="form-control" id="money" name="money" placeholder="Enter money" value = "<?php echo $row['money'];?>" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
				 <div class="form-group">
				   <label for="date">Enter date</label>
                <div class='input-group date'>
				<input type='text' class="form-control" id='date' readonly name='date' value = "<?php echo $row['date'];?>" >
							<span class="input-group-addon"><img alt="Calender" onClick="javascript:NewCssCal('date','yyyymmdd','dropdown',true,'24',true)" src="cal.png"/></span>
				
				
                </div>
            </div>
			<div class="form-group">
                    <label for="shift">Enter Shift</label>
                    <div class="input-group">
                        <select class="form-control" id="shift" name="shift">
                        <option value="Morning" <?php if((isset($row['shift'])) && ($row['shift']=='Morning') ){echo "selected='selected'";}?>>Morning</option>
                        <option value="Evening" <?php if((isset($row['shift'])) && ($row['shift']=='Evening') ){echo "selected='selected'";}?>>Evening</option>
                        </select> 
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
				 <label class="control-label">Add Consumers</label>
										<div class="control-group controls">
										<?php
                                            $consumers = array();
											$sthtea = $dbh->prepare("SELECT consumer_id FROM payer_consumer_relation WHERE tea_rel_id='".$_GET['id']."'");
                                            $sthtea->execute();
	                                        $consumers =  $sthtea->fetchAll();
											
                                            foreach ($consumers as $selected) {

                                                $consumers[] = $selected['consumer_id'];
                                            }
                                            foreach ($result as $row2) {
                                                ?>
                                                <label class="checkbox-inline"><tr id="tr_consumer<?php echo $row2['id']; ?>">
                                                <?php echo $row2['name']; ?></tr>
                                                    <input type="checkbox" name = "consumer[]" id="consumer<?php echo $row2['id']; ?>" value="<?php echo $row2['id']; ?>" <?php echo in_array($row2['id'], $consumers) ? "checked" : "" ?>/></label>
                                                    <?php } ?>
										
										
										
										
										
										
										
				
				
                <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-info pull-right" onClick="alert('Do you really want to edit Details?')">
				<a class="btn btn-info pull-right" href="viewteaentry.php">Cancel</a>
            </div>
        </form>
		<?php } ?>
    </div>
</div>
<!-- Registration form - END -->

</div>

</body>
</html>
