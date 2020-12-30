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
  $query  = "select * from products";
  $items=$db->query($query);
  echo '<script>items=[]</script>';
  while($row=$items->fetch_assoc()){
    echo '<script>item=[]</script>';
    echo '<script>item.push("'.$row["id"].'" )</script>';
    echo '<script>item.push("'.$row["name"].'" )</script>';
    echo '<script>item.push("'.$row["quantity"].'" )</script>';
    echo '<script>item.push("'.$row["sale_price"].'" )</script>';
    echo '<script>items.push(item)</script>';
    
  }
  echo '<script>console.log(items)</script>';
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
         <table id=item_table class="table table-bordered">
            <thead>
              <th> Item </th>
              <th> Price </th>
              <th> Qty </th>
              <th> Total </th>
              <th> Action</th>
            </thead>
            <tbody id='item_body'> 
            
              <td>
                  <div class="row ">
                    <div class="col-sm-12 col-md-12 col-lg-12 ">
                            <form>
                              <div class="form-label-group">
                                  <!--<label for="inputEmail">Country <span class="required">*</span></label>-->
                                  <select onchange="print_price()"  name="select2" id="select2" class="form-control">
                                      <option value="">Choose Item</option>
                                  </select>
                              </div> 
                            </form>
                    </div>
                </div>
              </td>
              <td id='price'>
              
              <td ><input id=qty type='number' oninput="print_total();" value=1 ></td>
              <td id='total'></td>
              <td>
              <button onclick=add_item(); class="btn btn-primary">Add Item</button>
             </td>
            </tbody>
         </table>
       </form>
       <button onclick=checkout();>checkout</button>
      </div>
    </div>
  </div>

</div>
<script type="text/javascript">
function reset(){
  event.preventDefault();
  document.getElementById('select2').value="";
}
function add_item(){
  event.preventDefault();
  var table = document.getElementById("item_table");

// Create an empty <tr> element and add it to the 1st position of the table:
var row = table.insertRow(1);

// Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
var cell1 = row.insertCell(0);
var cell2 = row.insertCell(1);
var cell3 = row.insertCell(2);
var cell4=row.insertCell(3);
var cell5=row.insertCell(4);
var cell6=row.insertCell(5);
// Add some text to the new cells:

cell1.innerHTML = "Item";
cell2.innerHTML = document.getElementById('select2').value;
cell3.innerHTML=document.getElementById('qty').value;
cell4.innerHTML=document.getElementById('total').innerHTML;
button = document.createElement('button');
button.innerHTML='delete';
button.onclick=function(){
  event.preventDefault();


}
cell5.appendChild(button);
}
selection=document.getElementById('select2');
console.log(items);
for(var i =0;i<items.length;i++){
  option=document.createElement('option');
  option.setAttribute('value',items[i][3]);
  option.innerHTML=items[i][1];
  selection.appendChild(option);
}
data=[];
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
    function print_price(){
      price=document.getElementById('select2').value;
      document.getElementById('price').innerHTML=price;
      document.getElementById('total').innerHTML=price;
    }
    function print_total(){
      if( document.getElementById('qty').value<1){
        document.getElementById('qty').value=1;
      };
      qt=document.getElementById('qty').value;
      document.getElementById('total').innerHTML=qt*document.getElementById('select2').value;
    }

</script>
</body>
</html>
<?php include_once('layouts/footer.php'); ?>
