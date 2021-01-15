<!DOCTYPE html>
<html lang="en">
<?php
$address=$_GET['address'];
$name=$_GET['name'];
$items=$_GET['items'];
$items=json_decode($items);
$discount_percentage=(int)$_GET['d'];
$final_amount=(int)$_GET['final'];
$final_with_discount=$final_amount-($final_amount*$discount_percentage/100);
$gst_amount=$final_with_discount*18/100;
$final_with_gst=$final_with_discount-$gst_amount;
//$final_with_gst=(int)$final_with_gst;
?>  
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="libs/css/invoice.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script><title>Receipt</title>
</head>
<body>
    <div class="container">
        <div id="invoice">
        
            <div class="invoice overflow-auto">
            
                <div style="min-width: 600px">
                
                    <header>
                    
                        <div class="row">
                            <div class="col">
                     
                                    <img src="libs/images/foxlogo2.png" style="height:50px;"/>
                     
                                   
                            </div>

                            <div class="col company-details">
                                <h2 class="name">
                                                      
<button onclick=print()>Print</button>
                                    <a>
                                   Praveen Watch Works
                                    </a>
                                </h2>
                                <div>Kumta Karnataka</div>
                                <div>8547469319</div>
                                <p>meetmeashwin@gmail.com</p>
                            </div>
                        </div>
                    </header>
                    <main>
                        <div class="row contacts">
                            <div class="col invoice-to">
                                <div class="text-gray-light">INVOICE TO:</div>
                                <h2 class="to"><?php echo $name ?></h2>
                                <div class="address"><?php echo $address ?></div>
                                
                            </div>
                            <div class="col invoice-details">
                                <h1 class="invoice-id">Receipt 3-2-1</h1>
                                <div class="date">Date of Invoice: <?php echo date('d/m/Y')?></div>
                                
                            </div>
                        </div>
                        <table cellspacing="0" cellpadding="0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th class="text-left">DESCRIPTION</th>
                                    <th class="text-right">PRICE</th>
                                    <th class="text-right">QUANTITY</th>
                                    <th class="text-right">TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $index=1;
                            foreach($items as $item){
                                echo "<tr>
                                <td>$index</td>
                                <td class='text-left'>
                                    $item[0]
                                </td>
                                <td class='unit'>$item[1]</td>
                                <td class='qty'>$item[2]</td>
                                <td class='text-right'>$item[3]</td>
                            </tr>";
                            $index++;
                            }
                            ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2"></td>
                                    <td colspan="2">SUBTOTAL</td>
                                    <td><?php echo $final_amount ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td colspan="2">DISCOUNT <?php echo $discount_percentage ?>%</td>
                                    <td><?php echo -$final_with_discount ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td colspan="2">GST 18%</td>
                                    <td><?php echo +$gst_amount ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td colspan="2">GRAND TOTAL</td>
                                    <td><?php echo $final_with_gst ?></td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="thanks">Thank you!</div>
                        <div class="notices">
                            <div class="pl-3">NOTICE:</div>
                            <div  class="pl-3">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                        </div>
                    </main>
                    <footer>
                        Invoice was created on a computer and is valid without the signature and seal.
                    </footer>
                </div>
                <div></div>
            </div>
        </div>
    </div>
<script>
function print(){

    window.print();
}
</script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>