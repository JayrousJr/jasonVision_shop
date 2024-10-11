<?php 
    include 'includes/guard.php';
    include 'includes/header.php';

    #get Inputs
    function get_inputs() {
      return array(
        'dat' => $_POST['date'],
        'sdate' => $_POST['due-date'],
        'exdate' => $_POST['exp-date'],
        'amount' => $_POST['amount'],
        'oname' => $_POST['name'],
        'user' => $_SESSION['username']
      );
    }

    #Insert
    if (isset($_POST['save-loan-btn'])) {
      $data = get_inputs();

      if ($db->insert('loan', $data)) {
        Session::flash('success', 'Loan has been saved successfully!');
      } else {
        Session::flash('error', 'Error during save!');
      }
    }

    #Update
    if (isset($_POST['update_loan'])) {
      $id = $_POST['hidden-id'];
      $update_data = get_inputs();
      if ($db->update('loan', $update_data, "id='$id'")) {
        Session::flash('success', 'Loan has been updated successfully!');
      }
    }

    #Delete
    if (isset($_GET['del']) && $_GET['id']) {
      if ($db->delete('loan', array('id', '=', $_GET['id']))) {
        Session::flash('success', 'Loan has been deleted successfully!');
        Redirect::to('loans');
      } else {
        Session::flash('error', 'Error during delete!');
      }
    }

    $data = $db->get_data('loan', 'dat');
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
              <a href="#">Loans</a>
          </li>
        </ul>
        <div class="row">
          <div class="box col-md-12">
            <div class="box-inner">
              <div class="box-header well">
                <h2><i class="fa fa-bar-chart"></i> Loans</h2>

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
                      <a href="#" data-toggle="modal" data-target="#loan" class="btn btn-default">
                        <i class="glyphicon glyphicon-plus"></i> Add Loan
                      </a>
                    </div>
                </div>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-responsive table-sm datatable">
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th>Name/Organization</th>
                      <th>Amount</th>
                      <th>Due Date</th>
                      <th>Expire Date</th>
                      <th>Recorded By</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if ($data): ?>
                      <?php foreach ($data as $row): ?>
                        <tr>
                          <td><?= $row->dat ?></td>
                          <td><?= $row->oname ?></td>
                          <td><?= $row->amount ?></td>
                          <td><?= $row->sdate ?></td>
                          <td><?= $row->exdate ?></td>
                          <td><?= $row->user ?></td>
                          <td>
                            <div class="dropdown">
                              <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Choose <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                  <a href="#" onclick="update_loan(<?= $row->id ?>)">
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
<?php include 'includes/modals/loan.php'; ?>
<?php include 'includes/inc/footer.php' ?>
<script>
  renderDataTable([0, 1, 3, 4, 5]);

  async function update_loan(id) {
    var data = await get_update('loan', id);
    $("input[name='due-date']").val(data.sdate);
    $("input[name='date']").val(data.dat);
    $("input[name='exp-date']").val(data.exdate);
    $("input[name='amount']").val(data.amount);
    $("input[name='name']").val(data.oname);
    $("input[name='hidden-id']").val(id);

    $("#loan .modal-title").text("Update Loan Record");
    $("button[name='save-loan-btn']").text("Update").attr('name', 'update_loan');
    $("#loan").modal('show');
  }
</script>