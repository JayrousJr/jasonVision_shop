<?php 
  include 'includes/guard.php';
  include 'includes/header.php';

  #Get Sales
  $type = isset($_GET['t']) ? $_GET['t'] : 'cash';
  $data = array();
  $role = Session::get('role');
  $shop_id = $role != 'employee' ? $_GET['shop'] : $shop->get_id();

  #Get By Shop
  if (isset($_GET['shop'])) {
    if ($role != 'employee') {
      $data = $db->get_all("sales","type = '$type' AND shop_id = '$shop_id'");
    }
    else {
      $start = date('Y-m-01');
      $end = date('Y-m-d');
      $data = $db->get_all('sales', "type='$type' AND sale_date BETWEEN '$start' AND '$end' AND shop_id = '".$shop_id."'");
    }
  }

  #Filter By date
  if (isset($_POST['searchBtn']) && $role != 'employee') {
    $start = $_POST['datefrom'];
    $end = $_POST['dateto']. ' 23:59:59.999';

    $data = $db->get_all('sales', "type='$type' AND sale_date BETWEEN '$start' AND '$end' AND shop_id = '".$shop_id."'");
  }

  #Update
  if (isset($_POST['update_sale'])) {
    $id = $_POST['hidden-id'];
    $data_update = array(
      'drug_name' => $_POST['name'],
      'quantity' => $_POST['quantity'],
      'price' => $_POST['price'],
      'type' => $_POST['type']
    );
    
    if ($db->update('sales', $data_update, "id='$id'")) {
      Session::flash('success', 'Sales record has been updated successfully!');
      Redirect::to($_SERVER['HTTP_REFERER']);
    }
  }

  #Get all shops
  $shops = $shop->get_all();
?>
<body>
<?php include 'includes/navbar.php' ?>
<div class="ch-container">
    <div class="row">
      <div class="col-sm-2 col-lg-2">
          <?php include 'includes/side-navs.php' ?>
      </div>
      <div id="content" class="col-lg-10 col-sm-10">
        <ul class="breadcrumb mb-0">
          <li>
              <a href="#">Home</a>
          </li>
          <li>
              <a href="#">Sales</a>
          </li>
        </ul>
        <div class="row">
          <div class="box col-md-12">
            <div class="box-inner">
              <div class="box-header well">
                <h2><i class="fa fa-bar-chart"></i> <?= ucfirst($type) ?> Sales Transactions</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
              </div>
              <div class="box-content">
                <?php if (Session::get('role') != 'employee'): ?>
                <div class="app-bar" style="display: flex; justify-content: space-between;">
                    <form class="form-inline" method="POST" action="?t=<?= $type ?>&shop=<?= $shop_id ?>">
                      <div class="form-group">
                        <label for="start">Start Date: </label>
                        <input type="date" id="start" name="datefrom" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="end">End Date: </label>
                        <input type="date" id="end" name="dateto" class="form-control">
                      </div>
                      <button class="btn btn-default" name="searchBtn">
                        <i class="glyphicon glyphicon-search"></i> Filter
                      </button>
                      <a href="?t=<?=$type?>&shop=<?= $shop_id ?>" class="btn btn-default">
                        <i class="fa fa-reorder"></i> Show All
                      </a>
                    </form>
                    <form class="form-inline" action="<?= $_SERVER['PHP_SELF'] ?>">
                      <input type="hidden" name="t" value="<?= $type ?>">
                      <div class="form-group">
                        <label for="shop">Shop: </label>
                        <select type="date" id="shop" name="shop" class="form-control">
                          <?php if ($shops): ?>
                            <?php foreach ($shops as $opt): ?>
                              <option value="<?= $opt->id ?>" <?= ($shop_id == $opt->id) ? 'selected' : '' ?>>
                                <?= $opt->address ?>
                              </option>
                            <?php endforeach ?>
                          <?php endif ?>
                        </select>
                      </div>
                      <button class="btn btn-default">
                        <i class="glyphicon glyphicon-search"></i> Select
                      </button>
                    </form>
                </div>
                <?php endif ?>
                <table class="table table-striped table-bordered table-sm datatable">
                  <thead>
                    <tr>
                      <th>Item Name</th>
                      <th>Type</th>
                      <th>Quantity</th>
                      <?php if (Session::get('role') != 'employee'): ?>
                      <th>Price</th>
                      <th>Total</th>
                      <?php endif ?>
                      <th>Seller</th>
                      <th>Date</th>
                      <?php if ($perms->is_admin()): ?>
                      <th></th>
                      <?php endif ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if ($data): ?>
                      <?php foreach ($data as $row): ?>
                        <tr>
                          <td><?= $row->drug_name ?></td>
                          <td><?= ucwords($row->type." sales"); ?></td>
                          <td><?= $row->quantity ?></td>
                          <?php if (Session::get('role') != 'employee'): ?>
                          <td><?= $row->price ?></td>
                          <td><?= number_format($row->price * $row->quantity) ?></td>
                          <?php endif ?>
                          <td><?= $row->soldby ?></td>
                          <td><?= split_time($row->sale_date)[0] ?></td>
                          <?php if ($perms->is_admin()): ?>
                          <td>
                            <a href="#" onclick="update_sale(<?= $row->id ?>)" class="btn btn-success btn-sm">
                              edit
                            </a>
                            <a href="includes/delete.inc.php?del=sale&id=<?=$row->id?>" class="btn btn-danger btn-sm" onclick="return confirmDelete()">delete</a>
                          </td>
                          <?php endif ?>
                        </tr>
                      <?php endforeach ?>
                    <?php endif ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <hr>
<?php include 'includes/modals/sales.php' ?>
<?php include 'includes/inc/footer.php' ?>
<script>
  renderDataTable([0,1,2,3,4,5,6], <?= $role != 'employee' ? 6 : 4 ?>, "<?= $role; ?>");

  async function update_sale(id) {
    var data = await get_update('sales', id);
    $("input[name='name']").val(data.drug_name);
    $("select[name='type']").val(data.type);
    $("input[name='quantity']").val(data.quantity);
    $("input[name='price']").val(data.price);
    $("input[name='hidden-id']").val(id);

    $("#sales").modal('show');
  }
</script>