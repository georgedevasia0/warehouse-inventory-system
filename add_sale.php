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
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
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
            <thead id='head'>
              <th> Item </th>
              <th> Price </th>
              <th> Quantity </th>
              <th> Total </th>
              <th> Action</th>
            </thead>
            <tbody id='item_body'> 
            
              <td  style="width:250px;">
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
              <td id='price'  style="width:150px;">
              
              <td style="width:50px;"><input id=qty type='number' oninput="print_total();" value=1 ></td>
              <td id='total' style="width:150px;"></td>
              <td>
              <button onclick=add_item(); class="btn btn-primary"><i class="fas fa-plus"></i> Add Item</button>
             </td>
            </tbody>
         </table>
       </form>
       <button class="btn btn-success col-lg-3" id="myAnchor" data-toggle="modal" data-target="#myModal"><i class="fas fa-cart-plus"></i> Checkout</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="text-primary font-weight-bold text-center" style="font-weight:700">Recipient Details</h3>
        </div>
        <div class="modal-body">
          <div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="name"><i class="fas fa-user" style="color:#07BCFC"></i> Name:</label>
						<input type="text" class="form-control organisation" id="name" placeholder="Name">
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label for="addres"><i class="fas fa-map-marker-alt"  style="color:#07BCFC"></i> Address</label>
						<textarea rows="4" class="form-control website" id="address" placeholder="Address"></textarea>
					</div>
				</div>
				<div class="col-md-9">
					<div class="form-group">
						<div class="checkbox">
      						<label><input type="checkbox" value="" checked><b>GST Included</b></label>
    					</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<div class="checkbox">
							<label for="name"> <b>Total: 7500</b></label>
    					</div>
					</div>
				</div>
			</div>
        </div>
        <div class="modal-footer">
        
        <button type="button" class="btn btn-primary"><i class="far fa-copy"></i> Print Reciept</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="far fa-window-close"></i> Close</button>
          
        </div>
      </div>
      
    </div>
  </div>
<script type="text/javascript">
products=[]
var table = document.getElementById("item_table");
function reset(){
  event.preventDefault();
  document.getElementById('select2').value="";
}
document.getElementById("myAnchor").addEventListener("click", function(event){
  event.preventDefault()
});
function add_item(){
  event.preventDefault();
  
var sel = document.getElementById("select2");
if (sel.value==""){
  return 
}
var text= sel.options[sel.selectedIndex].text;
for(var i=0;i<products.length;i++){
  console.log(products.length);
  if(products[i][0]==text){
    alert('item already exits');
    return;
  }
}
  index=document.getElementById('select2').selectedIndex; 
  var table = document.getElementById("item_table");
var row = table.insertRow(products.length+1);
row.setAttribute('id',index);
var cell1 = row.insertCell(0);
var cell2 = row.insertCell(1);
var cell3 = row.insertCell(2);
var cell4=row.insertCell(3);
var cell5=row.insertCell(4);
cell1.innerHTML = text;
cell2.innerHTML = document.getElementById('select2').value;
cell3.innerHTML=document.getElementById('qty').value;
cell4.innerHTML=document.getElementById('total').innerHTML;
product=[];
product.push(text);
product.push(cell2.innerHTML);
product.push(cell3.innerHTML);
products.push(product);
button = document.createElement('button');
button.classList.add('btn','btn-danger');
button.innerHTML='<i class="fas fa-trash"></i> Delete';
button.onclick=function(){
  event.preventDefault();
  row=this.parentNode.parentNode;
  item=this.parentNode.parentNode.firstChild.innerHTML;
  if (products.length==1){
    products=[];
    table.deleteRow(1);
  }
  else{
    console.log(products);
  for(var j=0;j<products.length;j++){
    if (products[j][0]==item){
      products.splice(j,1);
      table.deleteRow(j+1);
    }
  }}
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
            '<span>' + state.text + '</span>'
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
