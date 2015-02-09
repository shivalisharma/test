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
  <table width="30%" border="1" cellpadding="1">
    <tr>
      <th scope="col"> <p>Quantity</p>
      </th>
    </tr>
    <tr>
      <th scope="col" class="dialog">2</th>
    </tr>
    <tr>
      <th scope="col" class="dialog">5</th>
    </tr>
    <tr>
      <th scope="col" class="dialog">3</th>
    </tr>


  </table>

  <div id="dialog" title="Edit Product Quantity" style="display:none;">
  <input type="text" name="editQun" id="editQun" /><br>
  <small>And You can Edit this value regarding product Id Using Ajax </small>
</div>
</body>
</html>