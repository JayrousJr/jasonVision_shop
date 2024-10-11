<?php
session_start();
// GENERATE INVOICE IN PDF
require 'dbh.php';
require 'func.inc.php';
require_once '../../libraries/autoload.php';
require '../fpdf/fpdf.php';
require_once 'constants.php';

$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetY(20);
$pdf->SetFont('Arial', 'B', 14);
$pdf->Image('../img/logo.jpg', 90, 10, 30);
$pdf->Ln(20);
$pdf->Cell(150, 7, ucwords(COMPANY_FULL_NAME), 0, 0);
$pdf->Cell(39, 7, 'Delivery Note', 0, 1, 'R');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(150, 6, 'Importers & Wholesales of lab Chemicals, Equipments & Glassware', 0, 1);
$pdf->Cell(150, 6, ucwords(STREET . ' ' . LANDMARK . ', ' . CITY . ' ' . COUNTRY), 0, 1);
$pdf->Cell(159, 6, strtoupper('P.O.BOX - ' . PO_BOX) . ', ' . WEBSITE . ', ' . CITY . ', ' . ucwords(COUNTRY), 0, 1);
$pdf->SetFont('Arial', 'B', 11);

$pdf->SetFont('Arial', '', 11);
$pdf->Cell(159, 6, 'Tel: ' . PRIMARY_PHONE . '/' . OTHER_PHONE . ', WhatsApp: ' . WHATSAPP_NUMBER, 0, 0);

$pdf->Cell(0, 6, '', 0, 1);
$pdf->Cell(150, 6, 'Email: ' . PRIMARY_EMAIL . ' or ' . OTHER_EMAIL, 0, 1);
$pdf->Ln(15);

// INVOICE DETAILS
$inv = mysqli_query($conn, "SELECT * FROM invoices WHERE inv_no = '" . $_GET['id'] . "'");
$inv_data = mysqli_fetch_assoc($inv);

$pdf->Cell(91, 7, 'Deliver To.', 1, 0);
$pdf->Cell(5, 7, '', 0, 0);
$pdf->Cell(22, 7, 'Date', 1, 0, 'C');
$pdf->Cell(22, 7, 'Invoice No.', 1, 0, 'C');
$pdf->Cell(24, 7, 'Tin No.', 1, 0, 'C');
$pdf->Cell(25, 7, 'Delivery Date', 1, 0, 'C');

$pdf->Cell(0, 7, '', 0, 1);
$pdf->Cell(91, 21, $inv_data['custName'], 1, 0);
$pdf->Cell(5, 7, '', 0, 0);
$pdf->Cell(22, 7, date("d-m-Y", strtotime(split_time($inv_data['inv_time'])[0])), 1, 0, 'C');
$pdf->Cell(22, 7, inv_display($inv_data['inv_no']), 1, 0, 'C');
$pdf->Cell(24, 7, TIN_NUMBER, 1, 0, 'C');
$pdf->Cell(25, 7, date('d-m-Y'), 1, 0, 'C');
$pdf->Cell(0, 7, '', 0, 1);
$pdf->Cell(0, 2, '', 0, 1);

$pdf->Ln(21);

// Tables Headers
$pdf->SetFont('Arial', 'B', '12');
$pdf->Cell(100, 7, 'Description', 1, 0, 'C');
$pdf->Cell(89, 7, 'Quantities', 1, 1, 'C');

// table Body
$pdf->SetFont('Arial', '', '12');

//D.Note TABLE BODY
$i = 0;
$inv_id = $_GET['id'];
$sql = mysqli_query($conn, "SELECT * FROM invoice_details WHERE inv_id = '$inv_id'");
while ($data = mysqli_fetch_array($sql)) {

	$pdf->Cell(100, 7, $data['product_desc'], 1, 0);
	$pdf->Cell(89, 7, $data['qty'], 1, 1, 'C');
	$i++;
}
$pdf->Cell(0, 2, '', 0, 1);

$defaultLine = 70;
$defaultRow = 4;

for ($j = $i; $j > $defaultRow; $j--) {
	$defaultLine -= 7;
}



// TERMS AND CONDITIONS
$pdf->Cell(189, 10, "Goods received in good condition", 0, 1);
$pdf->Cell(129, 10, "Received by: _______________________________", 0, 0);
$pdf->Cell(60, 10, "Signature: ..........................", 0, 0);
$pdf->Cell(0, 10, '', 0, 1);

$pdf->Cell(0, 10, '', 0, 1);

$pdf->Cell(129, 10, "Disignation: ________________________________", 0, 0);
$pdf->Cell(60, 10, "Rubber Stamp", 0, 0, "C");
$pdf->Image('../img/stamp.png', 150, 193, 50);

$pdf->Cell(0, 10, '', 0, 1);
$pdf->Cell(129, 10, "Signature: _________________________________", 0, 0);
$pdf->Cell(60, 10, 'Date: _________________', 0, 1);
$pdf->Ln($defaultLine);

$pdf->Output('report.pdf', 'I');
