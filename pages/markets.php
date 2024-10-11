<?php 
  include 'includes/guard.php';
  include 'includes/header.php';

  $shop_id = (isset($_GET['shop']) && $perms->is_admin()) ? $_GET['shop'] : false;

  #Get Data
  function get_inputs() {
    global $shop;
    return array(
      'shop_id' => $shop->get_id(),
      'name' => $_POST['name'],
      'phone' => $_POST['phone'],
      'date' => $_POST['date'],
      'remark' => $_POST['remark'],
      'user' => $_SESSION['username']
    );
  }

  #Insert
  if (isset($_POST['save-market-btn'])) {
    $data = get_inputs(); 
    if ($db->insert('market', $data)) {
      Session::flash('success', 'Market record is successfully saved!');
    }
  }

  #Delete
  if (isset($_GET['del']) && isset($_GET['id'])) {
    if ($db->delete('market', $_GET['id'])) {
      Session::flash('success', 'Market record deleted successfully!');
      Redirect::to('markets');
    }
  }

  #Update
  if (isset($_POST['update_market'])) {
    $data = get_inputs();
    $id = $_POST['hidden-id'];
    if ($db->update('market', $data, "id='$id'")) {
      Session::flash('success', 'Market record is successfully updated!');
    }
  }

  $data = $db->get_data('market', 'date', $shop_id);
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
              <a href="#">Market Records</a>
          </li>
        </ul>
        <div class="row">
          <div class="box col-md-12">
            <div class="box-inner">
              <div class="box-header well">
                <h2><i class="fa fa-bar-chart"></i> Market Records</h2>

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
                      <a href="#" data-toggle="modal" data-target="#market" class="btn btn-default">
                        <i class="glyphicon glyphicon-plus"></i> Add <?= $perms->is_admin() ? '' : 'Record' ?>
                      </a>
                    </div>
                </div>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-responsive table-sm datatable">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Phone</th>
                      <th>Descripton</th>
                      <th>Date</th>
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
                          <td><?= $row->name ?></td>
                          <td><?= $row->phone ?></td>
                          <td><?= $row->remark ?></td>
                          <td><?= $row->date ?></td>
                          <td><?= $row->user ?></td>
                          <?php if ($perms->is_admin()): ?>
                          <td>
                            <div class="dropdown">
                              <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">   Choose <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                  <a href="#" onclick="update_market(<?= $row->id ?>)">
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
<?php include 'includes/modals/market.php'; ?>
<?php include 'includes/inc/footer.php' ?>
<script>
  renderDataTable([0, 1, 3, 4]);

  async function update_market(id) {
    var data = await get_update('market', id);
    $("input[name='name']").val(data.name);
    $("input[name='phone']").val(data.phone);
    $("input[name='date']").val(data.date);
    $("textarea[name='remark']").val(data.remark);
    $("input[name='hidden-id']").val(id);

    $("#market .modal-title").text("Update Market Record");
    $("#market .form").attr('action', '');
    $("button[name='save-market-btn']").text("Update").attr('name', 'update_market');
    $("#market").modal('show');
  }
</script>