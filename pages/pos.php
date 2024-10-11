<?php 
  include 'includes/guard.php';
  include 'includes/header.php';
?>

<body id="gu">
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
          <div class="col-md-12" >
              <ul class="breadcrumb">
                <li>
                    <a href="#">Home</a>
                </li>
                <li>
                    <a href="#">Point of Sales</a>
                </li>
            </ul>
            </div>
        </div>

<!-- Page Contents -->
<div id="su" class="row">
  <div class="col-md-6">
    <input type="search" class="form-control mb-3" onkeyup="search()" id="search" autocomplete="off" placeholder="Type to Filter...">
    <table class="table table-bordered table-hover">
      <thead>
        <tr >
            <th>Item Name</th>
            <th>Category</th>
            <th>Price (Tsh)</th>
            <th>Stock</th>
            <th></th>
        </tr>
      </thead>
      <tbody id="tbody">
        <!-- Mzigo wote hapa... -->
      </tbody>
    </table>
  </div>
  <div class="col-md-6">
    <table class="table table-bordered table-hover table-sm">
        <thead>
          <tr>
            <th>Item Name</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Total</th>
            <th></th>
          </tr>
        </thead>
        <tbody id="cartTable">
          <!-- Mzigo wote hapa -->
        </tbody>
      </table>
      <a href="checkout.php" class="btn btn-primary btn-sm pull-right checkout">
        <span class="glyphicon glyphicon-ok"></span> Checkout
      </a>
  </div>
</div>
<hr>
<!-- Modals and Footer -->
<?php include 'includes/modals/pos.php' ?>
<?php include 'includes/inc/footer.php' ?>