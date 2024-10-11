<?php 
    include 'includes/guard.php';
    include 'includes/header.php';

    $where = array('shop_id', $shop->get_id());
?>
<body>
<?php include 'includes/navbar.php' ?>
<div class="ch-container">
    <div class="row">
        <div class="col-sm-2 col-lg-2">
            <?php include 'includes/side-navs.php' ?>
        </div>
        <div id="content" class="col-lg-10 col-sm-10">
        	<ul class="breadcrumb">
		        <li>
		            <a href="dashboard">Home</a>
		        </li>
		        <li>
		            <a href="dashboard">Dashboard</a>
		        </li>
		    </ul>
		    <div class="app-row">
		    	<?php if ($perms->is_admin()): ?>
			    <div class="app-col">
			        <a class="well top-block" href="users">
			            <i class="glyphicon glyphicon-user blue"></i>
			            <div>Total Users</div>
			            <div><?= $db->count('auth_users') ?></div>
			        </a>
			    </div>
				<?php endif ?>
			    <div class="app-col">
			        <a  class="well top-block" href="stocks">
			            <i class="glyphicon glyphicon-star green"></i>
			            <div>Items in Stock</div>
			            <div><?= $db->count('stock', $where) ?></div>
			        </a>
			    </div>

			    <div class="app-col">
			        <a class="well top-block" href="sales">
			            <i class="glyphicon glyphicon-shopping-cart yellow"></i>
			            <div>Sales Transactions</div>
			            <div><?= $db->count('sales', $where) ?></div>
			        </a>
			    </div>
			    <div class="app-col">
			        <a class="well top-block" href="customers">
			            <i class="glyphicon glyphicon-stats red"></i>
			            <div>Customers</div>
			            <div><?= $db->count('customers', $where) ?></div>
			        </a>
			    </div>
			</div>
			<?php if ($perms->is_admin()): ?>
			<div class="row">
			    <div class="box col-md-12">
			        <div class="box-inner">
			            <div class="box-header well">
			                <h2><i class="fa fa-file-excel-o"></i> Export Excel Sheets</h2>

			                <div class="box-icon">
			                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
			                            class="glyphicon glyphicon-chevron-up"></i></a>
			                    <a href="#" class="btn btn-close btn-round btn-default"><i
			                            class="glyphicon glyphicon-remove"></i></a>
			                </div>
			            </div>
			            <div class="box-content">
			            	<div class="app-row">
			            		<div class="app-col">
			            			<a href="excel.php?type=stock" class="btn btn-info btn-block">
					                	<i class="glyphicon glyphicon-star"></i> Stock Details
							        </a>
			            		</div>
			            		<div class="app-col">
			            			<a href="excel.php?type=sales" class="btn btn-info btn-block">
					                	<i class="fa fa-google-wallet"></i> Sales Details
							        </a>
			            		</div>
			            		<div class="app-col">
			            			<a href="excel.php?type=employee" class="btn btn-info btn-block">
					                	<i class="fa fa-users"></i> Employees
							        </a>
			            		</div>
			            		<div class="app-col">
			            			<a href="excel.php?type=expense" class="btn btn-info btn-block">
					                	<i class="fa fa-pie-chart"></i> Expenses
							        </a>
			            		</div>
			            		<div class="app-col">
			            			<a href="excel.php?type=asset" class="btn btn-info btn-block">
					                	<i class="fa fa-tasks"></i> Assets Details
							        </a>
			            		</div>
			            	</div>
			            </div>
			        </div>
			    </div>
			</div>
			<?php endif ?>
			<div class="row">
				<div class="box col-md-12">
			        <div class="box-inner">
			            <div class="box-header well">
			                <h2><i class="glyphicon glyphicon-th"></i> Chart with other staffs</h2>

			                <div class="box-icon">
			                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
			                            class="glyphicon glyphicon-chevron-up"></i></a>
			                    <a href="#" class="btn btn-close btn-round btn-default"><i
			                            class="glyphicon glyphicon-remove"></i></a>
			                </div>
			            </div>
			            <div class="box-content">
			                <form method="POST" action="server.php">
			                    <div class="row">
								   <div class="col-lg-12">
								    <div class="input-group">
								      <input type="text" name="sms" class="form-control" placeholder="Type your message here">
								      <span class="input-group-btn">
								        <button name="post-sms" class="btn btn-info" type="submit">
								        	Send <i class="fa fa-paper-plane-o"></i>
								    	</button>
								      </span>
								    </div>
								  </div>
								</div>
			                </form>
			                <table class="table table-bordered table-striped table-condensed mt-4">
			                	<thead>
			                		<tr>
			                			<th>Message</th>
			                			<th>Sender</th>
			                			<?php if ($perms->is_admin()): ?>
			                				<th></th>
			                			<?php endif ?>
			                		</tr>
			                	</thead>
			                	<tbody>
			                		<?php if (get_all('comment')): ?>
			                			<?php foreach (get_all('comment') as $sms): ?>
			                				<tr>
					                			<td><?= $sms['comm']; ?></td>
					                			<td><?= $sms['jina']; ?></td>
					                			<?php if ($perms->is_admin()): ?>
					                				<td>
						                				<a href="includes/delete.inc.php?del=sms&id=<?=$sms['id_com']?>" onclick="return confirmDelete()" class="btn btn-danger btn-sm">delete</a>
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
  <hr>
<?php include 'includes/inc/footer.php' ?>