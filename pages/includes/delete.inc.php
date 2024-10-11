<?php
session_start();
include 'dbh.php';
include 'func.inc.php';
require_once '../../libraries/autoload.php';

$return_URL = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
$unexpected_error = "Unexpected error: Please contact <a href='mailto:husmukh154@gmail.com'>@mpembainc</a>";

if (empty($return_URL)) {
  exit('Unauthorized Access!');
}

if (!isset($_GET['id']) && !isset($_POST['isAjax'])) {
  Redirect::to($return_URL."?error=true");
}

// DELETE SALES
if (isset($_GET['del']) && $_GET['del'] == 'sale') {
  if (delete($conn, 'sales', $_GET['id'])) {
    Session::flash('success', 'Sales has been deleted successfully');
    Redirect::to($return_URL);
  } else {
    echo $unexpected_error;
  }
}

// DELETE TRA
if (isset($_GET['del']) && $_GET['del'] == 'tra') {
  if (delete($conn, 'tra', $_GET['id'])) {
    Session::flash('success', 'TRA record has been deleted successfully');
    Redirect::to($return_URL);
  } else {
    echo $unexpected_error;
  }
}

// DELETE STOCK
if (isset($_GET['del']) && $_GET['del'] == 'stock') {
  if (delete($conn, 'stock', $_GET['id'])) {
    Session::flash('success', 'Stock has been deleted successfully');
    Redirect::to($return_URL);
  } else {
    echo $unexpected_error;
  }
}

// DELETE USER
if (isset($_GET['del']) && $_GET['del'] == 'user') {
  $image = $db->get('auth_users', intval($_GET['id']))->img;
  if(!empty($image) && file_exists('../'.$image)) {
    unlink('../'.$image);
  } 

  if (delete($conn, 'auth_users', $_GET['id'])) {
    Session::flash('success', 'User has been deleted successfully');
    Redirect::to($return_URL);
  } else {
    echo $unexpected_error;
  }
}

// DELETE SMS
if (isset($_GET['del']) && $_GET['del'] == 'sms') {
  if (delete($conn, 'comment', $_GET['id'], 'id_com')) {
    Session::flash('success', 'SMS has been deleted successfully');
    Redirect::to($return_URL);
  } else {
    echo $unexpected_error;
  }
}

#DELETE ASSET
if (isset($_GET['del']) && $_GET['del'] == 'asset') {
  if (delete($conn, 'asset', $_GET['id'])) {
    Session::flash('success', 'Asset has been deleted successfully');
    Redirect::to($return_URL);
  } else {
    echo $unexpected_error;
  }
}

#DELETE CUSTOMER
if (isset($_GET['del']) && $_GET['del'] == 'cust') {
  if (delete($conn, 'customers', $_GET['id'])) {
    Session::flash('success', 'Customer has been deleted successfully');
    Redirect::to($return_URL);
  } else {
    echo $unexpected_error;
  }
}

#DELETE STAFF
if (isset($_GET['del']) && $_GET['del'] == 'staff') {
  if (delete($conn, 'managers', $_GET['id'])) {
    Session::flash('success', 'Staff has been deleted successfully');
    Redirect::to($return_URL);
  } else {
    echo $unexpected_error;
  }
}

#DELETE Expenses
if (isset($_GET['del']) && $_GET['del'] == 'expense') {
  if (delete($conn, 'expense', $_GET['id'])) {
    Session::flash('success', 'Expense has been deleted successfully');
    Redirect::to($return_URL);
  } else {
    echo $unexpected_error;
  }
}

#DELETE Shop
if (isset($_GET['del']) && $_GET['del'] == 'shop') {
  if (delete($conn, 'shops', $_GET['id'])) {
    Session::flash('success', 'Shop has been deleted successfully');
    Redirect::to($return_URL);
  } else {
    echo $unexpected_error;
  }
}

#DELETE Shop
if (isset($_GET['del']) && $_GET['del'] == 's_ret') {
  if (delete($conn, 'sales_return', $_GET['id'])) {
    Session::flash('success', 'Sales return has been deleted successfully');
    Redirect::to($return_URL);
  } else {
    echo $unexpected_error;
  }
}

#.............................................................................
# AJAX REQUESTS
# DELETE STRORED INVOICE
if (isset($_POST['action']) && $_POST['action'] == 'delete_inv') {
  $id = $_POST['id'];
  $path = $_POST['file'];

  if (file_exists($path)) {
    unlink($path);
  }

  if(delete($conn, 'invoices', $id)) {
    $sql = mysqli_query($conn, "DELETE FROM invoice_details WHERE inv_id = '$id'");
    if ($sql) {
      echo "success";
      exit();
    }
  }
}

// DELETE RECEIPT
if (isset($_POST['action']) && $_POST['action'] == 'delete_rec') {
  $id = $_POST['id'];
  $table = $_POST['type']."_receipt";
  $sold = ($_POST['type'] === 'cash') ? 'sales' : 'credit';

  if(delete($conn, $table, $id)){
    $sql = mysqli_query($conn, "DELETE FROM {$sold} WHERE rec_id = '$id'");
    if ($sql) {
      Session::flash('success', 'RECEIPT has been deleted successfully');
      Redirect::to($return_URL);
    }
  }
}


// DELETE LEDGER
if (isset($_GET['action']) && $_GET['action'] == 'delete_ledg') {
  $id = $_GET['id'];
  $path = $_GET['file'];
  // DELETE STRORED INVOICE
  if(unlink($path)){
    $sql = mysqli_query($conn, "DELETE FROM ledgers WHERE id = '$id'");
    if ($sql) {
      $sql2 = mysqli_query($conn, "DELETE FROM ledger_details WHERE l_id = '$id'");
      if ($sql2) {
        Session::flash('success', 'Ledger has been deleted successfully');
          Redirect::to($return_URL);
      }
    }
  }
}

#If none of the above
echo $unexpected_error;
