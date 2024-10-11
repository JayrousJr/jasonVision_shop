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
          <ul class="breadcrumb mb-0">
          <li>
              <a href="pos">POS</a>
          </li>
          <li>
              <a href="#">Checkout</a>
          </li>
        </ul>

<!-- Page Contents -->
<div id="su" class="row mt-3">
  <div class="col-md-6">
    <h4>Shopping Cart Information</h4>
    <hr>
    <table class="table table-bordered table-hover table-sm">
        <thead>
          <tr>
            <th>Item Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th></th>
          </tr>
        </thead>
        <tbody id="cartTable">
          <!-- Mzigo wote hapa -->
        </tbody>
      </table>
    </table>
  </div>
  <div class="col-md-6">
    <h4>Customer Information</h4>
    <hr>
    <form action="server.php" method="post">
      <div class="form-group">
        <label for="name">Customer Name</label>
        <input type="text" id="name" name="name" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="phone">Phone number</label>
        <input type="text" id="phone" name="phone" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="address">Address</label>
        <input type="text" id="address" name="address" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="type">Sale Types</label>
        <select id="type" name="type" class="form-control" required>
          <option value="" hidden>Choose</option>
          <option value="cash">Cash Sales</option>
          <option value="credit">Credit Sales</option>
        </select>
      </div>
      <div class="form-group">
        <label for="">Discount(TZS)</label>
        <input type="number" class="form-control" name="discount">
      </div>
      <button name="checkout-btn" class="btn btn-primary checkout">Submit</button>
    </form>
  </div>
</div>
<hr>
<!-- Modals and Footer -->
<?php   include 'includes/inc/footer.php' ?>