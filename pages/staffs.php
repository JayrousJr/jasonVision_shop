<?php 
    include 'includes/guard.php';
    include 'includes/header.php';

    #Check if is user allowed to access this page
    if (!$perms->is_admin()) {
      Redirect::to('dashboard');
    }

    #Update
    if (isset($_POST['update_staff'])) {
      $data = array(
        'fname' => $_POST['fname'],
        'lname' => $_POST['lname'],
        'phone' => $_POST['phone'],
        'mail' => $_POST['email'],
        'gender' => $_POST['gender'],
        'status' => $_POST['role']
      );
      if ($db->update('managers', $data, "id='".$_POST['hidden-id']."'")) {
        Session::flash('success', 'Staff updated successfuly!');
      }
    }

    #Fetch Data
    $data = $db->get_data('managers', 'created_at');
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
              <a href="#">Staffs</a>
          </li>
        </ul>
        <div class="row">
          <div class="box col-md-12">
            <div class="box-inner">
              <div class="box-header well">
                <h2><i class="fa fa-bar-chart"></i> Staffs</h2>

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
                      <a href="#" data-toggle="modal" data-target="#staff" class="btn btn-default">
                        <i class="glyphicon glyphicon-plus"></i> Add Staff
                      </a>
                    </div>
                </div>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-responsive table-sm datatable">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Gender</th>
                      <th>Phone</th>
                      <th>Email</th>
                      <th>Position/Role</th>
                      <th>Created By</th>
                      <th>Date</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if ($data): ?>
                      <?php foreach ($data as $row): ?>
                        <tr>
                          <td><?= ucwords($row->fname.' '.$row->lname)?></td>
                          <td><?= ucfirst($row->gender) ?></td>
                          <td><?= $row->phone ?></td>
                          <td><?= strtolower($row->mail) ?></td>
                          <td><?= ucfirst($row->status) ?></td>
                          <td><?= ucwords($row->user) ?></td>
                          <td><?= $row->created_at ?></td>
                          <td>
                            <div class="dropdown">
                              <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">   Choose <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                  <a href="#" onclick="update_staff(<?= $row->id ?>)">
                                    <i class="glyphicon glyphicon-edit"></i> Edit
                                  </a>
                                </li>
                                <li>
                                  <a href="includes/delete.inc.php?del=staff&id=<?=$row->id?>" onclick="return confirmDelete()">
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
<?php include 'includes/modals/staff.php'; ?>
<?php include 'includes/inc/footer.php' ?>
<script>
renderDataTable([0,1,2,3,4,5,6])
async function update_staff(id) {
    var data = await get_update('managers', id);
    $("#fname").val(data.fname);
    $("#lname").val(data.lname);
    $("#phone").val(data.phone);
    $("#email").val(data.mail);
    $("#gender").val(data.gender);
    $("#role").val(data.status);
    $("input[name='hidden-id']").val(id);

    $("#staff .modal-title").text("Update Staff Record");
    $("#staff form").attr('action', "");
    $("button[name='save-staff-btn']").text("Update").attr('name', 'update_staff');
    $("#staff").modal('show');
  }
</script>