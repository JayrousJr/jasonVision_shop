<?php 
if (strtolower($_SESSION['role']) != 'director') {
  header("Location: Admin.php");
  exit();
}