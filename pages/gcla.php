<?php 
    include 'includes/guard.php';
    include 'includes/header.php';

    #get Inputs
    function get_inputs() {
      return array(
        'dat' => $_POST['date'],
        'edate' => $_POST['due-date'],
        'exdate' => $_POST['exp-date'],
        'name' => $_POST['name'],
        'adr' => $_POST['address'],
        'mail' => $_POST['email'],
        'phn' => $_POST['phone'],
        'fname' => $_POST['cname'],
        'user' => $_SESSION['username']
      );
    }

    #Insert
    if (isset($_POST['save-gcla-btn'])) {
      $data = get_inputs();

      if ($db->insert('gcla', $data)) {
        Session::flash('success', 'GCLA record has been saved successfully!');
      } else {
        Session::flash('error', 'Error during save!');
      }
    }

    #Update
    if (isset($_POST['update_gcla'])) {
      $id = $_POST['hidden-id'];
      $update_data = get_inputs();
      if ($db->update('gcla', $update_data, "id='$id'")) {
        Session::flash('success', 'GCLA record has been updated successfully!');
      }
    }

    #Delete
    if (isset($_GET['del']) && $_GET['id']) {
      if ($db->delete('gcla', array('id', '=', $_GET['id']))) {
        Session::flash('success', 'GCLA record has been deleted successfully!');
        Redirect::to('gcla');
      } else {
        Session::flash('error', 'Error during delete!');
      }
    }

    $data = $db->get_data('gcla', 'dat');
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
              <a href="#">GCLA Records</a>
          </li>
        </ul>
        <div class="row">
          <div class="box col-md-12">
            <div class="box-inner">
              <div class="box-header well">
                <h2><i class="fa fa-bar-chart"></i> GCLA Records</h2>

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
                      <a href="#" data-toggle="modal" data-target="#gcla" class="btn btn-default">
                        <i class="glyphicon glyphicon-plus"></i> Add GCLA
                      </a>
                    </div>
                </div>
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-responsive table-sm datatable">
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th>Name</th>
                      <th>Entry Date</th>
                      <th>Expire Date</th>
                      <th>Address</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Company Name</th>
                      <th>Recorded By</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if ($data): ?>
                      <?php foreach ($data as $row): ?>
                        <tr>
                          <td><?= $row->dat ?></td>
                          <td><?= $row->name ?></td>
                          <td><?= $row->edate ?></td>
                          <td><?= $row->exdate ?></td>
                          <td><?= $row->adr ?></td>
                          <td><?= $row->mail ?></td>
                          <td><?= $row->phn ?></td>
                          <td><?= $row->fname ?></td>
                          <td><?= $row->user ?></td>
                          <td>
                            <div class="dropdown">
                              <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Choose <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                  <a href="#" onclick="update_gcla(<?= $row->id ?>)">
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
<?php include 'includes/modals/gcla.php'; ?>
<?php include 'includes/inc/footer.php' ?>
<script>
  renderDataTable([0, 1, 3, 4, 5]);

  async function update_gcla(id) {
    var data = await get_update('gcla', id);
    $("input[name='date']").val(data.dat);
    $("input[name='due-date']").val(data.edate);
    $("input[name='exp-date']").val(data.exdate);
    $("input[name='name']").val(data.name);
    $("input[name='cname']").val(data.fname);
    $("input[name='address']").val(data.adr);
    $("input[name='phone']").val(data.phn);
    $("input[name='email']").val(data.mail);
    $("input[name='hidden-id']").val(id);

    $("#gcla .modal-title").text("Update GCLA Record");
    $("button[name='save-gcla-btn']").text("Update").attr('name', 'update_gcla');
    $("#gcla").modal('show');
  }
</script>