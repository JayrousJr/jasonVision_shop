<?php 
  include 'includes/guard.php';
  include 'includes/header.php';

  #Check if is user allowed to access this page
  if (!$perms->is_admin()) {
    Redirect::to('dashboard');
  }

  #Dispose
  if (isset($_POST['save-disposal-btn'])) {
    $id = $_POST['asset_id'];
    $data = array(
      'asset_id' => $id,
      'shop_id' => $shop->get_id(),
      'disposed_price' => $_POST['disp-price'],
      'disposed_date' => $_POST['date'],
      'remark' => $_POST['remark'],
      'created_by' => $_SESSION['username']
    );

    if ($db->insert('disposal', $data)) {
      $update_data = array(
        'status' => 'disposed'
      );
      if ($db->update('asset', $update_data, "id = '$id'")) {
          Session::flash('success', 'Asset has been disposed successfully!');
      } else {
        Session::flash('error', 'Error during disposed asset!');
      }
    } else {
      Session::flash('error', 'Error during disposed asset!');
    }
  }

  #Edit Assets
  if (isset($_POST['update_asset'])) {
    $id = $_POST['hidden-id'];
    $data = array(
      'codi' => $_POST['code'],
      'locat' => $_POST['location'],
      'aname' => $_POST['name'],
      'dname' => $_POST['remark'],
      'pdate' => $_POST['date'],
      'price' => $_POST['price'],
      'category' => $_POST['category'],
      'dname' => $_POST['remark']
    );

    if ($db->update('asset', $data, "id = '$id'")) {
      Session::flash('success', 'Asset has been updated successfully!');
    } else {
      echo 'error';
    }
  }

  #Fetch
  $data = $db->get_all('asset', "status = 'active' AND shop_id = '".$shop->get_id()."'");
  if (isset($_POST['searchBtn'])) {
    $where = "status = 'active' AND shop_id = '".$shop->get_id()."' AND pdate BETWEEN '".$_POST['from']."' AND '".$_POST['to']."'";
    $data = $db->get_all('asset', $where);
  }
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
              <a href="dashboard">Home</a>
          </li>
          <li>
              <a href="#">Assets</a>
          </li>
        </ul>
        <div class="row">
          <div class="box col-md-12">
            <div class="box-inner">
              <div class="box-header well">
                <h2><i class="fa fa-bar-chart"></i> Assets</h2>

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
                    <div class="other-actions">
                      <a href="#" data-toggle="modal" data-target="#asset" class="btn btn-default">
                        <i class="glyphicon glyphicon-plus"></i> Add Asset
                      </a>
                    </div>
                </div>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-responsive table-sm datatable">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Code</th>
                      <th>Category</th>
                      <th>Location</th>
                      <th>Current Price</th>
                      <th>Date</th>
                      <th>Remark</th>
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
                          <td><?= $row->aname ?></td>
                          <td><?= $row->codi ?></td>
                          <td><?= $row->category ?></td>
                          <td><?= $row->locat ?></td>
                          <td><?= $row->price ?></td>
                          <td><?= $row->pdate ?></td>
                          <td><?= $row->dname ?></td>
                          <td><?= $row->user ?></td>
                          <?php if ($perms->is_admin()): ?>
                          <td>
                            <div class="dropdown">
                              <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">   Choose <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                  <a href="#" onclick="update_asset(<?= $row->id ?>)">
                                    <i class="glyphicon glyphicon-edit"></i> Edit
                                  </a>
                                </li>
                                <li>
                                  <a href="#" onclick="dispose(<?=$row->id?>)">
                                    <i class="glyphicon glyphicon-share"></i> Dispose
                                  </a>
                                </li>
                                <li>
                                  <a href="includes/delete.inc.php?del=asset&id=<?=$row->id?>" onclick="return confirmDelete()">
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
<?php include 'includes/modals/asset.php'; ?>
<?php include 'includes/inc/footer.php' ?>
<script>
  renderDataTable([0, 1, 3, 4, 5, 6, 7], 5);

  async function update_asset(id) {
    var data = await get_update('asset', id);
    $("#code").val(data.codi);
    $("#name").val(data.aname);
    $("#location").val(data.locat);
    $("#date").val(data.pdate);
    $("#price").val(data.price);
    $("#category").val(data.category);
    $("#remark").val(data.dname);
    $("input[name='hidden-id']").val(id);

    $("#asset .modal-title").text("Update Asset Record");
    $("#asset form").attr('action', "");
    $("button[name='save-asset-btn']").text("Update").attr('name', 'update_asset');
    $("#asset").modal('show');
  }

  function dispose(id) {
    $('input[name="asset_id"]').val(id);
    $('#dispose').modal('show');
  }
</script>