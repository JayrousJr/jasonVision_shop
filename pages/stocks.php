<?php 
    include 'includes/guard.php';
    include 'includes/header.php';

    $shop_id = isset($_GET['shop']) ? $_GET['shop'] : "";

    #Check if is user allowed to access this page
    if (!$perms->is_admin()) {
      Redirect::to('dashboard');
    }

    function get_inputs($shop) {
      return array(
        'shop_id' => $shop,
        'dname' => $_POST['name'],
        'gname' => $_POST['supplier'],
        'batch' => $_POST['batch'],
        'category' => $_POST['category'],
        'dosage' => $_POST['phone'],
        'initial_qty' => $_POST['qty'],
        'quantity' => $_POST['qty'],
        'edate' => $_POST['en-date'],
        'mdate' => $_POST['man-date'],
        'exdate' => $_POST['ex-date'],
        'bprice' => $_POST['cost'],
        'sprice' => $_POST['price'],
        'mprice' => $_POST['manufact'],
        'discr' => $_POST['remark'],
        'contry' => $_POST['country'],
        'user' => $_SESSION['username']
      );
    }

    #Insert Data
    if (isset($_POST['save-stock-btn'])) {
      $user_shop = $perms->is_admin() ? $_POST['shop'] : $db->get_user_shop();
      $data = get_inputs($user_shop);
      if ($db->insert('stock', $data)) {
        Session::flash('success', 'Stock added successfuly!');
      }
    }

    #Updates
    if (isset($_POST['update_stock'])) {
      $user_shop = $perms->is_admin() ? $_POST['shop'] : $db->get_user_shop();
      $data = get_inputs($user_shop);
      if ($db->update('stock', $data, "id='".$_POST['hidden-id']."'")) {
        Session::flash('success', 'Stock updated successfuly!');
      }
    }

    #Fetch Data
    $data = $db->get_data('stock', 'edate');
    $shops = $db->get_all('shops');

    #Get By Shop
    if (isset($_GET['shop'])) {
      $data = $db->get_all('stock', array('shop_id', $shop_id));
    }
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
                        <a href="#">Stocks</a>
                    </li>
                </ul>
                <div class="row">
                    <div class="box col-md-12">
                        <div class="box-inner">
                            <div class="box-header well">
                                <h2><i class="fa fa-bar-chart"></i> Stocks</h2>

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
                                    <form class="form-inline" action="<?= $_SERVER['PHP_SELF'] ?>">
                                        <div class="form-group">
                                            <label for="shop">Shop: </label>
                                            <select type="date" id="shop" name="shop" class="form-control">
                                                <?php if ($shops): ?>
                                                <?php foreach ($shops as $opt): ?>
                                                <option value="<?= $opt->id ?>"
                                                    <?= (isset($_GET['shop']) && $_GET['shop'] == $opt->id) ? 'selected' : '' ?>>
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
                                    <a href="#" data-toggle="modal" data-target="#stock" class="btn btn-default">
                                        <i class="glyphicon glyphicon-plus"></i> Add Stock
                                    </a>
                                </div>
                                <div class="table-responsive">
                                    <table
                                        class="table table-striped table-bordered table-responsive table-sm datatable">
                                        <thead>
                                            <tr>
                                                <th>Item</th>
                                                <th>Supplier</th>
                                                <th>Batch No.</th>
                                                <th>Category</th>
                                                <th>Initial Quantity</th>
                                                <th>Available Quantity</th>
                                                <th>Expire Date</th>
                                                <th>Entry Date</th>
                                                <th>Remark</th>
                                                <?php if ($perms->is_director()): ?>
                                                <th></th>
                                                <?php endif ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($data): ?>
                                            <?php foreach ($data as $row): ?>
                                            <tr>
                                                <td><?= $row->dname ?></td>
                                                <td><?= $row->gname ?></td>
                                                <td><?= $row->batch ?></td>
                                                <td><?= $row->category ?></td>
                                                <td><?= $row->initial_qty ?></td>
                                                <td><?= $row->quantity ?></td>
                                                <td><?= $row->exdate ?></td>
                                                <td><?= $row->edate ?></td>
                                                <td><?= $row->discr ?></td>
                                                <?php if ($perms->is_director()): ?>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-default dropdown-toggle" type="button"
                                                            data-toggle="dropdown"> Choose <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li>
                                                                <a href="#" onclick="update_stock(<?= $row->id ?>)">
                                                                    <i class="glyphicon glyphicon-edit"></i> Edit
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="includes/delete.inc.php?del=stock&id=<?=$row->id?>"
                                                                    class="text-danger"
                                                                    onclick="return confirmDelete()">
                                                                    <i class="glyphicon glyphicon-trash"></i> Delete
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                                <?php endif ?>
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
        <?php include 'includes/modals/stock.php' ?>
        <?php include 'includes/inc/footer.php' ?>
        <script>
        renderDataTable([0, 1, 2, 3, 4, 5, 6, 7]);

        async function update_stock(id) {
            var data = await get_update('stock', id);

            $("#name").val(data.dname);
            $("#supplier").val(data.gname);
            $("#batch").val(data.batch);
            $("#category").val(data.category);
            $("#phone").val(data.dosage);
            $("#qty").val(data.quantity);
            $("#en-date").val(data.edate);
            $("#man-date").val(data.mdate);
            $("#ex-date").val(data.exdate);
            $("#cost").val(data.bprice);
            $("#price").val(data.sprice);
            $("#manufact").val(data.mprice);
            $("#remark").val(data.discr);
            $("#country").val(data.contry);
            $("#shop-id").val(data.shop_id);
            $("input[name='hidden-id']").val(id);

            $("#stock .modal-title").text("Update Stock Record");
            $("#stock form").attr('action', "");
            $("button[name='save-stock-btn']").text("Update").attr('name', 'update_stock');
            $("#stock").modal('show');
        }
        </script>