<?php
// GENERATE INVOICE IN PDF
require '../fpdf/fpdf.php';
require_once 'constants.php';
define('INVOICE_DIR', 'pages/invoices/');
class PDF extends FPDF
{
	function manyText($text2)
	{
		$cellWidth = 92;
		$cellHeight = 6;

		// calculate the height needed
		$textLength = strlen($text2);
		$errMargin = 10;
		$startChar = 0;
		$maxChar = 0;
		$textArray = array();
		$tmpString = "";

		while ($startChar < $textLength) {
			while ($this->GetStringWidth($tmpString) < ($cellWidth - $errMargin) && ($startChar + $maxChar) < $textLength) {
				$maxChar++;
				$tmpString = substr($text2, $startChar, $maxChar);
			}
			$startChar = $startChar + $maxChar;
			array_push($textArray, $tmpString);
			$maxChar = 0;
			$tmpString = '';
		}
		$line = count($textArray);
		$xPos = $this->GetX();
		$yPos = $this->GetY();
		$this->MultiCell(92, 7, $text2, 1);
		$this->SetXY($xPos + $cellWidth, $yPos);
	}
}
// $invoice_No = '';
// $custName = '';
// $lpo = '';
// $inv_gen = '';
// $name = array(); // or initialize with an empty array
// $charge = 0;

$pdf = new PDF('P', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetY(20);
$pdf->SetFont('Arial', 'B', 14);
$pdf->Image('../img/logo.jpg', 90, 10, 30);
$pdf->Ln(20);
$pdf->Cell(150, 6, ucwords(COMPANY_FULL_NAME), 0, 0);
$pdf->Cell(39, 6, 'Invoice', 0, 1, 'R');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(150, 6, 'Importers & Wholesales of lab Chemicals, Equipments & Glassware', 0, 1);
$pdf->Cell(150, 6, ucwords(STREET . ' ' . LANDMARK . ', ' . CITY . ' ' . COUNTRY), 0, 1);
$pdf->Cell(159, 6, strtoupper('P.O.BOX - ' . PO_BOX) . ', ' . WEBSITE . ', ' . CITY . ', ' . ucwords(COUNTRY), 0, 0);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(30, 9, 'Invoice No.', 1, 1, 'C');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(159, 6, 'Tel: ' . PRIMARY_PHONE . '/' . OTHER_PHONE . ', WhatsApp: ' . WHATSAPP_NUMBER, 0, 0);

$pdf->Cell(30, 9, $invoice_No, 1, 0, 'C');
$pdf->Cell(0, 6, '', 0, 1);
$pdf->Cell(150, 6, 'Email: ' . PRIMARY_EMAIL . ' or ' . OTHER_EMAIL, 0, 1);
$pdf->Ln(12);

$pdf->Cell(80, 6, 'Invoice To.', 1, 0);
$pdf->Cell(5, 6, '', 0, 0);
$pdf->Cell(25, 6, 'LPO No.', 1, 0, 'C');
$pdf->Cell(29, 6, 'TIN No.', 1, 0, 'C');
$pdf->Cell(25, 6, 'VAT Reg.', 1, 0, 'C');
$pdf->Cell(25, 6, 'D. Note No.', 1, 0, 'C');

$pdf->Cell(0, 6, '', 0, 1);

$pdf->Cell(80, 22, trim($custName), 1, 0);
$pdf->Cell(5, 6, '', 0, 0);
$pdf->Cell(25, 6, $lpo, 1, 0, 'C');
$pdf->Cell(29, 6, TIN_NUMBER, 1, 0, 'C');
$pdf->Cell(25, 6, 'None', 1, 0, 'C');
$pdf->Cell(25, 6, $invoice_No, 1, 0, 'C');

$pdf->Cell(0, 6, '', 0, 1);
$pdf->Cell(0, 2, '', 0, 1);
$pdf->Cell(156, 6, '', 0, 0);
$pdf->Cell(33, 6, date('d M, Y'), 1, 0, 'C');
$pdf->Cell(0, 6, '', 0, 1);
$pdf->Cell(0, 2, '', 0, 1);
$pdf->Cell(101, 6, '', 0, 0);
$pdf->Cell(30, 6, 'Sales Person', 1, 0, 'C');
$pdf->Cell(1, 6, '', 0, 0);
$pdf->Cell(57, 6, $inv_gen, 1, 0);
$pdf->Ln(12);

// Tables Headers
$pdf->SetFont('Arial', 'B', '12');
$pdf->Cell(89, 6, 'Description', 1, 0, 'C');
$pdf->Cell(30, 6, 'Qty', 1, 0, 'C');
$pdf->Cell(30, 6, 'Rate', 1, 0, 'C');
$pdf->Cell(40, 6, 'Amount', 1, 1, 'C');

// table Body
$pdf->SetFont('Arial', '', '12');
// INVOICE TABLE BODY
$totalAmount = 0;
for ($i = 0; $i < count($name); $i++) {
	$pdf->Cell(89, 6, $name[$i], 1, 0);
	$pdf->Cell(30, 6, $qty[$i], 1, 0, 'C');
	$pdf->Cell(30, 6, $rate[$i], 1, 0, 'C');
	$pdf->Cell(40, 6, number_format($amt[$i]), 1, 1, 'C');
	$totalAmount += $amt[$i];
}

$pdf->Cell(89, 6, 'TRANSPORT CHARGE', 1, 0);
$pdf->Cell(30, 6, '', 1, 0, 'C');
$pdf->Cell(30, 6, number_format($charge), 1, 0, 'C');
$pdf->Cell(40, 6, number_format($charge), 1, 1, 'C');
$pdf->Cell(0, 2, '', 0, 1);
$pdf->Cell(123, 2, '', 0, 0);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(30, 6, 'Invoice Total', 1, 0, 'C');
$pdf->Cell(1, 6, '', 0, 0);
$pdf->Cell(35, 6, 'Tsh ' . number_format(($totalAmount + $charge)), 1, 1);

$defaultLine = 78;
$defaultRow = 2;

for ($j = $i; $j > $defaultRow; $j--) {
	$defaultLine -= 6;
}

$pdf->SetFont('Arial', 'I', 8);
$pdf->Cell(0, 6, 'TERMS: 1. Goods once sold will not be accepted back  2. Kindly verify each item requested before payments 3. Payments of credit on agreed period.', 0, 1, 'C');
$pdf->Cell(0, 6, 'will be subjected 10% interest monthly when not paid.', 0, 1, 'C');

$pdf->Cell(0, 6, 'PAY THROUGH: ' . BANK_NAME . '  Account Name: ' . BANK_ACCOUNT_NAME . ' Account Number: ' . BANK_ACCOUNT_NUMBER, 0, 1, 'C');
$pdf->Cell(0, 6, MOBILE_OPERATOR . ': ' . MOBILE_ACCOUNT_NUMBER . ' Name: ' . MOBILE_ACCOUUNT_NAME, 0, 1, 'C');


$path = '../invoices/invoice_' . uniqid() . '.pdf';
$pdf->Ln($defaultLine);
$pdf->Output($path, "F");