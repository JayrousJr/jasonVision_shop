<?php
include 'includes/guard.php';
// HEADER
include 'includes/header.php';
$table = strtolower($_GET['type']) . '_receipt';

#Get Shop id
$shop_id = (isset($_GET['shop']) && $perms->is_admin()) ? $_GET['shop'] : $shop->get_id();
$type = isset($_GET['type']) ? $_GET['type'] : 'cash';
$role = Session::get('role');

#Update Date
if (isset($_POST['edit-date-btn'])) {
  $data = array(
    'rec_date' => $_POST['new-date']
  );
  if ($db->update($table, $data, "id=" . $_POST['hidden-id'])) {
    Session::flash('success', 'Receipt Date has been updated successfully!');
  }
}

#Delete Receipts
if (isset($_GET['del']) && $_GET['id']) {
  if ($db->delete($table, array('id', '=', $_GET['id']))) {
    Session::flash('success', 'Receipt record has been deleted successfully!');
    Redirect::to('receipts?type=' . $_GET['type']);
  } else {
    Session::flash('error', 'Error during delete!');
  }
}


// FETCH DATA
if ($role != 'employee') {
  $results = $db->get_data($table, 'rec_date', $shop_id);
} else {
  $start = date('Y-m-01');
  $end = date('Y-m-d') . ' 23:59:59.999';
  $results = $db->get_all($table, "rec_date BETWEEN '$start' AND '$end' AND shop_id = '" . $shop_id . "'");
}

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
                        <ul class="breadcrumb mb-0">
                            <li>
                                <a href="dashboard">Home</a>
                            </li>
                            <li>
                                <a href="#">Point of Sales</a>
                            </li>
                        </ul>
                        <!-- CREATE INVOICE BOX FIELD -->
                        <div class="row">
                            <div class="box col-md-12">
                                <div class="box-inner homepage-box">
                                    <div class="box-header well" data-original-title="">
                                        <h2>
                                            <i class="glyphicon glyphicon-edit"></i>
                                            <?= ucfirst($type) ?> Sales Receipts
                                        </h2>
                                        <div class="box-icon">
                                            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                                    class="glyphicon glyphicon-chevron-up"></i></a>
                                            <a href="#" class="btn btn-close btn-round btn-default"><i
                                                    class="glyphicon glyphicon-remove"></i></a>
                                        </div>
                                    </div>
                                    <div class="box-content">
                                        <?php if ($role != 'employee') : ?>
                                        <div class="app-bar justify-between">
                                            <?php include 'includes/inc/filter-form.php' ?>
                                            <?php if ($perms->is_admin()) : ?>
                                            <form class="form-inline" action="<?= $_SERVER['PHP_SELF'] ?>">
                                                <input type="hidden" name="type" value="<?= $type ?>">
                                                <div class="form-group">
                                                    <label for="shop">Shop: </label>
                                                    <select type="date" id="shop" name="shop" class="form-control">
                                                        <?php if ($shop->get_all()) : ?>
                                                        <?php foreach ($shop->get_all() as $opt) : ?>
                                                        <option value="<?= $opt->id ?>"
                                                            <?= ($shop_id == $opt->id) ? 'selected' : '' ?>>
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
                                        <?php endif ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <!-- FETCH INVOICES INFO -->
                                                <table class="table table-bordered" id="inv-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Customer Name</th>
                                                            <th>Phone</th>
                                                            <th>Address</th>
                                                            <th>Receipt Number</th>
                                                            <th>Sold By</th>
                                                            <th>Created at</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if ($results) : ?>
                                                        <?php foreach ($results as $data) : ?>
                                                        <tr>
                                                            <td><?= $data->customer_name; ?></td>
                                                            <td><?= $data->phone; ?></td>
                                                            <td><?= $data->address; ?></td>
                                                            <td class="text-center"><?= inv_display($data->rec_no) ?>
                                                            </td>
                                                            <td><?= ucfirst($data->soldby); ?></td>
                                                            <td><?= split_time($data->rec_date)[0]; ?></td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <button class="btn btn-default dropdown-toggle"
                                                                        type="button" data-toggle="dropdown"> Choose
                                                                        <span class="caret"></span>
                                                                    </button>
                                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                                        <li>
                                                                            <a href="receipt?preview&type=<?= $_GET['type'] ?>&id=<?= $data->rec_no ?>"
                                                                                target="_blank">
                                                                                <i
                                                                                    class="glyphicon glyphicon-eye-open"></i>
                                                                                Preview
                                                                            </a>
                                                                        </li>
                                                                        <?php if ($perms->is_admin()) : ?>
                                                                        <li>
                                                                            <a href="#"
                                                                                onclick="editReceiptDate(<?= $data->id ?>)">
                                                                                <i
                                                                                    class="glyphicon glyphicon-share"></i>
                                                                                Edit Date
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="?type=<?= $_GET['type'] ?>&del&id=<?= $data->id ?>"
                                                                                onclick="return confirmDelete()">
                                                                                <i
                                                                                    class="glyphicon glyphicon-trash"></i>
                                                                                Delete
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
            </div>
        </div>
    </div>
    </div>
    <!-- CREATE INVOICE BOX END -->

    </div>
    </div>
    <?php include 'includes/modals/edit-date.php' ?>
    <?php include 'includes/inc/footer.php' ?>
    <script>
    function editReceiptDate(id) {
        $("input[name='hidden-id']").val(id);
        $('#edit-date').modal('show');
    }
    </script>