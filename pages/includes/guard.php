<?php
   session_start();
   include 'includes/dbh.php';
   if (!isset($_SESSION['user_id']))
        header("Location:../index.php");
