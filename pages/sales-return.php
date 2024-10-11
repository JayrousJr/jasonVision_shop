<?php 
    include 'includes/guard.php';
    include 'includes/header.php';

    $shop_id = (isset($_GET['shop']) && $perms->is_admin()) ? $_GET['shop'] : false;

    function get_inputs() {
      global $shop;
      return array(
        'shop_id' => $shop->get_id(),
        'date' => $_POST['date'],
        'particular' => $_POST['particular'],
        'debit_note' => $_POST['note-no'],
        'qty' => $_POST['qty'],
        'status' => $_POST['status'],
        'amount' => $_POST['amount'],
        'created_by' => $_SESSION['username']
      );
    }

    if (isset($_POST['save-return-btn'])) {
        $data = get_inputs();

        if ($db->insert('sales_return', $data)) {
          Session::flash('success', "Sales return saved");
        }
    }

    #Update
    if (isset($_POST['update_return'])) {
        $data = get_inputs();

        if ($db->update('sales_return', $data, "id='".$_POST['hidden-id']."'")) {
          Session::flash('success', "Sales return updated");
        }
    }

    $data = $db->get_data('sales_return', 'date', $shop_id);
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
              <a href="#">Sales Returns</a>
          </li>
        </ul>
        <div class="row">
          <div class="box col-md-12">
            <div class="box-inner">
              <div class="box-header well">
                <h2><i class="fa fa-bar-chart"></i> Sales Returns</h2>

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
                      <a href="#" data-toggle="modal" data-target="#sale-return" class="btn btn-default">
                        <i class="glyphicon glyphicon-plus"></i> Add <?= $perms->is_admin() ? '' : 'Return' ?>
                      </a>
                    </div>
                </div>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-responsive table-sm datatable">
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th>Particular</th>
                      <th>Debit Note No.</th>
                      <th>LF/Quantities</th>
                      <th>Details</th>
                      <th>Amount</th>
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
                          <td><?= $row->date ?></td>
                          <td><?= $row->particular ?></td>
                          <td><?= $row->debit_note ?></td>
                          <td><?= $row->qty ?></td>
                          <td><?= $row->status ?></td>
                          <td><?= $row->amount ?></td>
                          <td><?= $row->created_by ?></td>
                          <?php if ($perms->is_admin()): ?>
                          <td>
                            <div class="dropdown">
                              <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
                                Choose <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                  <a href="#" onclick="update_return(<?= $row->id ?>)">
                                    <i class="glyphicon glyphicon-edit"></i> Edit
                                  </a>
                                </li>
                                <li>
                                  <a href="includes/delete.inc.php?del=s_ret&id=<?=$row->id?>" onclick="return confirmDelete()">
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
<?php include 'includes/modals/sale_return.php'; ?>
<?php include 'includes/inc/footer.php' ?>
<script>
  renderDataTable([0,1,2,3,4,5,6]);
  async function update_return(id) {
    var data = await get_update('sales_return', id);
    $("#date").val(data.date);
    $("#particular").val(data.particular);
    $("#note-no").val(data.debit_note);
    $("#qty").val(data.qty);
    $("#status").val(data.status);
    $("#amount").val(data.amount);
    $("input[name='hidden-id']").val(id);

    $("#sale-return .modal-title").text("Update return Record");
    $("#sale-return form").attr('action', "");
    $("button[name='save-return-btn']").text("Update").attr('name', 'update_return');
    $("#sale-return").modal('show');
  }
</script>