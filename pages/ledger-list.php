<?php
  include 'includes/guard.php';
  include 'includes/header.php';

  if (!$perms->is_admin_or_accountant()) {
    header("Location: dashboard");
    exit();
  }

  if (isset($_POST['edit-date-btn'])) {
     $data = array(
      'r_date' => $_POST['new-date']
     );
     if ($db->update('ledgers', $data, "id=".$_POST['hidden-id'])) {
       Session::flash('success', 'Receipt Date has been updated successfully!');
     }
   }

  #Get Shop id
  $shop_id = (isset($_GET['shop']) && $perms->is_admin()) ? $_GET['shop'] : false;

  #Fetch
  $data = $db->get_data('ledgers', 'r_date', $shop_id);
?>

<body>
   <!-- topbar starts -->
     <?php include 'includes/navbar.php' ?>
    <!-- topbar ends -->
<div class="ch-container">
   <div class="row">

    <!-- LEFT SIDE NAVS -->
    <div class="col-sm-2 col-lg-2">
      <?php include 'includes/side-navs.php' ?>
    </div>
<div id="content" class="col-lg-10 col-sm-10">
  <!-- content starts -->
  <div class="row">
    <div class="col-md-12">
      <?php include 'includes/inc/breadcrumb.php'; ?>      
<!-- CREATE INVOICE BOX FIELD -->
<div class="row">
  <div class="box col-md-12" style="background-color:">
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
                 <th>#</th>
                 <th>Ledger Generator</th>
                 <th>Created at</th>
                 <th width="20%"></th>
               </tr>
             </thead>
             <tbody>
              <?php if ($data): ?>
                <?php foreach ($data as $row): ?>
                  <tr>
                    <td><?= $row->id; ?></td>
                    <td><?= $row->author; ?></td>
                    <td>
                      <?php
                        $date = split_time($row->r_date);
                        echo $date[0]." at ".$date[1];
                      ?>
                  </td>
                    <td>
                      <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">   Choose <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right">
                          <li>
                             <a target="_blank" href="includes/print.php?get=preview&doc=invoice&file=<?= $row->l_path; ?>"><i class="glyphicon glyphicon-eye-open"></i> Preview</a>
                          </li>
                          <?php if ($perms->is_admin()): ?>
                          <li>
                            <a href="#" onclick="editReceiptDate(<?= $row->id ?>)">
                              <i class="glyphicon glyphicon-share"></i> Edit Date
                            </a>
                          </li>
                          <li>
                            <a href="includes/delete.inc.php?action=delete_ledg&id=<?= $row->id ?>&file=<?= $row->l_path; ?>" onclick="return confirmDelete()">
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
</div>
<!-- CREATE INVOICE BOX END -->

      </div>
</div>
<div class=" row">

</div>







</div><!--/fluid-row-->


   <!-- Ad ends -->


<hr>
<?php include 'includes/modals/edit-date.php' ?>
<?php include 'includes/inc/footer.php' ?>
<script>
  function editReceiptDate(id) {
    $("input[name='hidden-id']").val(id);
    $('#edit-date').modal('show');
  }
</script>
