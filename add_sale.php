<?php
  $page_title = 'Add Sale';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
?>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
</head>
<body>
<?php

  if(isset($_POST['add_sale'])){
    $req_fields = array('s_id','quantity','price','total', 'date' );
    validate_fields($req_fields);
        if(empty($errors)){
          $p_id      = $db->escape((int)$_POST['s_id']);
          $s_qty     = $db->escape((int)$_POST['quantity']);
          $s_total   = $db->escape($_POST['total']);
          $date      = $db->escape($_POST['date']);
          $s_date    = make_date();

          $sql  = "INSERT INTO sales (";
          $sql .= " product_id,qty,price,date";
          $sql .= ") VALUES (";
          $sql .= "'{$p_id}','{$s_qty}','{$s_total}','{$s_date}'";
          $sql .= ")";

                if($db->query($sql)){
                  update_product_qty($s_qty,$p_id);
                  $session->msg('s',"Sale added. ");
                  redirect('add_sale.php', false);
                } else {
                  $session->msg('d',' Sorry failed to add!');
                  redirect('add_sale.php', false);
                }
        } else {
           $session->msg("d", $errors);
           redirect('add_sale.php',false);
        }
  }

?>
<?php include_once('layouts/header.php'); ?>


  <div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="row well"  style="background-color:white;">
					<h3 class="text-primary font-weight-bold" style="font-weight:700">Recipient Details</h3><hr style="border-top: 1px solid #3498DB;">

					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="name">Name:</label>
								<input type="text" class="form-control organisation" id="name" placeholder="Name">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="addres">Address</label>
								<textarea rows="4" class="form-control website" id="address" placeholder="Address"></textarea>
							</div>
						</div>
					</div>
				</div>
			</div>
    </div>
  </div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th text-danger"></span>
          <span>Items</span>
       </strong>
      </div>
      <div class="panel-body">
        <form method="post" action="add_sale.php">
         <table class="table table-bordered">
            <thead>
              <th> Item </th>
              <th> Price </th>
              <th> Qty </th>
              <th> Total </th>
              <th> Date</th>
              <th> Action</th>
            </thead>
            <tbody> 
              <td>
                  <div class="row ">
                    <div class="col-sm-12 col-md-12 col-lg-12 ">
                            <form>
                              <div class="form-label-group">
                                  <!--<label for="inputEmail">Country <span class="required">*</span></label>-->
                                  <select  name="select2" id="select2" class="form-control">
                                      <option value="">Choose Item</option>
                                      <?php
                                      if ($countries->num_rows>0){
                                          while ($country = $countries->fetch_object()){ ?>
                                              <option value="<?php echo $country->code;?>"><?php echo $country->countryname;?></option>
                                         <?php  }
                                      }
                                      ?>
                                  </select>
                              </div> 
                            </form>
                    </div>
                </div>
              </td>
              <td>
              1123
              <td><input type='number' min='1'></td>
              <td></td>
              <td></td>
              <td>
              <button type="reset" class="btn btn-danger">Reset</button>
              <button  class="btn btn-primary">Add Item</button>
             </td>
            </tbody>
         </table>
       </form>
      </div>
    </div>
  </div>

</div>
<script type="text/javascript">
    $("#select2").select2({
        templateResult: formatState
    });
    function formatState (state) {
        if (!state.id) {
            return state.text;
        }
        var baseUrl = "flags";
        var $state = $(
            '<span><img src="' + baseUrl + '/' + state.element.value.toLowerCase() + '.png" class="img-flag" /> ' + state.text + '</span>'
        );
        return $state;
    }
</script>
</body>
</html>
<?php include_once('layouts/footer.php'); ?>
