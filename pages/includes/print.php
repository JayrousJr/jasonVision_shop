<?php
include 'dbh.php';

if (isset($_GET['get'])) {
  $doc = $_GET['doc'];
  $doc_get_style = $_GET['get'];

  if ($doc_get_style === 'preview') {
    $name = $_GET['file'];
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="'.$name.'"');
    header('Cache-Control: private, max-age=0, must-revalidate');
    readfile($name);
  }

}
