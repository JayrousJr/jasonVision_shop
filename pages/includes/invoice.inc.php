<?php
session_start();
require_once '../../libraries/autoload.php';
include 'dbh.php';
include 'func.inc.php';

try {
	if (isset($_POST['key']) && $_POST['key'] == 'get_invoice') {
		$name = $_POST['name'];
		$qty = $_POST['qty'];
		$rate = $_POST['rate'];
		$amt = $_POST['amt'];
		$custName = $_POST['cust'];
		$charge = $_POST['charge'] ?: 0;
		$lpo = $_POST['lpo'];
		$inv_gen = $_SESSION['name'];
		$shop_id = $shop->get_id();

		$invoiceID = getNextInvoiceNumber();
		$invoice_No = inv_display($invoiceID);

		$sql = "INSERT INTO invoice_details (shop_id, inv_id, product_desc, qty, rate, amount) VALUES ";

		for ($i = 0; $i < count($name); $i++) {
			$name_clean = mysqli_real_escape_string($conn, $name[$i]);
			$qty_clean = mysqli_real_escape_string($conn, $qty[$i]);
			$rate_clean = mysqli_real_escape_string($conn, $rate[$i]);
			$amt_clean = mysqli_real_escape_string($conn, $amt[$i]);

			if ($name_clean != '' && $qty_clean != '' && $rate_clean != '' && $amt_clean != '') {
				$sql .= "('$shop_id', '$invoiceID', '$name_clean', '$qty_clean', '$rate_clean', '$amt_clean'), ";
			}
		}

		$sql = rtrim($sql, ", ");
		$result = mysqli_query($conn, $sql);

		if ($result) {
			require 'inv_test.php';
			// $path = '';
			$insert_invoice = "INSERT INTO invoices (shop_id, custName, inv_generator, inv_no, inv_path, inv_time) VALUES ('$shop_id', '$custName', '$inv_gen', '$invoiceID', '$path', NOW())";
			$insert_invoice_result = mysqli_query($conn, $insert_invoice);

			$insert_invoice_number = "INSERT INTO invoice_number (invoice_id) VALUES ('$invoiceID')";
			$insert_invoice_number_result = mysqli_query($conn, $insert_invoice_number);

			if ($insert_invoice_result && $insert_invoice_number_result) {
				$status = 1;
				$response = array('status' => $status, 'path' => $path);
			} else {
				$status = 0;
				$response = array('status' => $status, 'path' => '', 'msg' => mysqli_error($conn));
			}
		} else {
			$status = 0;
			$response = array('status' => $status, 'path' => '', 'msg' => 'Database insertion failed');
		}
		exit(json_encode($response));
	}
} catch (\Throwable $th) {
	return $th;
}