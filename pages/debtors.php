<?php 

  include 'includes/guard.php';
  include 'includes/header.php';

  $shop_id = (isset($_GET['shop']) && $perms->is_admin()) ? $_GET['shop'] : false;

  #Get Data
  function get_inputs() {
    global $shop;
    return array(
      'shop_id' => $shop->get_id(),
      'fname' => $_POST['fname'],
      'lname' => $_POST['lname'],
      'phone' => $_POST['phone'],
      'address' => $_POST['address'],
      'city' => $_POST['city'],
      'country' => $_POST['country'],
      'codate' => $_POST['codate'],
      'exdate' => $_POST['exdate'],
      'amount' => $_POST['amount'],
      'user' => Session::get('username')
    );
  }

  #Insert
  if (isset($_POST['save-debtor-btn'])) {
    $data = get_inputs(); 
    if ($db->insert('debtors', $data)) {
      Session::flash('success', 'Debtor record is successfully saved!');
    }
  }

  #Delete
  if (isset($_GET['del']) && isset($_GET['id'])) {
    if ($db->delete('debtors', $_GET['id'])) {
      Session::flash('success', 'Debtor record deleted successfully!');
      Redirect::to('debtors');
    }
  }

  #Update
  if (isset($_POST['update_debtor'])) {
    $data = get_inputs();
    $id = $_POST['hidden-id'];
    if ($db->update('debtors', $data, "id='$id'")) {
      Session::flash('success', 'Debtor record is successfully updated!');
    }
  }

  $data = $db->get_data('debtors', 'codate', $shop_id);
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
              <a href="#">Debtors</a>
          </li>
        </ul>
        <div class="row">
          <div class="box col-md-12">
            <div class="box-inner">
              <div class="box-header well">
                <h2><i class="fa fa-bar-chart"></i> Debtors</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
              </div>
              <div class="box-content">
                <div class="app-bar justify-between">
                    <?php include 'includes/inc/filter-form.php' ?>
                    <?php if ($perms->is_admin()): ?>
                    <form class="form-inline" action="<?= $_SERVER['PHP_SELF'] ?>">
                      <div class="form-group">
                        <label for="shop">Shop: </label>
                        <select type="date" id="shop" name="shop" class="form-control">
                          <?php if ($shop->get_all()): ?>
                            <?php foreach ($shop->get_all() as $opt): ?>
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
                    <?php endif ?>
                    <div class="other-actions">
                      <a href="#" data-toggle="modal" data-target="#debtor" class="btn btn-default">
                        <i class="glyphicon glyphicon-plus"></i> Add <?= $perms->is_admin() ? '' : 'Debtor'?>
                      </a>
                    </div>
                </div>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-responsive table-sm datatable">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Address</th>
                      <th>Amount</th>
                      <th>Compliance Date</th>
                      <th>End Date</th>
                      <th>Recorded By</th>
                      <?php if ($perms->is_admin()): ?>
                      <th></th>
                      <?php endif ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if ($data): ?>
                      <?php foreach ($data as $row): ?>
                        <tr>
                          <td><?= ucwords($row->fname.' '.$row->lname) ?></td>
                          <td><?= ucwords($row->address.' '.$row->city.', '.$row->country) ?></td>
                          <td><?= number_format($row->amount) ?></td>
                          <td><?= $row->codate ?></td>
                          <td><?= $row->exdate ?></td>
                          <td><?= ucwords($row->user) ?></td>
                          <?php if ($perms->is_admin()): ?>
                          <td>
                            <div class="dropdown">
                              <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
                                Choose <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                  <a href="#" onclick="update_debtor(<?=$row->id?>)">
                                    <i class="glyphicon glyphicon-edit"></i> Edit
                                  </a>
                                </li>
                                <li>
                                  <a href="?del&id=<?=$row->id?>" onclick="return confirmDelete()">
                                    <i class="glyphicon glyphicon-trash"></i> Delete
                                  </a>
                                </li>
                              </ul>
                            </div>
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
    </div>
  <hr>
<?php include 'includes/modals/debtor.php'; ?>
<?php include 'includes/inc/footer.php' ?>
<script>
  renderDataTable([0, 1, 3, 4, 5]);

  async function update_debtor(id) {
    var data = await get_update('debtors', id);
    $("#fname").val(data.fname);
    $("#lname").val(data.lname);
    $("#phone").val(data.phone);
    $("#codate").val(data.codate);
    $("#exdate").val(data.exdate);
    $("#address").val(data.address);
    $("#city").val(data.city);
    $("#country").val(data.country);
    $("#amount").val(data.amount);

    $("input[name='hidden-id']").val(id);

    $("#debtor .modal-title").text("Update Debtor Record");
    $("#debtor .form").attr('action', '');
    $("button[name='save-debtor-btn']").text("Update").attr('name', 'update_debtor');
    $("#debtor").modal('show');
  }
</script>