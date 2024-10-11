<?php
session_start();
$_SESSION['timeout'] = time() + 60;
?>