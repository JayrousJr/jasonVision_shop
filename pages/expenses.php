<?php 
    include 'includes/guard.php';
    include 'includes/header.php';

    #Update
    if (isset($_POST['update_expense'])) {
      $id = $_POST['hidden-id'];
      $data = array(
        'name' => $_POST['name'],
        'payment' => $_POST['method'],
        'paid' => $_POST['amount'],
        'descr' => $_POST['remark'],
        'date'=> $_POST['date']
      );

      if ($db->update('expense', $data, "id = '$id'")) {
        Session::flash('success', 'Expenses has been updated successfully!');
      } else {
        exit('Unexpected error');
      }
  }

  #Fetch
  $data = $db->get_data('expense', 'date');
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
              <a href="#">Expenses</a>
          </li>
        </ul>
        <div class="row">
          <div class="box col-md-12">
            <div class="box-inner">
              <div class="box-header well">
                <h2><i class="fa fa-bar-chart"></i> Expenses</h2>

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
                      <a href="#" data-toggle="modal" data-target="#expense" class="btn btn-default">
                        <i class="glyphicon glyphicon-plus"></i> Add Expense
                      </a>
                    </div>
                </div>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-responsive table-sm datatable">
                  <thead>
                    <tr>
                      <th>Title</th>
                      <th>Payment Method</th>
                      <th>Amount</th>
                      <th>Recorded By</th>
                      <th>Remark</th>
                      <th>Date</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if ($data): ?>
                      <?php foreach ($data as $row): ?>
                        <tr>
                          <td><?= $row->name ?></td>
                          <td><?= $row->payment ?></td>
                          <td><?= $row->paid ?></td>
                          <td><?= $row->user ?></td>
                          <td><?= $row->descr ?></td>
                          <td><?= $row->date ?></td>
                          <td>
                            <div class="dropdown">
                              <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
                                Choose <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                  <a href="#" onclick="update_expense(<?= $row->id; ?>)">
                                    <i class="glyphicon glyphicon-edit"></i> Edit
                                  </a>
                                </li>
                                <li>
                                  <a href="includes/delete.inc.php?del=expense&id=<?=$row->id?>" onclick="return confirmDelete()">
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
<?php include 'includes/modals/expense.php'; ?>
<?php include 'includes/inc/footer.php' ?>
<script>
  renderDataTable([0,1,2,3,4,5], 5);

  async function update_expense(id) {
    var data = await get_update('expense', id);
    $("#name").val(data.name);
    $("#method").val(data.payment);
    $("#amount").val(data.paid);
    $("#remark").val(data.descr);
    $("#date").val(data.date);
    $("input[name='hidden-id']").val(id);

    $("#expense .modal-title").text("Update expense Record");
    $("#expense form").attr('action', "");
    $("button[name='save-expense-btn']").text("Update").attr('name', 'update_expense');
    $("#expense").modal('show');
  }
</script>