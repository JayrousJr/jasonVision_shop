<?php 
    include 'includes/guard.php';
    include 'includes/header.php';

    #Check if is user allowed to access this page
    if (!$perms->is_admin()) {
      Redirect::to('dashboard');
    }

    #Update
    if (isset($_POST['update_dispose'])) {
      $data = array(
        'disposed_price' => $_POST['disp-price'],
        'disposed_date' => $_POST['date'],
        'remark' => $_POST['remark']
      );

      if ($db->update('disposal', $data, "id='".$_POST['hidden-id']."'")) {
        Session::flash('success', 'Disposed updated successfully!');
      }
    }

    #Delete
    if (isset($_GET['del']) && $_GET['id']) {
      if ($db->delete('disposal', array('id', '=', $_GET['id']))) {
        Session::flash('success', 'Disposed item deleted successfully!');
        Redirect::to('disposals');
      } else {
        Session::flash('error', 'Error during delete!');
      }
    }

    $data = $db->query("SELECT * FROM asset a JOIN disposal d ON a.id = d.asset_id WHERE d.shop_id = '".$shop->get_id()."'");
    if (isset($_POST['searchBtn'])) {
      $where = "shop_id = '".$shop->get_id()."' AND ddate BETWEEN '".$_POST['from']."' AND '".$_POST['to']."'";
      $data = $db->get_all('disposal', $where);
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
              <a href="#">Disposed Assets</a>
          </li>
        </ul>
        <div class="row">
          <div class="box col-md-12">
            <div class="box-inner">
              <div class="box-header well">
                <h2><i class="fa fa-bar-chart"></i> Disposed Assets</h2>

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
                      <a href="assets" class="btn btn-default">
                        <i class="glyphicon glyphicon-plus"></i> Add Disposed Item
                      </a>
                    </div>
                </div>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-responsive table-sm datatable">
                  <thead>
                    <tr>
                      <th>Asset Name</th>
                      <th>Code</th>
                      <th>Purchases Date</th>
                      <th>Location</th>
                      <th>Cost</th>
                      <th>Disposed Price</th>
                      <th>Recorded By</th>
                      <?php if ($perms->is_admin()): ?>
                      <th>Actions</th>
                      <?php endif ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if ($data): ?>
                      <?php foreach ($data as $row): ?>
                        <tr>
                          <td><?= $row->aname ?></td>
                          <td><?= $row->codi ?></td>
                          <td><?= $row->pdate ?></td>
                          <td><?= $row->locat ?></td>
                          <td><?= $row->price ?></td>
                          <td><?= $row->disposed_price ?></td>
                          <td><?= $row->created_by ?></td>
                          <?php if ($perms->is_admin()): ?>
                          <td>
                            <div class="dropdown">
                              <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
                                Choose <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                  <a href="#" onclick="update_disposal(<?=$row->id?>)">
                                    <i class="glyphicon glyphicon-edit"></i> Edit
                                  </a>
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
<?php include 'includes/modals/asset.php' ?>
<?php include 'includes/inc/footer.php' ?>
<script>
  renderDataTable([0,1,2,3,4,5,6]);
   async function update_disposal(id) {
    var data = await get_update('disposal', id);
    $("#disp-price").val(data.disposed_price);
    $("#disp-date").val(data.disposed_date);
    $("#disp-remark").val(data.remark);
    $("input[name='hidden-id']").val(id);

    $("#dispose .modal-title").text("Update Disposal Record");
    $("button[name='save-disposal-btn']").text("Update").attr('name', 'update_dispose');
    $("#dispose").modal('show');
  }
</script>