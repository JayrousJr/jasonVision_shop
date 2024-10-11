<?php
session_start();
include 'dbh.php';
$isOK = false;
$path = '';
$msg = "";
if (isset($_POST['key']) && $_POST['key'] == 'get_invoice') {
  $name = $_POST['cname'];
  $qty = $_POST['desc'];
  $rate = $_POST['size'];
  $amt = $_POST['sold'];
  $rem = $_POST['rem'];

  //INCREAMENT
  $sql = mysqli_query($conn, "SELECT id FROM ledgers ORDER BY id DESC LIMIT 1");
  if (mysqli_num_rows($sql) > 0) {
    $data = mysqli_fetch_array($sql);
    $l_id = $data['id'] + 1;
  } else {
    $l_id = 1;
  }
  //SQL-For ledger_details
  $sql = "";
  for ($i = 0; $i < count($name); $i++) {
    $name_clean = mysqli_real_escape_string($conn, $name[$i]);
    $qty_clean = mysqli_real_escape_string($conn, $qty[$i]);
    $rate_clean = mysqli_real_escape_string($conn, $rate[$i]);
    $amt_clean = mysqli_real_escape_string($conn, $amt[$i]);
    $rem_clean = mysqli_real_escape_string($conn, $rem[$i]);

    if ($name_clean != '' && $qty_clean != '' && $rate_clean != '' && $amt_clean != '' && $rem_clean != '') {
      $sql .= "INSERT INTO  ledger_details (l_id,name, description, size, sold, remain) VALUES ('$l_id','$name_clean','$qty_clean','$rate_clean','$amt_clean','$rem_clean');";
    }
  }

  if (!empty($sql)) {
    if (mysqli_multi_query($conn, $sql)) {
      mysqli_close($conn);
      include 'dbh.php';
      require 'ledger-doc.php';
      $save = mysqli_query($conn, "INSERT INTO ledgers (author,l_path,r_date) VALUES ('" . $_SESSION['name'] . "','$path',NOW());");
      if ($save) {
        $isOK = true;
        $msg = "success";
      }
    } else {
      $isOK = false;
      $msg = mysqli_error($conn);
    }
  } else {
    $isOK = false;
    $msg = "All Field are required";
  }
  // Return Response to the client
  exit(json_encode(array('status' => $isOK, 'msg' => $msg, 'path' => $path)));
}