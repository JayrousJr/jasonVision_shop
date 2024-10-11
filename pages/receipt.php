<?php  
session_start();
include 'includes/func.inc.php';
include 'includes/constants.php';
include '../libraries/autoload.php';

if (!isset($_SERVER['HTTP_REFERER'])) {
  exit('Unauthorized Access!');
}

$id = $_GET['id'];
$shop_id = $shop->get_id();
$type = strtolower($_GET['type']);
$table = ($type == 'cash') ? 'cash_receipt' : 'credit_receipt';

$data  = $db->query("SELECT * FROM {$table} WHERE rec_no = '$id'")[0];

if (!$data) {
	exit("404: Data not found!");
}

$count = $db->count('sales', array('rec_id', $data->id));
$items = $db->query("SELECT * FROM sales WHERE rec_id = '$data->id' AND type='$type'");
$total = 0;

$width = $count > 10 ? "width: 85%" : "width: 65%";

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/print.css">
</head>
<body>
	<button onclick="printReceipt()">Print</button>
	<div class="wrapper print-area" style="<?= $width ?>">
		<div class="header">
			<img src="http://shop.jasonvision.co.tz/pages/img/logo3.png" alt="" style="width: 12%">
			<h4><?= strtoupper(COMPANY_FULL_NAME) ?></h4>
			<h5>Tel: <?= PRIMARY_PHONE; ?> or <?= OTHER_PHONE; ?></h5>
			<h5>WhatsApp: <?= WHATSAPP_NUMBER; ?></h5>
			<h5>Email: <?= PRIMARY_EMAIL ?></h5>
			<h5>Website: <?= WEBSITE ?></h5>
			<h5><?= STREET.' '.LANDMARK.', '.CITY.' '.COUNTRY  ?></h5>
		</div>
		<div class="body" style="padding-bottom: 50px">
			<table class="cust-info">
				<tr>
					<td colspan="2">Customer: <?= $data->customer_name; ?></td>
				</tr>
				<tr>
					<td colspan="2">Contact: <?= $data->phone; ?></td>
					<td align="right">Receipt#: <?= inv_display($id); ?></td>
				</tr>
				<tr>
					<td colspan="2">Address: <?= $data->address; ?></td>
					<td align="right">Tin#: 129-174-803</td>
				</tr>
			</table>
			<table class="table">
				<thead>
					<tr>
						<th>Item</th>
						<th>Quantity</th>
						<th>Price</th>
						<th>Subtotal</th>
					</tr>
				</thead>
				<tbody>
					<?php if ($items): ?>
						<?php foreach ($items as $item): ?>
							<tr>
								<td><?= $item->drug_name; ?></td>
								<td><?= $item->quantity; ?></td>
								<td><?= number_format($item->price); ?></td>
								<td><?= number_format($item->price * $item->quantity); ?></td>
							</tr>
							<?php $total += ($item->price * $item->quantity); ?>
						<?php endforeach ?>
					<?php endif ?>
					
					<tr>
						<th colspan="3">Total Amount</th>
						<th><?= number_format($total, 2); ?></th>
					</tr>
					<tr>
						<th colspan="3">Discount</th>
						<th><?= number_format($data->discount, 2); ?></th>
					</tr>
					<tr>
						<th colspan="3">Net Amount Due</th>
						<th><?= number_format($total - $data->discount, 2); ?></th>
					</tr>
				</tbody>
			</table>

			<table class="footer">
				<tr>
					<td>Date: <?= split_time($data->rec_date)[0]; ?></td>
					<td align="right">Sold By: <?= ucfirst($data->soldby) ?></td>
				</tr>
			</table>
			<?php if ($type === 'credit'): ?>
				<table class="cust-info" style="margin-top: 50px">
					<tr>
						<td class="signature-keys">Salesman Signature</td>
						<td align="right" class="signature-keys">1<sup>st</sup>Installment Amount</td>
					</tr>
					<tr>
						<td>..........................</td>
						<td align="right">..........................</td>
					</tr>
					<tr>
						<td class="signature-keys">Customer Signature</td>
						<td align="right" class="signature-keys">2<sup>nd</sup> Installment Amount</td>
					</tr>
					<tr>
						<td>..........................</td>
						<td align="right">..........................</td>
					</tr>
				</table>
			<?php endif ?>
			<table class="cust-info space-top">
				<tr>
					<td><strong>NOTE: </strong> Goods once sold will not be accepted back</td>
				</tr>
				<tr>
					<td>
						<strong>Pay Through </strong><?= BANK_NAME.' bank' ?>, Account:  <?= BANK_ACCOUNT_NUMBER ?>, name: <?= BANK_ACCOUNT_NAME ?>
					</td>
				</tr>
				<tr>
					<td>
						<strong>OR Through </strong> <?= MOBILE_OPERATOR?>: <?= MOBILE_ACCOUNT_NUMBER ?> Name:  <?= MOBILE_ACCOUUNT_NAME ?>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<script src="../js/jquery.js"></script>
	<script src="js/printThis.js"></script>
	<script>
		printReceipt();

		function printReceipt() {
			$(".print-area").printThis({
				importCSS: false,
				importStyle: true,
				loadCSS: "https://shop.jasonvision.co.tz/pages/css/print.css"
			});
		}
	</script>
</body>
</html>