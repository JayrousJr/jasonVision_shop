<?php
session_start();
require_once '../core/init.php';
include 'includes/dbh.php';
include 'includes/func.inc.php';

$user_id = Session::get('user_id');

if (isset($_POST['key']) && $_POST['key'] == 'getRowData') {
    $id = $_POST['rowID'];
  	$sql = mysqli_query($conn, "SELECT * FROM stock WHERE id = '$id'");
    $row = mysqli_fetch_assoc($sql);
    $price = 1 * $row['sprice'];
    $pname = $row['dname'];

    // Retrive to cartTable
    $retr = mysqli_query($conn, "SELECT * FROM soud WHERE user_id = '".$_SESSION['user_id']."'");
    $result = "";
    while ($row = mysqli_fetch_assoc($retr)){
      $id = $row['id'];
      $name = $row['name'];
      $qty = $row['qty'];
      $total = $row['total'];
       $i=1;
      $result .= "
          <tr>
            <td>".$name."</td>
            <td>".$qty."</td>
            <td>".$total."</td>
            <td><button class='btn btn-danger btn-sm'>remove</td>
          </tr>
      ";
      $i++;
    }
    $data = array(
      'name' => $pname,
      'price' => $price,
      'result'=> $result
    );
    exit(json_encode($data));
}

// Save data
if (isset($_POST['key']) && $_POST['key'] == 'sendGet') {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $qty = $_POST['qty'];
  $total = $_POST['total'];
  $user_id = $_SESSION['user_id']; 

  //Check if requested quantity is available in a stock
  $select = mysqli_query($conn, "SELECT * FROM stock WHERE id = '$id'");
  $data = mysqli_fetch_assoc($select);
  $price = $data['sprice'];
  if ($data['quantity'] < $qty || $qty < 0) {
    exit("<p class='text-danger text-center'>Out of Stock!</p>");
  }else{

  if (!filter_var($qty, FILTER_VALIDATE_INT) === false) {
    $retr = mysqli_query($conn, "SELECT * FROM soud WHERE name = '$name' AND user_id = '".$_SESSION['user_id']."'");

    if (mysqli_num_rows($retr)>0) {
      $data = mysqli_fetch_assoc($retr);
      $newQty = $data['qty'] + $qty;
      $newTot = $data['total'] + $total;
      $update = mysqli_query($conn, "UPDATE soud SET qty = '$newQty', total = '$newTot' WHERE prod_id = '$id' AND user_id = '".$_SESSION['user_id']."'");
      exit("success");
    }else{
      $sql = mysqli_query($conn, "INSERT INTO soud (prod_id, name, qty,sprice, total,user_id) VALUES ('$id','$name','$qty','$price','$total','".$_SESSION['user_id']."')");
      exit("success");
    }
    }else{
      exit("<p class='text-danger text-center'>Please inter a valid Quantity!</p>");
    }
  }
}

if (isset($_POST['key']) && $_POST['key'] == 'getTotal') {
    $sql = mysqli_query($conn, "SELECT * FROM stock WHERE shop_id = '".$shop->get_id()."' LIMIT 10");
    $tbody = render_pos_table($sql);

    $retr = mysqli_query($conn, "SELECT * FROM soud WHERE user_id = '".$_SESSION['user_id']."'");
    $rows = mysqli_num_rows($retr);

    $result = array(
      'tbody' => $tbody,
      'rows'  => $rows,
      'cart_table' => render_cart_table()
    );

    exit(json_encode($result));
}

// Delete cart items
if (isset($_POST['key']) && $_POST['key'] == 'delete') {
    $id = $_POST['id'];
    $delete = mysqli_query($conn, "DELETE FROM soud WHERE id = '$id'");
    if ($delete) {
      exit("Deleted");
    }
}

// Search items
if (isset($_POST['key']) && $_POST['key'] == 'search') {
    $search = $_POST['search'];
    $sql = mysqli_query($conn, "SELECT * FROM stock WHERE dname LIKE '%$search%' AND shop_id = '".$shop->get_id()."' LIMIT 10");
    echo render_pos_table($sql);
}

#Checkout
if (isset($_POST['checkout-btn'])) {
  $name = $_POST['name'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $type = $_POST['type'];
  $discount = $_POST['discount'];
  $rec_no = next_receipt_number($type);
  $table = ($type == 'cash') ? 'cash_receipt' : 'credit_receipt';

  #Insert Receipt Information
  $rec_data = array(
    'shop_id' => $shop->get_id(),
    'customer_name' => $_POST['name'], 
    'phone' => $_POST['phone'], 
    'address' => $_POST['address'], 
    'discount' => $discount,
    'rec_no' => $rec_no,
    'soldby' => Session::get('username')
  );

  if ($rec_id = $db->insert($table, $rec_data)) {
    $cart_items = $db->get_where('soud', array('user_id', '=', $user_id));

    if ($cart_items) {
      foreach ($cart_items as $data) {
        #Prepare sales data
        $sales_data = array(
          'shop_id' => $shop->get_id(),
          'rec_id' => $rec_id,
          'type' => $type,
          'drug_name' => $data['name'],
          'quantity' => $data['qty'],
          'price' => $data['sprice'],
          'total' => $data['total'],
          'soldby' => Session::get('username')
        );

        #Insert Sales
        if ($db->insert('sales', $sales_data)) {
          #Update each Stock Quantity
          $update = mysqli_query($conn, "UPDATE stock SET quantity = quantity - ".$data['qty']." WHERE id = '".$data['prod_id']."'");
        }
      }

      if ($update) {
        #Clear Cart
        $delete = $db->delete('soud', array('user_id', '=', $user_id));
        
        // $upd = mysqli_query($conn, "INSERT INTO receipt_number (rec_id) VALUES ('$rec_id')");
        
        if ($delete) {
          Redirect::to('receipt?type='.$type.'&id='.$rec_no);
        }
      }
    }
  }
}

#Change User Password
if (isset($_POST['changePass'])) {
  $status = false;
  $msg = '';
  $red = '';
  $id = $_POST['id'];
  $old = $_POST['old'];
  $new = $_POST['new'];

  $sql = mysqli_query($conn, "SELECT * FROM staff WHERE id_staff = '$id' AND cpsw = '$old'");
  if (mysqli_num_rows($sql) == 0) {
    $msg = "<span class='text-danger'>Old password is incorrect!</span>";
  }else{
    $update = mysqli_query($conn, "UPDATE staff SET cpsw = '$new' WHERE id_staff = '$id'");
    if ($update) {
      $msg = "";
      $status = true;
    }
  }
  exit(json_encode(array('status' => $status, 'msg' => $msg)));
}

#Post a comment
if (isset($_POST['post-sms'])) {
  $sms = $_POST['sms'];
  $sender = $_SESSION['name'];

  $sql = mysqli_query($conn, "INSERT INTO comment VALUES ('', '$sms', '$sender')");
  if ($sql) header("Location: dashboard.php?sent=true");
}

#Render Cart Table
function render_cart_table() {
  global $conn;
  $retr = mysqli_query($conn, "SELECT * FROM soud WHERE user_id = '".$_SESSION['user_id']."'");
    $result = "";
    $grandTotal = 0;
    $i = 1;
    while ($row = mysqli_fetch_assoc($retr)){
      $id = $row['id'];
      $name = $row['name'];
      $qty = $row['qty'];
      $price = $row['sprice'];
      $total = $row['total'];

      $result .= "
          <tr>
            <td>".$name."</td>
            <td>".number_format($price)."</td>
            <td>".$qty."</td>
            <td>".number_format($total)."</td>
            <td>
              <button class='btn btn-danger btn-sm' onclick='deleteData(".$id.");'>
                <span class='glyphicon glyphicon-trash'></span>
              </button>
            </td>
          </tr>
      ";
      $grandTotal += $total;
      $i++;
    }

    $result .= "<tr><th colspan='3'>Total Amount</th><th colspan='2'>".number_format($grandTotal,2)."</th></tr>";

    return $result;
}

#Get next receipt_no
function next_receipt_number($type = 'cash') {
  global $db;
  $table = strtolower($type) == 'cash' ? 'cash_receipt' : 'credit_receipt';
  $sql = $db->query("SELECT * FROM {$table} ORDER BY id DESC LIMIT 1");
  return $sql[0]->rec_no + 1;
}