<?php
session_start();
unset($_SESSION['uname']);
unset($_SESSION['cpsw']);
unset($_SESSION['status']);
session_destroy();
header('location:../index.php');
?>