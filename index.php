<?php
session_start();
date_default_timezone_set("Africa/Nairobi");
require_once 'libraries/DB.php';
require_once 'libraries/Session.php';
require_once 'libraries/Redirect.php';
require_once 'pages/includes/constants.php';

if (Session::exists('user_id')) {
  Redirect::to('pages/dashboard');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Hussein Muhammad">
    <title><?= COMPANY_NAME ?></title>
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="pages/css/toastr.css" rel="stylesheet">
</head>

<body class="bg-dark">
    <div class="header bg-light d-flex justify-content-between px-4 py-2">
        <p class="p-0 m-0"><?= strtoupper(COMPANY_NAME) ?> MANAGEMENT SYSTEM 2.5</p>
        <p class="p-0 m-0"><?= date("l j F, Y"); ?></p>
    </div>
    <div class="container pt-4">
        <div class="card card-login mx-auto mt-5">
            <div class="card-header text-center">LOGIN</div>

            <div class="card-body">
                <form action="includes/auth.php" method="POST">
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="text" name="username" id="inputEmail" class="form-control"
                                placeholder="Username" required="required" autofocus="autofocus">
                            <label for="inputEmail">Username</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="password" name="password" id="inputPassword" class="form-control"
                                placeholder="Password" required="required">
                            <label for="inputPassword">Password</label>
                        </div>
                    </div>
                    <div class="form-group">
                    </div>
                    <input type="submit" name="loginBtn" value="login" class="btn btn-success btn-block">
                </form>
                <div class="text-center">
                    <a class="d-block small mt-4" href="forgot-password.html">Forgot Password?</a>
                </div>
            </div>

        </div>
        <p class="text-center mt-5 mb-0 text-muted">
            2018 - <?= date("Y") ?> &copy; <?= ucwords(strtolower(COMPANY_FULL_NAME)); ?>
        </p>
        <p class="text-center mt-0 text-muted">
            Developed by
            <a href="mailto:jasonvision2015@gmail.com" class="text-muted">Jason Vision Technologies</a>
        </p>
    </div>
    <script src="js/jquery.js"></script>
    <script src="pages/js/toastr.min.js"></script>
    <?php if (Session::exists('login-error')): ?>
    <script>
    toastr.options = {
        preventDuplicates: true,
        positionClass: "toast-top-center-custom",
        showMethod: 'slideDown',
        hideMethod: 'slideUp',
        hideDuration: 300,
        timeOut: "3000"
    };
    toastr.error("<?= Session::flash('login-error') ?>");
    </script>
    <?php endif ?>
</body>

</html>