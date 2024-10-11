<?php 
    include 'includes/guard.php';
    include 'includes/header.php';

    #get Inputs
    function get_inputs() {
      return array(
        'dat' => $_POST['date'],
        'amount' => $_POST['amount'],
        'category' => $_POST['category'],
        'user' => $_SESSION['username']
      );
    }

    #Insert
    if (isset($_POST['save-revenue-btn'])) {
      $data = get_inputs();

      if ($db->insert('tra', $data)) {
        Session::flash('success', 'Revenue has been saved successfully!');
      } else {
        Session::flash('error', 'Error during save!');
      }
    }

    #Update
    if (isset($_POST['update_revenue'])) {
      $id = $_POST['hidden-id'];
      $update_data = get_inputs();
      if ($db->update('tra', $update_data, "id ='$id'")) {
        Session::flash('success', 'Revenue has been updated successfully!');
      }
    }

    #Delete
    if (isset($_GET['del']) && $_GET['id']) {
      if ($db->delete('tra', array('id', '=', $_GET['id']))) {
        Session::flash('success', 'Revenue has been deleted successfully!');
        Redirect::to('revenues');
      } else {
        Session::flash('error', 'Error during delete!');
      }
    }

    $data = $db->get_data('tra', 'dat');
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
              <a href="#">TRA-Revenues</a>
          </li>
        </ul>
        <div class="row">
          <div class="box col-md-12">
            <div class="box-inner">
              <div class="box-header well">
                <h2><i class="fa fa-bar-chart"></i> TRA-Revenues</h2>

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
                      <a href="#" data-toggle="modal" data-target="#revenue" class="btn btn-default">
                        <i class="glyphicon glyphicon-plus"></i> Add Revenue
                      </a>
                    </div>
                </div>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-responsive table-sm datatable">
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th>Ammount</th>
                      <th>Category</th>
                      <th>Recorded By</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if ($data): ?>
                      <?php foreach ($data as $row): ?>
                        <tr>
                          <td><?= $row->dat ?></td>
                          <td><?= number_format($row->amount) ?></td>
                          <td><?= $row->category ?></td>
                          <td><?= $row->user ?></td>
                          <td>
                            <div class="dropdown">
                              <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">   Choose <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                  <a href="#" onclick="update_revenue(<?= $row->id ?>)">
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
<?php include 'includes/modals/revenue.php'; ?>
<?php include 'includes/inc/footer.php' ?>
<script>
  renderDataTable([0, 1, 2, 3]);

   async function update_revenue(id) {
    var data = await get_update('tra', id);
    $("input[name='date']").val(data.dat);
    $("input[name='amount']").val(data.amount);
    $("select[name='category']").val(data.category);
    $("input[name='hidden-id']").val(id);

    $("#revenue .modal-title").text("Update Revenue Record");
    $("button[name='save-revenue-btn']").text("Update").attr('name', 'update_revenue');
    $("#revenue").modal('show');
  }
</script>