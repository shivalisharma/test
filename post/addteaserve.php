<?php
include_once("header.php");
if (isset($_POST['submit'])) {
    try {
        $STH = $dbh->prepare("INSERT INTO tea_entry (who_paid,money,date,shift,who_paid_id) VALUES (:name,:money,:date,:shift,:u_id)");
        $STH->bindParam(':name', $name);
        $STH->bindParam(':money', $money);
        $STH->bindParam(':date', $date);
		$STH->bindParam(':shift', $shift);
		$STH->bindParam(':u_id', $u_id);

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
		if($STH->execute())
		{
		header("location:viewteaentry.php");
		}
		$lastId = $dbh->lastInsertId();
		   if (isset($_POST['consumer']) && is_array($_POST['consumer']) && count($_POST['consumer']) > 0) {
		            $amt = $money/count($_POST['consumer']);
                    foreach ($_POST['consumer'] as $consumer_id) {
					$STHREL = $dbh->prepare("INSERT INTO payer_consumer_relation (tea_rel_id,consumer_id,date,amount_to_pay,payer_id) VALUES (:tea_rel_id,:consumer_id,:date,:amt,:u_id)");
					$STHREL->bindParam(':tea_rel_id', $lastId);
                    $STHREL->bindParam(':consumer_id', $consumer_id);
                    $STHREL->bindParam(':date', $date);
                    $STHREL->bindParam(':amt', $amt);	
                    $STHREL->bindParam(':u_id', $u_id);					
                    $STHREL->execute();					
                    }
                }
		
		
		
		
		
      // attempted to echo back the data, but nothing happens

}
    catch (PDOException $e) {
        echo $e->getMessage(); // no errors
    }
	}
?>
<body>

<div class="container">

<div class="page-header">
    <h1>Add Tea Entry</h1>
</div>

<!-- Registration form - START -->
<div class="container">
    <div class="row">
        <form role="form" method="post" action="">
            <div class="col-lg-6">
                <div class="well well-sm"><strong><span class="glyphicon glyphicon-asterisk"></span>Required Field</strong></div>
                <div class="form-group">
                    <label for="name">Payer Name</label>
                    <div class="input-group">
					
				   
				   <select id='name' name='name' class="form-control" placeholder="Enter Name" required>
					  <option value="none">--Select--</option>
					  <?php
					$sth = $dbh->prepare("SELECT id,name FROM worker where admin_id = ".$_SESSION['id']);
                    $sth->execute();
				   $result = $sth->fetchAll();
                   foreach ($result as $row) {
                   ?>
					  <option value='<?php echo $row['name'];?>'><?php echo $row['name'];?></option>
                      <?php } ?>
							</select>
				    <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="money">Enter Money</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="money" name="money" placeholder="Enter money" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                  <div class="form-group">
				   <label for="date">Enter date</label>
                <div class='input-group date'>
				<input type='text' class="form-control" id='date' readonly name='date'>
							<span class="input-group-addon"><img alt="Calender" onClick="javascript:NewCssCal('date','yyyymmdd','dropdown',true,'24',true)" src="cal.png"/></span>
				
				
                </div>
            </div>
				<div class="form-group">
                    <label for="shift">Enter Shift</label>
                    <div class="input-group">
                        <select class="form-control" id="shift" name="shift">
                        <option value="Morning">Morning</option>
                        <option value="Evening">Evening</option>
                        </select> 
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
				   <label class="control-label">Add Consumers</label>
                                        <div class="control-group controls">


                                            <?php
                                            foreach ($result as $row1) {
                                                ?>
                                                <label class="checkbox-inline"><tr id="tr_consumer<?php echo $row1['id']; ?>">
                                                <?php echo $row1['name']; ?></tr>
                                                    <input type="checkbox" name = "consumer[]" id="consumer<?php echo $row1['id']; ?>" value="<?php echo $row1['id']; ?>"/></label>
<?php } ?>                        
                                        
				
				
				
				
				
               <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-info pull-right">
			   <a class="btn btn-info pull-right" href="viewteaentry.php">Cancel</a>
            </div>
        </form>
    </div>
</div>
<!-- Registration form - END -->

</div>

</body>
</html>