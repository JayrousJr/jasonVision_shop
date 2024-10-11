<?php
  include 'includes/guard.php';
  include 'includes/header.php';

  if (!$perms->is_admin_or_accountant()) {
    Redirect::to('dashboard');
  }

  if (isset($_POST['edit-date-btn'])) {
     $data = array(
      'inv_time' => $_POST['new-date']
     );
     if ($db->update('invoices', $data, "id=".$_POST['hidden-id'])) {
       Session::flash('success', 'Receipt Date has been updated successfully!');
     }
   }

  #Get Shop id
  $shop_id = (isset($_GET['shop']) && $perms->is_admin()) ? $_GET['shop'] : false;

  #Fetch
  $results = $db->get_data('invoices', 'inv_time', $shop_id);
?>

<body>
   <!-- topbar starts -->
     <?php include 'includes/navbar.php' ?>
    <!-- topbar ends -->
<div class="ch-container">
   <div class="row">

       <!-- left menu starts -->
        <div class="col-sm-2 col-lg-2">
            <?php include 'includes/side-navs.php'; ?>
        </div>
        <!--/span-->
        <!-- left menu ends -->
       <div id="content" class="col-lg-10 col-sm-10">
           <!-- content starts -->
           <div class="row">
    <div class="col-md-12">
      <?php include 'includes/inc/breadcrumb.php'; ?>
<!-- CREATE INVOICE BOX FIELD -->
      <div class="row">
        <div class="box col-md-12">
         <div class="box-inner homepage-box" id="su">
           <div class="box-header well" data-original-title="">
               <h2><i class="glyphicon glyphicon-edit"></i>Create New Invoice</h2>
               <div class="box-icon">
                   <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                   <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
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
              </div>
               <div class="row">
                 <div class="col-md-12">
                   <!-- FETCH INVOICES INFO -->
                   <table class="table table-bordered" id="inv-table">
                    <thead>
                      <tr>
                       <th>Customer Name</th>
                       <th>Invoice Number</th>
                       <th>Invoice generator</th>
                       <th>Created at</th>
                       <th width="20%"></th>
                     </tr>
                    </thead>
                    <tbody>
                      <?php if ($results): ?>
                        <?php foreach ($results as $data): ?>
                          <tr>
                            <td><?= $data->custName; ?></td>
                            <td><?= $data->inv_no ?></td>
                            <td><?= $data->inv_generator; ?></td>
                            <td><?= $data->inv_time; ?></td>
                            <td>
                              <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">   Choose <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                  <li>
                                     <a target="_blank" href="includes/print.php?get=preview&doc=invoice&file=<?= $data->inv_path; ?>"><i class="glyphicon glyphicon-eye-open"></i> Preview</a>
                                  </li>
                                  <li>
                                   <a href="includes/del_note.php?id=<?= $data->inv_no; ?>" target="_blank">
                                    <i class="glyphicon glyphicon-eye-open"></i> D. Note</a>
                                  </li>
                                  <?php if ($perms->is_admin()): ?>
                                  <li>
                                    <a href="#" onclick="editReceiptDate(<?= $data->id ?>)">
                                      <i class="glyphicon glyphicon-share"></i> Edit Date
                                    </a>
                                  </li>
                                  <li>
                                    <a href="#" onclick="delete_inv(<?= $data->id ?> ,'<?= $data->inv_path; ?>')">
                                      <i class="glyphicon glyphicon-trash"></i> Delete
                                    </a>
                                  </li>
                                 <?php endif ?>
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
      </div><!-- CREATE INVOICE BOX END -->
    </div>
  </div>
</div><!--/fluid-row-->
<hr>
<?php include 'includes/modals/edit-date.php' ?>
<?php include 'includes/inc/footer.php' ?>
<script>
  function editReceiptDate(id) {
    $("input[name='hidden-id']").val(id);
    $('#edit-date').modal('show');
  }
</script>