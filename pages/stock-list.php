<?php  
session_start();
include 'includes/func.inc.php';
include 'includes/constants.php';
include '../libraries/autoload.php';

if (!isset($_SERVER['HTTP_REFERER'])) {
  //exit('Unauthorized Access!');
}

$time = "Stock list report";

if (isset($_POST['searchBtn'])) {
    $from = $_POST['from'];
    $end = $_POST['to'];

    $time .= " from ".date("d-m-Y", strtotime($from))." to ".date("d-m-Y", strtotime($end));
} else {
    $time .= " as at ".date("D M d, Y");
}

$shop_id = $shop->get_id();
$data = $db->get_data('stock', 'edate');

?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../css/sb-admin.css">
    <link rel="stylesheet" href="css/print.css">
    <style>
        h4 {
            font-size: 18px !important;
        }

        h5 {
            font-size: 16px;
        }
    </style>
</head>

<body>
    <div class="clearfix p-0 px-3" style="background: #e9ecef">
        <form class="form-inline float-left" method="POST" action="">
            <div class="form-group">
                <label for="start">Start Date: </label>
                <input type="date" id="start" name="from" class="form-control mx-2">
            </div>
            <div class="form-group">
                <label for="end">End Date: </label>
                <input type="date" id="end" name="to" class="form-control mx-2">
            </div>
            <button class="btn btn-primary" name="searchBtn">Filter</button>
        </form>
        <button onclick="printReceipt()" class="float-right btn btn-primary">Print</button>
    </div>
   


    <div class="wrapper print-area" style="width: 100%">
        <div class="header" style="margin-bottom: 30px">
            <img src="http://localhost/abel2020/pages/img/logo3.png" alt="" style="width: 12%">
            <h4><?= strtoupper(COMPANY_FULL_NAME) ?></h4>
            <h5><?= $time  ?></h5>
        </div>
        <div class="body" style="padding-bottom: 50px">
            <table class="table">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Supplier</th>
                        <th>Batch No.</th>
                        <th>Category</th>
                        <th>Initial Quantity</th>
                        <th>Available Quantity</th>
                        <th>Expire Date</th>
                        <th>Entry Date</th>
                        <th>Remark</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($data): ?>
                        <?php foreach ($data as $row): ?>
                        <tr>
                            <td><?= $row->dname ?></td>
                            <td><?= $row->gname ?></td>
                            <td><?= $row->batch ?></td>
                            <td><?= $row->category ?></td>
                            <td><?= $row->initial_qty ?></td>
                            <td><?= $row->quantity ?></td>
                            <td><?= $row->exdate ?></td>
                            <td><?= $row->edate ?></td>
                            <td><?= $row->discr ?></td>
                        </tr>
                        <?php endforeach ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9" style="text-align: center">No records found at this time</td>
                            </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="../js/jquery.js"></script>
    <script src="js/printThis.js"></script>
    <script>
        //printReceipt();

        function printReceipt() {
            $(".print-area").printThis({
                importCSS: false,
                importStyle: true,
                loadCSS: "http://localhost/abel2020/pages/css/print.css"
            });
        }
    </script>
</body>

</html>