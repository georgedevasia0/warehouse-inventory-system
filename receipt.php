<!DOCTYPE html>
<html lang="en">
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
                                    <a>
                                    Arboshiki
                                    </a>
                                </h2>
                                <div>455 Foggy Heights, AZ 85004, US</div>
                                <div>(123) 456-789</div>
                                <p>company@example.com</p>
                            </div>
                        </div>
                    </header>
                    <main>
                        <div class="row contacts">
                            <div class="col invoice-to">
                                <div class="text-gray-light">INVOICE TO:</div>
                                <h2 class="to">John Doe</h2>
                                <div class="address">796 Silver Harbour, TX 79273, US</div>
                                <div class="email">john@example.com</div>
                            </div>
                            <div class="col invoice-details">
                                <h1 class="invoice-id">Receipt 3-2-1</h1>
                                <div class="date">Invoice No: 254258</div>
                                <div class="date">Date of Invoice: 01/10/2018</div>
                                <div class="date">Due Date: 30/10/2018</div>
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
                                <tr>
                                    <td>04</td>
                                    <td class="text-left">
                                        American Watches
                                    </td>
                                    <td class="unit">$0.00</td>
                                    <td class="qty">100</td>
                                    <td class="text-right">$0.00</td>
                                </tr>
                                <tr>
                                    <td>01</td>
                                    <td class="text-left">FastTrack</td>
                                    <td class="unit">$40.00</td>
                                    <td class="qty">30</td>
                                    <td class="text-right">$1,200.00</td>
                                </tr>
                                <tr>
                                    <td>02</td>
                                    <td class="text-left">Titan</td>
                                    <td class="unit">$40.00</td>
                                    <td class="qty">80</td>
                                    <td class="text-right">$3,200.00</td>
                                </tr>
                                <tr>
                                    <td>03</td>
                                    <td class="text-left">Normal</td>
                                    <td class="unit">$40.00</td>
                                    <td class="qty">20</td>
                                    <td class="text-right">$800.00</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2"></td>
                                    <td colspan="2">SUBTOTAL</td>
                                    <td>$5,200.00</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td colspan="2">TAX 25%</td>
                                    <td>$1,300.00</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td colspan="2">GRAND TOTAL</td>
                                    <td>$6,500.00</td>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>