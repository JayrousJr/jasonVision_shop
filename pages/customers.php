<?php 
    include 'includes/guard.php';
    include 'includes/header.php';

    $shop_id = (isset($_GET['shop']) && $perms->is_admin()) ? $_GET['shop'] : false;
    $role = Session::get('role');

    #Update Customer
    if (isset($_POST['update_customer'])) {
      $data = array(
        'fname' => $_POST['fname'],
        'lname' => $_POST['lname'],
        'phone' => $_POST['phone'],
        'email' => $_POST['email'],
        'address' => $_POST['address'],
        'remark' => $_POST['remark']
      );

      if ($db->update('customers', $data, "id='".$_POST['hidden-id']."'")) {
        Session::flash('success', 'Customer updated successfuly!');
      }
    }

  #Fetch
  $data = $db->get_data('customers', 'created_at', $shop_id);
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
              <a href="#">Customers</a>
          </li>
        </ul>
        <div class="row">
          <div class="box col-md-12">
            <div class="box-inner">
              <div class="box-header well">
                <h2><i class="fa fa-bar-chart"></i> Customers</h2>

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
                    <?php endif ?>
                    <div class="other-actions">
                      <a href="#" data-toggle="modal" data-target="#customer" class="btn btn-default">
                        <i class="glyphicon glyphicon-plus"></i> Add
                      </a>
                    </div>
                </div>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-responsive table-sm datatable">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <?php if ($role != 'employee'): ?>
                      <th>Phone</th>
                      <th>Email</th>
                      <th>Address</th>
                      <?php endif ?>
                      <th>Created By</th>
                      <th>Date</th>
                      <?php if ($perms->is_admin_or_manager_or_accountant()): ?>
                      <th></th>
                      <?php endif ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if ($data): ?>
                      <?php foreach ($data as $row): ?>
                        <tr>
                          <td><?= $row->fname.' '.$row->lname ?></td>
                          <?php if ($role != 'employee'): ?>
                          <td><?= $row->phone ?></td>
                          <td><?= $row->email ?></td>
                          <td><?= $row->address ?></td>
                          <?php endif ?>
                          <td><?= $row->user ?></td>
                          <td><?= $row->created_at ?></td>
                          <?php if ($perms->is_admin_or_manager_or_accountant()): ?>
                          <td>
                            <div class="dropdown">
                              <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">   Choose <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                  <a href="#" onclick="update_customer(<?= $row->id ?>)">
                                    <i class="glyphicon glyphicon-edit"></i> Edit
                                  </a>
                                </li>
                                <li>
                                  <a href="includes/delete.inc.php?del=cust&id=<?=$row->id?>" onclick="return confirmDelete()">
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
<?php include 'includes/modals/customer.php'; ?>
<?php include 'includes/inc/footer.php' ?>
<script>
renderDataTable([0,1,2,3,4,5], <?= $role != 'employee' ? 5 : 2 ?>, "<?= $role; ?>");
async function update_customer(id) {
    var data = await get_update('customers', id);
    $("#fname").val(data.fname);
    $("#lname").val(data.lname);
    $("#phone").val(data.phone);
    $("#email").val(data.email);
    $("#address").val(data.address);
    $("#remark").val(data.remark);
    $("input[name='hidden-id']").val(id);

    $("#customer .modal-title").text("Update customer Record");
    $("#customer form").attr('action', "");
    $("button[name='save-customer-btn']").text("Update").attr('name', 'update_customer');
    $("#customer").modal('show');
  }
</script>