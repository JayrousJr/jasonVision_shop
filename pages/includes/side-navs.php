<div class="sidebar-nav">
    <div class="nav-canvas">
        <ul class="nav nav-pills nav-stacked main-menu">
            <li>
            	<a class="ajax-link" href="dashboard">
            		<i class="glyphicon glyphicon-home"></i> Dashboard
            	</a>
            </li>
            <li>
                <a class="ajax-link" href="pos">
                    <i class="glyphicon glyphicon-shopping-cart"></i> Point of Sales
                </a>
            </li>
            <li class="accordion">
                <a class="ajax-link" href="javascript:;">
                    <i class="fa fa-line-chart"></i> Sales
                </a>
                <ul class="nav nav-pills nav-stacked">
                    <li>
                        <a href="sales?shop=<?= Session::get('shop') ?>">
                            <i class="fa fa-money"></i> All Sales
                        </a>
                    </li>
                    <li>
                        <a href="sale?t=cash&shop=<?= Session::get('shop')?>">
                            <i class="fa fa-money"></i> Cash Sales
                        </a>
                    </li>
                    <li>
                        <a href="sale?t=credit&shop=<?= Session::get('shop')?>">
                            <i class="fa fa-share"></i> Credit Sales
                        </a>
                    </li>
                </ul>
            </li>
            <li class="accordion">
            	<a class="ajax-link" href="#">
            		<i class="fa fa-check-square-o"></i> Issued Receipts
            	</a>
            	<ul class="nav nav-pills nav-stacked">
                    <li>
                    	<a href="receipts?type=cash<?= $perms->is_admin() ? '&shop='.Session::get('shop') : '' ?>">
                    		<i class="fa fa-money"></i> Cash Sales
                    	</a>
                    </li>
                    <li>
                    	<a href="receipts?type=credit<?= $perms->is_admin() ? '&shop='.Session::get('shop') : '' ?>">
                    		<i class="fa fa-share"></i> Credit Sales
                    	</a>
                    </li>
            	</ul>
            </li>
            <?php if ($perms->is_admin()): ?>
            <li class="accordion">
                <a class="ajax-link" href="#">
            		<i class="fa fa-check-square-o"></i> Stocks
                </a>
                <ul class="nav nav-pills nav-stacked">
                    <li>
                        <a class="ajax-link" href="stocks?shop=<?= Session::get('shop')?>">
                            <i class="glyphicon glyphicon-save"></i> Manage Stocks
                        </a>
                    </li>
                    <li>
                        <a class="ajax-link" href="stock-list">
                            <i class="glyphicon glyphicon-print"></i> Stocks Report
                        </a>
                    </li>
                </ul>
                
            </li>
            <li>
            	<a class="ajax-link" href="staffs">
            		<i class="fa fa-user"></i> Staffs
            	</a>
            </li>
            <li>
            	<a class="ajax-link" href="assets">
            		<i class="fa fa-taxi"></i> Assets
            	</a>
            </li>
            <?php endif ?>
            <li>
            	<a class="ajax-link" href="customers<?= $perms->is_admin() ? '?shop='.Session::get('shop') : '' ?>">
            		<i class="glyphicon glyphicon-share"></i> Customers
            	</a>
            </li>
            <li class="accordion">
            	<a class="ajax-link" href="#">
            		<i class="fa fa-file-pdf-o"></i> Ledgers & Invoices
            	</a>
            	<ul class="nav nav-pills nav-stacked">
            		<li><a href="ledger">Create Leadger</a></li>
            		<li><a href="invoice">Create Invoices</a></li>
                    <?php if ($perms->is_admin_or_accountant()): ?>
                    <li>
                        <a href="ledger-list<?= $perms->is_admin() ? '?shop='.Session::get('shop') : '' ?>">Ledgers list</a>
                    </li>
                    <?php endif ?>
                    <?php if ($perms->is_admin_or_manager_or_accountant()): ?>
                    <li>
                        <a href="invoice-list<?= $perms->is_admin() ? '?shop='.Session::get('shop') : '' ?>">Invoices list</a>
                    </li>
                    <?php endif ?>
            	</ul>
            </li>
            <?php if ($perms->is_admin()): ?>
            <li>
                <a href="users">
                    <i class="fa fa-list"></i> Manage All users
                </a>
            </li>
            <li>
            	<a href="expenses">
                    <i class="glyphicon glyphicon-globe"></i> Expenses
            	</a>
            </li>
            <?php endif ?>
            <li>
            	<a class="ajax-link" href="sales-return<?= $perms->is_admin() ? '?shop='.Session::get('shop') : '' ?>">
                    <i class="glyphicon glyphicon-star"></i> Sales Return
                </a>
            </li>
            <?php if ($perms->is_admin()): ?>
            <li class="accordion">
                <a href="#">
                    <i class="glyphicon glyphicon-search"></i>  Items  
                </a>
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="disposals">Disposed Item</a></li>
                </ul>
            </li>
            <?php endif ?>
        </ul>
    </div>
</div>