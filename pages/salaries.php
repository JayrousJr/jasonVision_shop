<?php 
   include 'includes/guard.php';
   include 'includes/header.php';

   #Insert Salary
   if (isset($_POST['save-salary-btn'])) {
      $salary = $_POST['salary'];
      $tax = 0;
      $nssf = $salary * 0.1;

      // Find out Tax Rate
      if ($salary <= 170000) {
        $tax = 0;
      }elseif ($salary <= 360000) {
        $tax = $salary * 0.09;
      }elseif ($salary <= 540000) {
        $tax = $salary * 0.2;
      }elseif ($salary <= 720000) {
        $tax = $salary * 0.25;
      }else{
        $tax = $salary * 0.3;
      }

      $netSalary = $salary - $nssf - $tax;

      $insert_data = array(
        'dati' => $_POST['date'],
        'namea' => $_POST['fname'],
        'nameb' => $_POST['mname'],
        'namec' => $_POST['lname'],
        'position' => $_POST['position'],
        'g_salary' => $salary,
        'vat' => $tax,
        'nssf' => $nssf,
        'mshahara' => $netSalary,
        'user' => $_SESSION['username']
      );
      
      if ($db->insert('salary', $insert_data)) {
        Session::flash('success', 'Salary saved successfully!');
      }
   }

  #Update
    if (isset($_POST['update_salary'])) {
      $update_data = array(
        'dati' => $_POST['date'],
        'namea' => $_POST['fname'],
        'nameb' => $_POST['mname'],
        'namec' => $_POST['lname'],
        'position' => $_POST['position'],
        'g_salary' => $_POST['salary']
      );

      if ($db->update('salary', $update_data, "id='".$_POST['hidden-id']."'")) {
        Session::flash('success', 'Salary updated successfully!');
      }
  }

  #Fetch
  $data = $db->get_data('salary', 'dati');

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
              <a href="#">Salaries</a>
          </li>
        </ul>
        <div class="row">
          <div class="box col-md-12">
            <div class="box-inner">
              <div class="box-header well">
                <h2><i class="fa fa-bar-chart"></i> Salaries</h2>

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
                      <a href="#" data-toggle="modal" data-target="#salary" class="btn btn-default">
                        <i class="glyphicon glyphicon-plus"></i> Add Salary
                      </a>
                    </div>
                </div>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-responsive table-sm datatable">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Position</th>
                      <th class="text-center">Gross Salary</th>
                      <th class="text-center">NSSF</th>
                      <th class="text-center">VAT</th>
                      <th class="text-center">Net Salary</th>
                      <th class="text-center">Payment Date</th>
                      <th>Recorded By</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if ($data): ?>
                      <?php foreach ($data as $row): ?>
                        <tr>
                          <td><?= ucwords($row->namea.' '.$row->nameb.' '.$row->namec) ?></td>
                          <td><?= ucfirst($row->position) ?></td>
                          <td class="text-right"><?= number_format($row->g_salary, 2) ?></td>
                          <td class="text-right"><?= number_format($row->nssf, 2) ?></td>
                          <td class="text-right"><?= number_format($row->vat, 2) ?></td>
                          <td class="text-right"><?= number_format($row->mshahara, 2) ?></td>
                          <td class="text-center"><?= $row->dati ?></td>
                          <td><?= $row->user ?></td>
                          <td>
                            <div class="dropdown">
                              <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
                                Choose <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                  <a href="#" onclick="update_salary(<?=$row->id?>)">
                                    <i class="glyphicon glyphicon-edit"></i> Edit
                                  </a>
                                </li>
                                <li>
                                  <a href="includes/delete.inc.php?del=salary&id=<?=$row->id?>" onclick="return confirmDelete()">
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
<?php include 'includes/modals/salary.php'; ?>
<?php include 'includes/inc/footer.php' ?>
<script>
  renderDataTable([0,1,2,3,4,5,6,7], 6)
  async function update_salary(id) {
    var data = await get_update('salary', id);
    $("#fname").val(data.namea);
    $("#mname").val(data.nameb);
    $("#lname").val(data.namec);
    $("#position").val(data.position.trim());
    $("#g-salary").val(data.g_salary);
    $("#date").val(data.dati);
    $("input[name='hidden-id']").val(id);

    $("#salary .modal-title").text("Update Salary Record");
    $("button[name='save-salary-btn']").text("Update").attr('name', 'update_salary');
    $("#salary").modal('show');
  }
</script>