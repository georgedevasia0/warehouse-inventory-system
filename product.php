<?php
  $page_title = 'All Product';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
  $products = join_product_table();
?>
<?php include_once('layouts/header.php'); ?>
  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
        <div class="col-lg-3">
          <select class="form-control" id='select_cat' onchange='change_category()'>
          <optionvalue="None" >All</option>
          <?php
          $cats=array();
            foreach ($products as $product){

              if(!in_array($product['categorie'],$cats)){
                array_push($cats,$product['categorie']) ?>
                        <option value="<?php echo $product['categorie'] ?>">
                          <?php echo $product['categorie'] ?></option>
                      <?php }} ?>
          </select>
        </div>
         <div class="pull-right">
           <a href="add_product.php" class="btn btn-primary">Add New</a>
         </div>
        </div>
        <div class="panel-body">
          <table id='table' class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <!--
                  <th> Photo</th>
                  -->
                <th> Product Title </th>
                <th class="text-center" style="width: 10%;"> Type </th>
                <th class="text-center" style="width: 10%;"> Categorie </th>
                <th class="text-center" style="width: 10%;"> Instock </th>
                <th class="text-center" style="width: 10%;"> Buying Price </th>
                <th class="text-center" style="width: 10%;"> Saleing Price </th>
                <th class="text-center" style="width: 100px;"> Actions </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($products as $product):?>
              <tr class='rows'>
                <td class="text-center"><?php echo count_id();?></td>
                <!--
                <td>
                  <?php if($product['media_id'] === '0'): ?>
                    <img class="img-avatar img-circle" src="uploads/products/no_image.jpg" alt="">
                  <?php else: ?>
                  <img class="img-avatar img-circle" src="uploads/products/<?php echo $product['image']; ?>" alt="">
                <?php endif; ?>
                </td>
                -->
                <td> <?php echo remove_junk($product['name']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['type']); ?></td>
                <td class="text-center <?php echo remove_junk($product['categorie']); ?>"> <?php echo remove_junk($product['categorie']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['quantity']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['buy_price']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['sale_price']); ?></td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-info btn-xs"  title="Edit" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                    <a href="delete_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>
                  </div>
                </td>
              </tr>
             <?php endforeach; ?>
            </tbody>
          </tabel>
        </div>
      </div>
    </div>
  </div>
  <script>

  function change_category(){
    cat=document.getElementById('select_cat').value;
    if(cat=='None'){
    }
    var elements = document.querySelectorAll('.'+cat)
    var rows = document.querySelectorAll('.rows')
    i=0;
    l=rows.length;
    if(cat=='None'){ 
      for (i; i < l; i++) {
        rows[i].style.display = 'table-row';
      }
    }
    else{
      for (i; i < l; i++) {
      rows[i].style.display = 'none';
    }
    i = 0,
    l = elements.length;
    console.log(l)
    
    for (i; i < l; i++) {
    
        elements[i].parentNode.style.display = 'table-row';
      }
    }
  }
  </script>
  <?php include_once('layouts/footer.php'); ?>
