<?php
include 'includes/guard.php';
include 'includes/header.php';
?>

<body>
    <!-- topbar starts -->
    <?php include 'includes/navbar.php' ?>
    <!-- topbar ends -->
    <div class="ch-container">
        <div class="row">

            <!-- left menu starts -->
            <div class="col-sm-2 col-lg-2">
                <?php include 'includes/side-navs.php' ?>
            </div>
            <!--/span-->
            <!-- left menu ends -->
            <div id="content" class="col-lg-10 col-sm-10">
                <!-- content starts -->
                <div class="row">
                    <div class="col-md-12">
                        <?php include 'includes/inc/breadcrumb.php'; ?>
                        <!-- CREATE INVOICE BOX FIELD -->
                        <div class="row">
                            <div class="box col-md-12" style="background-color:">
                                <div class="box-inner homepage-box" id="su">
                                    <div class="box-header well" data-original-title="">
                                        <h2><i class="glyphicon glyphicon-edit"></i> Create New Invoice</h2>
                                        <div class="box-icon">
                                            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                                    class="glyphicon glyphicon-chevron-up"></i></a>
                                            <a href="#" class="btn btn-close btn-round btn-default"><i
                                                    class="glyphicon glyphicon-remove"></i></a>
                                        </div>
                                    </div>
                                    <div class="box-content">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <div class="col-md-4 col-md-offset-4">
                                                        <label>Customer Name</label>
                                                        <input autofocus type="text"
                                                            class="form-control form-control-sm" id="custName" required>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label>LPO No.</label>
                                                        <input type="number" class="form-control form-control-sm"
                                                            id="lpo" required>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label>Transport Charge</label>
                                                        <input type="number" class="form-control form-control-sm"
                                                            id="charge">
                                                    </div>
                                                </div>
                                                <table class='table table-bordered'>
                                                    <thead>
                                                        <tr>
                                                            <th>Product Description</th>
                                                            <th>Quantity</th>
                                                            <th>Rate</th>
                                                            <th>Amount</th>
                                                            <th width="13%">#</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbody1">
                                                        <tr id="row_1">
                                                            <td style="text-align: left;" class="name">
                                                                <input type="text" class="form-control" name="name[]">
                                                            </td>
                                                            <td class="qty">
                                                                <input type="text" class="form-control" name="qty[]">
                                                            </td>
                                                            <td class="rate" data-row="row_1">
                                                                <input type="number" class="form-control" name="rate[]">
                                                            </td>
                                                            <td class="amt">
                                                                <input type="text" readonly class="form-control"
                                                                    name="amount[]">
                                                            </td>
                                                            <td><button style="display:none"
                                                                    class='btn btn-danger btn-xs remove'
                                                                    data-row='row_1'>- remove</button></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div align="right">
                                                    <button class="btn btn-primary btn-sm" id="add_row">+ add
                                                        row</button>
                                                    <button type="button" id="submit-inv"
                                                        class="btn btn-success btn-sm">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- CREATE INVOICE BOX END -->
                    </div>
                </div>
            </div>
            <!--/fluid-row-->
            <hr>
            <?php include 'includes/inc/footer.php' ?>