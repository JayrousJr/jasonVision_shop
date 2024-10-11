<?php 
    include 'includes/guard.php';
    include '../includes/mp_auth.php';
    include 'includes/header.php';

    #Check if is user allowed to access this page
    if (!$perms->is_admin()) {
      Redirect::to('dashboard');
    }

   #Insert Shop
   if (isset($_POST['add-shop'])) {
      $data = array(
         'address' => $_POST['address'], 
         'contact' => $_POST['contact']
      );

      if ($db->insert('shops', $data)) {
         Session::flash('success', 'Shop added successfuly!');
      }
   }

   #Update User
   if (isset($_POST['update-user-btn'])) {
     $id = $_POST['hidden-id'];

     $data = array(
         'first_name' => $_POST['fname'], 
         'last_name' => $_POST['lname'], 
         'username' => $_POST['username'],
         'email' => $_POST['email'],
         'shop_id' => $_POST['shop'],
         'role' => $_POST['role']
      );

      if ($db->update('auth_users', $data, "id='$id'")) {
         Session::flash('success', 'User infomation updated successfuly!');
      }
   }

   #Update Shop
   if (isset($_POST['update-shop'])) {
     $id = $_POST['shop-hidden-id'];
     $data = array(
         'address' => $_POST['address'], 
         'contact' => $_POST['contact']
      );

      if ($db->update('shops', $data, "id='$id'")) {
         Session::flash('success', 'Shop updated successfuly!');
      } else {
        exit("Unexpected Error");
      }
   }

   #Initialize Data
   $shops = $db->get_all('shops');
?>
<body>
<?php include 'includes/navbar.php' ?>
<div class="ch-container">
    <div class="row">
        <div class="col-sm-2 col-lg-2">
            <?php include 'includes/side-navs.php' ?>
        </div>
        <div id="content" class="col-lg-10 col-sm-10">
            <?php include 'includes/inc/breadcrumb.php'; ?>
            <div class="row">
                <div class="box col-md-12">
                    <div align="right">
                        <button class="btn btn-primary mb-2" data-toggle="modal" data-target="#register">
                            <i class="glyphicon glyphicon-plus"></i> Add New User
                        </button>
                    </div>
                    <div class="box-inner">
                        <div class="box-header well" data-original-title="">
                            <h2><i class="glyphicon glyphicon-user"></i> Manage Users</h2>

                            <div class="box-icon">
                                <a href="#" class="btn btn-setting btn-round btn-default"><i
                                        class="glyphicon glyphicon-cog"></i></a>
                                <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                        class="glyphicon glyphicon-chevron-up"></i></a>
                                <a href="#" class="btn btn-close btn-round btn-default"><i
                                        class="glyphicon glyphicon-remove"></i></a>
                            </div>
                        </div>
                        <div class="box-content">
                            <ul class="nav nav-tabs" id="myTab">
                                <li><a href="#users" data-toggle="tab">Manage users</a></li>
                                <li><a href="#shops" data-toggle="tab">Manage Shops</a></li>
                            </ul>

                            <div id="myTabContent" class="tab-content">
                                <div class="tab-pane" id="users">
                                    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Shop</th>
                                                <th>Date registered</th>
                                                <th>Role</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (get_users()): ?>
                                                <?php foreach (get_users() as $user): ?>
                                                    <tr>
                                                        <td><?= $user['first_name'].' '.$user['last_name'] ?></td>
                                                        <td><?= $user['username'] ?></td>
                                                        <td><?= $user['email'] ?></td>
                                                        <td><?= $db->get_shop($user['shop_id']) ?></td>
                                                        <td><?= $user['date_created'] ?></td>
                                                        <td><?= ucfirst($user['role']) ?></td>
                                                        <td>
                                                            <?php if ($user['status'] == 0): ?>
                                                                <span class="label-danger label label-default">
                                                                Banned</span>
                                                            <?php elseif ($user['status'] == 1): ?>
                                                                <span class="label-success label label-default">
                                                                Active</span>
                                                            <?php endif ?>
                                                        </td>
                                                        <td class="center">
                                                            <a class="btn btn-info btn-sm" href="#" onclick="update_user(<?= $user['id']; ?>)">
                                                                <i class="glyphicon glyphicon-edit icon-white"></i>
                                                                Edit
                                                            </a>
                                                            <?php if ($user['status'] == 1): ?>
                                                              <a class="btn btn-warning btn-sm" href="../includes/auth.php?ban=true&id=<?=$user['id']?>" onclick="return confirm('Are you sure you want to ban this user?')">
                                                                <i class="glyphicon glyphicon-ban-circle icon-white"></i>
                                                                Ban
                                                              </a> 
                                                            <?php else: ?>
                                                              <a class="btn btn-success btn-sm" href="../includes/auth.php?ban=false&id=<?=$user['id']?>">
                                                                <i class="glyphicon glyphicon-ok-circle icon-white"></i>
                                                                Unban
                                                              </a> 
                                                            <?php endif ?>
                                                            
                                                            <a class="btn btn-danger btn-sm" href="includes/delete.inc.php?del=user&id=<?= $user['id'] ?>" onclick="return confirmDelete()">
                                                                <i class="glyphicon glyphicon-trash icon-white"></i>
                                                                Delete
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                        </tbody>
                                    </table> 
                                </div>
                                <div class="tab-pane" id="shops">
                                    <div class="app-bar justify-between">
                                       <form class="form-inline shop-form" method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
                                          <div class="form-group">
                                             <input type="text" name="address" id="shop-address" placeholder="Address" class="form-control" required>
                                          </div>
                                          <div class="form-group">
                                             <input type="text" name="contact" id="shop-contact" placeholder="Contact" class="form-control" required>
                                          </div>
                                          <input type="hidden" name="shop-hidden-id"> 
                                          <button class="btn btn-default" name="add-shop" style="width: 100px">
                                            <i class="glyphicon glyphicon-ok-circle"></i> Add
                                          </button>
                                       </form>
                                    </div>
                                    <table class="table table-striped table-bordered table-sm responsive">
                                       <thead>
                                          <tr>
                                             <th>Address</th>
                                             <th>Contact</th>
                                             <th>Date</th>
                                             <th></th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <?php if ($shops): ?>
                                             <?php foreach ($shops as $shop): ?>
                                                <tr>
                                                   <td><?= $shop->address; ?></td>
                                                   <td><?= $shop->contact; ?></td>
                                                   <td><?= $shop->created_at; ?></td>
                                                   <td class="text-center">
                                                      <a href="#" onclick="update_shop(<?= $shop->id ?>)" class="btn btn-success btn-sm">
                                                        <i class="glyphicon glyphicon-edit"></i> edit
                                                      </a>
                                                      <a href="includes/delete.inc.php?del=shop&id=<?= $shop->id ?>" class="btn btn-danger btn-sm" onclick="return confirmDelete()">
                                                         <i class="glyphicon glyphicon-trash"></i> delete
                                                      </a>
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
    </div>
    <hr>

    <!-- Register Modal -->
    <div class="modal fade" id="register" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Register new user</h4>
          </div>
          <div class="modal-body pl-4">
            <form id="user-form" action="../includes/auth.php" method="post" enctype="multipart/form-data">
                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="fname">First Name</label>
                        <input type="text" name="fname" id="fname" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label for="lname">Last Name</label>
                        <input type="text" name="lname" id="lname" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label for="shop">Shop</label>
                        <select name="shop" id="shop" class="form-control">
                           <?php if ($shops): ?>
                              <?php foreach ($shops as $shop): ?>
                                 <option value="<?= $shop->id ?>"><?= $shop->address; ?></option>
                              <?php endforeach ?>
                           <?php endif ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="role">Role</label>
                        <select name="role" class="form-control" id="role">
                            <option value="director">Director</option>
                            <option value="asst_director">Assist Director</option>
                            <option value="manager">Manager</option>
                            <option value="employee">Employee</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4 hidden-field">
                        <label for="image">Profile Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label for="confirm">Confirm Password</label>
                        <input type="password" name="confirm" id="confirm" class="form-control" required>
                    </div>
                </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="hidden-id" id="hidden-id">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="regBtn">Register</button>
            </form>
          </div>
        </div>
      </div>
    </div>
<?php include 'includes/inc/footer.php' ?>
<script>
   $(document).ready(function(){
      $('a[data-toggle="tab"').on('show.bs.tab', function(e){
         localStorage.setItem('activeTab', $(e.target).attr('href'));
      });

      var activeTab = localStorage.getItem('activeTab');

      if (activeTab) {
         $('#myTab a[href="'+activeTab+'"]').tab('show');
      }
   });

    // Update User
    async function update_user(id) {
      const data = await get_update('auth_users', id);
      if (data) {
        $("input[name='fname']").val(data.first_name);
        $("input[name='lname']").val(data.last_name);
        $("input[name='username']").val(data.username);
        $("input[name='email']").val(data.email);
        $("select[name='role']").val(data.role.toLowerCase());
        $("select[name='shop']").val(data.shop_id.toLowerCase());
        $("#hidden-id").val(id);

        $('.modal-title').text("Update User");
        $("button[type='submit'").text("Update").attr('name', 'update-user-btn');
        $("#user-form").attr('action', '');
        $(".hidden-field").hide();

        $('#register').modal('show');
      }
    }

    async function update_shop(id) {
      const data = await get_update('shops', id);
      console.log(data, id);
      if (data) {
        $("#shop-address").val(data.address);
        $("#shop-contact").val(data.contact);
        $("input[name='shop-hidden-id']").val(id);

        $("button[name='add-shop'").text("Update").attr('name', 'update-shop').addClass('btn-success').removeClass('btn-default');
      }
    }
</script>