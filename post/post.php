<?php include "header.php";
$sth = $dbh->prepare("SELECT id,title,description,username,user_id,date FROM posts");
 $sth->execute();?>
<!doctype html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <title>jQuery UI Dialog - Default functionality</title>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
  <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
  <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <script>
  $(function() {
    $( ".dialog" ).click(function(){        
        $('#editQun').val($(this).html()); 
        $('#dialog').dialog();
    });
  });
  </script>
  </head>
  <body>
  <div class="container">
	
<div class="page-header">
    <h1>View Posts</h1>
	
</div>
	
	<div class="container">
<a class="btn btn-info pull-right" href="addnewpost.php">Add</a>
	<a class="btn btn-info pull-right" href="logout1.php">Logout</a>
	
    <section id="no-more-tables">
<table id="example" class="table table-striped table-bordered cf" cellspacing="0" width="100%">
					<thead class="cf">
    <tr>
	<th>Title</th>
	<th>Description</th>
	<th>Add Comment</th>
    </tr>
	</thead>
<tbody>	
	 <?php $result = $sth->fetchAll();
 foreach ($result as $row) {
?>
    <tr>
	<td><?php echo $row['title'];?></td>
	<td><?php echo $row['description'];?></td>
	<td scope="col" class="dialog">Comment</td>
	</tr>
   <?php  } ?>
  </table>

  <div id="dialog" title="Edit Product Quantity" style="display:none;">
  <input type="hidden" name="editQun" id="editQun" value=<?php echo $result['id']?> /><br>
  <input type="text" name="editQun" id="editQun" /><br>
</div>
</div>
	</div>
	</div>
</body>
</html>