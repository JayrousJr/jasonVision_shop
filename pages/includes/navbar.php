<div class="navbar navbar-default" role="navigation">
  <div class="navbar-inner">
    <button type="button" class="navbar-toggle pull-left animated flip">
        <span class="sr-only"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="dashboard">
      <span>Jason Vision - <?= $shop->get_name(); ?></span>
    </a>            
     
    <!-- theme selector starts -->
    <div class="btn-group pull-right theme-container animated tada" style="    margin-right: 15px;">
        <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
            <i class="glyphicon glyphicon-tint"></i><span
                class="hidden-sm hidden-xs"> Change Color</span>
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" id="themes">
            <li><a data-value="classic" href="#"><i class="whitespace"></i> Classic</a></li>
            <li><a data-value="cerulean" href="#"><i class="whitespace"></i> Cerulean</a></li>
            <li><a data-value="cyborg" href="#"><i class="whitespace"></i> Cyborg</a></li>
            <li><a data-value="simplex" href="#"><i class="whitespace"></i> Simplex</a></li>
            <li><a data-value="darkly" href="#"><i class="whitespace"></i> Darkly</a></li>
            <li><a data-value="lumen" href="#"><i class="whitespace"></i> Lumen</a></li>
            <li><a data-value="slate" href="#"><i class="whitespace"></i> Slate</a></li>
            <li><a data-value="spacelab" href="#"><i class="whitespace"></i> Spacelab</a></li>
            <li><a data-value="united" href="#"><i class="whitespace"></i> United</a></li>
        </ul>
    </div>
      <!-- theme selector ends -->

    <ul class="nav navbar-nav navbar-right">
      <li>
        <a href="#">
          <strong style="font-size: 18px"><?= ucwords($_SESSION['name']) ; ?></strong>
        </a>
      </li>
      <li class="dropdown">
        <button type="button" class="btn btn-default navbar-btn dropdown-toggle profile-img" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-image: url(<?= (isset($_SESSION['dp']) && !empty($_SESSION['dp'])) ? $_SESSION['dp'] : 'img/img.jpg'; ?>);">
        </button>
        <ul class="dropdown-menu">
          <li>
            <a href="#" data-toggle="modal" data-target="#logout">
              <i class="glyphicon glyphicon-share"></i> Sign out
            </a>
          </li>
          <?php if ($perms->is_admin()): ?>
          <li role="separator" class="divider"></li>
          <li>
            <a href="#" data-toggle="modal" data-target="#changePwd">
              <i class="glyphicon glyphicon-lock"></i> Change Password
            </a>
          </li>
          <?php endif ?>
        </ul>
      </li>
    </ul>

    <ul class="collapse navbar-collapse nav navbar-nav top-menu">
      <li class="dropdown">
        <a href="#" data-toggle="dropdown">
          <i class="glyphicon glyphicon-hand-down"></i> Other Menu
          <span class="caret"></span>
        </a>

        <ul class="dropdown-menu" role="menu">
          <li><a href="debtors<?= $perms->is_admin() ? '?shop='.Session::get('shop') : '' ?>">Debtors</a></li>
          <li class="divider"></li>
          <?php if ($perms->is_admin_or_accountant()): ?>
          <li><a href="salaries">Salaries</a></li>
           <li class="divider"></li>
          <li><a href="license">Licenses</a></li>
          <li class="divider"></li>
          <li><a href="revenues">Revenue/TRA</a></li>
          <li class="divider"></li>
          <?php if ($perms->is_admin()): ?>
          <li><a href="programs">Programmes</a></li>
          <li class="divider"></li>
          <?php endif ?>
          <li><a href="rent">Rent</a></li>
          <li class="divider"></li>
          <li><a href="loans">Loans</a></li>
          <li class="divider"></li>
          <li><a href="banks">Banks Records</a></li>
          <li class="divider"></li>
          <li><a href="gpsa">GPSA Records</a></li>
          <li class="divider"></li>
          <li><a href="gcla">GCLA Records</a></li>
          <li class="divider"></li>
          <?php endif ?>
          <li><a href="markets<?= $perms->is_admin() ? '?shop='.Session::get('shop') : '' ?>">Marketing</a></li>
        </ul>
      </li>
      <li class="ml-5">
          <h4 style="margin-top: 5px; width: 100px" class="clock btn btn-danger" id="inv-clock"></h4>
      </li>
    </ul>
  </div>
</div>