<?php 
    include 'includes/guard.php';
    include 'includes/header.php';

    #get Inputs
    function get_inputs() {
      return array(
        'datd' => $_POST['due-date'],
        'odate' => $_POST['exp-date'],
        'amnt' => $_POST['amount'],
        'reco' => $_POST['remark'],
        'dat' => date("Y-m-d"),
        'user' => $_SESSION['username']
      );
    }

    #Insert
    if (isset($_POST['save-prog-btn'])) {
      $data = get_inputs();

      if ($db->insert('prog', $data)) {
        Session::flash('success', 'Program has been saved successfully!');
      } else {
        Session::flash('error', 'Error during save!');
      }
    }

    #Update
    if (isset($_POST['update_prog'])) {
      $id = $_POST['hidden-id'];
      $update_data = get_inputs();
      if ($db->update('prog', $update_data, "id='$id'")) {
        Session::flash('success', 'Program has been updated successfully!');
      }
    }

    #Delete
    if (isset($_GET['del']) && $_GET['id']) {
      if ($db->delete('prog', array('id', '=', $_GET['id']))) {
        Session::flash('success', 'Program has been deleted successfully!');
        Redirect::to('programs');
      } else {
        Session::flash('error', 'Error during delete!');
      }
    }

    $data = $db->get_data('prog', 'dat');
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
              <a href="#">Programs</a>
          </li>
        </ul>
        <div class="row">
          <div class="box col-md-12">
            <div class="box-inner">
              <div class="box-header well">
                <h2><i class="fa fa-bar-chart"></i> Programs</h2>

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
                      <a href="#" data-toggle="modal" data-target="#program" class="btn btn-default">
                        <i class="glyphicon glyphicon-plus"></i> Add Program
                      </a>
                    </div>
                </div>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-responsive table-sm datatable">
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th>Due Date</th>
                      <th>Out Date</th>
                      <th>Amount</th>
                      <th>Recommendation</th>
                      <th>Recorded By</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if ($data): ?>
                      <?php foreach ($data as $row): ?>
                        <tr>
                          <td><?= $row->dat ?></td>
                          <td><?= $row->datd ?></td>
                          <td><?= $row->odate ?></td>
                          <td><?= $row->amnt ?></td>
                          <td><?= $row->reco ?></td>
                          <td><?= $row->user ?></td>
                          <td>
                            <div class="dropdown">
                              <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">   Choose <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                  <a href="#" onclick="update_prog(<?= $row->id ?>)">
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
<?php include 'includes/modals/program.php'; ?>
<?php include 'includes/inc/footer.php' ?>
<script>
  renderDataTable([0, 1, 3, 4, 5]);

  async function update_prog(id) {
    var data = await get_update('prog', id);
    $("input[name='due-date']").val(data.datd);
    $("input[name='exp-date']").val(data.odate);
    $("input[name='amount']").val(data.amnt);
    $("input[name='remark']").val(data.reco);
    $("input[name='hidden-id']").val(id);

    $("#program .modal-title").text("Update Program Record");
    $("button[name='save-prog-btn']").text("Update").attr('name', 'update_prog');
    $("#program").modal('show');
  }
</script>