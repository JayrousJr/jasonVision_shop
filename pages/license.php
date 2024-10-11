<?php 
    include 'includes/guard.php';
    include 'includes/header.php';

    #get Inputs
    function get_inputs() {
      return array(
        'daty' => $_POST['due-date'],
        'datz' => $_POST['exp-date'],
        'amount' => $_POST['amount'],
        'category' => $_POST['category'],
        'dat' => date("Y-m-d"),
        'user' => $_SESSION['username']
      );
    }

    #Insert
    if (isset($_POST['save-license-btn'])) {
      $data = get_inputs();

      if ($db->insert('license', $data)) {
        Session::flash('success', 'License has been saved successfully!');
      } else {
        Session::flash('error', 'Error during save!');
      }
    }

    #Update
    if (isset($_POST['update_license'])) {
      $id = $_POST['hidden-id'];
      $update_data = get_inputs();
      if ($db->update('license', $update_data, "id ='$id'")) {
        Session::flash('success', 'License has been updated successfully!');
      }
    }

    #Delete
    if (isset($_GET['del']) && $_GET['id']) {
      if ($db->delete('license', array('id', '=', $_GET['id']))) {
        Session::flash('success', 'License has been deleted successfully!');
        Redirect::to('license');
      } else {
        Session::flash('error', 'Error during delete!');
      }
    }

    $data = $db->get_data('license', 'dat');
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
              <a href="#">Licenses</a>
          </li>
        </ul>
        <div class="row">
          <div class="box col-md-12">
            <div class="box-inner">
              <div class="box-header well">
                <h2><i class="fa fa-bar-chart"></i> Licenses</h2>

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
                      <a href="#" data-toggle="modal" data-target="#license" class="btn btn-default">
                        <i class="glyphicon glyphicon-plus"></i> Add License
                      </a>
                    </div>
                </div>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-responsive table-sm datatable">
                  <thead>
                    <tr>
                      <th>Due Date</th>
                      <th>Expire Date</th>
                      <th>Ammount</th>
                      <th>Category</th>
                      <th>Recorded By</th>
                      <th>Date</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if ($data): ?>
                      <?php foreach ($data as $row): ?>
                        <tr>
                          <td><?= $row->daty ?></td>
                          <td><?= $row->datz ?></td>
                          <td><?= number_format($row->amount) ?></td>
                          <td><?= $row->category ?></td>
                          <td><?= $row->user ?></td>
                          <td><?= $row->dat ?></td>
                          <td>
                            <div class="dropdown">
                              <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">   Choose <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                  <a href="#" onclick="update_license(<?= $row->id ?>)">
                                    <i class="glyphicon glyphicon-edit"></i> Edit
                                  </a>
                                </li>
                                <li>
                                  <a href="?del=&id=<?=$row->id?>" onclick="return confirmDelete()">
                                    <i class="glyphicon glyphicon-trash"></i> Delete
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </td>
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
<?php include 'includes/modals/license.php'; ?>
<?php include 'includes/inc/footer.php' ?>
<script>
  renderDataTable([0, 1, 2, 3, 4, 5]);

   async function update_license(id) {
    var data = await get_update('license', id);
    $("input[name='due-date']").val(data.daty);
    $("input[name='exp-date']").val(data.datz);
    $("input[name='amount']").val(data.amount);
    $("select[name='category']").val(data.category);
    $("input[name='hidden-id']").val(id);

    $("#license .modal-title").text("Update License Record");
    $("button[name='save-license-btn']").text("Update").attr('name', 'update_license');
    $("#license").modal('show');
  }
</script>