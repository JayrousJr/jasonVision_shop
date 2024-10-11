<?php
$lineH = 6;

// GENERATE INVOICE IN PDF
require '../fpdf/fpdf.php';
$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetY(20);
$pdf->SetFont('helvetica', 'B', 20);
$pdf->Cell(189, 7, 'JASON VISION COMPANY LIMITED', 0, 1, 'C');
$pdf->SetFont('helvetica', '', 2);

$pdf->Cell(35, 0, '', 0, 0);
$pdf->Cell(119, 0, '', 1, 0, 'C');
$pdf->Cell(35, 0, '', 0, 1, 'C');
$pdf->Cell(0, 1, '', 0, 1);
$pdf->SetFont('helvetica', 'B', 11);
$pdf->Cell(189, 6, 'CHEMICALS LEDGER', 0, 1, 'C');
$pdf->Ln(14);

// TABLE HEADER
$pdf->Cell(20, $lineH, 'SN', 1, 0, 'C');
$pdf->Cell(50, $lineH, 'NAME OF CHEMICAL', 1, 0, 'C');
$pdf->Cell(30, $lineH, 'DESCRIPTION', 1, 0, 'C');
$pdf->Cell(40, $lineH, 'SIZE / UNIT', 1, 0, 'C');
$pdf->Cell(24, $lineH, 'SOLD', 1, 0, 'C');
$pdf->Cell(25, $lineH, 'REMAIN', 1, 1, 'C');

// TABLE BODY
$pdf->SetFont('helvetica', '', 11);
for ($i = 0; $i < count($name); $i++) {
  $pdf->Cell(20, $lineH, $i + 1, 1, 0, 'C');
  $pdf->Cell(50, $lineH, $name[$i], 1, 0, 'C');
  $pdf->Cell(30, $lineH, $qty[$i], 1, 0, 'C');
  $pdf->Cell(40, $lineH, $rate[$i], 1, 0, 'C');
  $pdf->Cell(24, $lineH, $amt[$i], 1, 0, 'C');
  $pdf->Cell(25, $lineH, $rem[$i], 1, 1, 'C');
}

// DOWN KABISA
$cn = $i + 1;
$spa = 20;
for ($j = $cn; $j < 31; $j++) {
  $pdf->Cell(20, $lineH, $cn, 1, 0, 'C');
  $pdf->Cell(50, $lineH, '', 1, 0, 'C');
  $pdf->Cell(30, $lineH, '', 1, 0, 'C');
  $pdf->Cell(40, $lineH, '', 1, 0, 'C');
  $pdf->Cell(24, $lineH, '', 1, 0, 'C');
  $pdf->Cell(25, $lineH, '', 1, 1, 'C');
  $cn++;
}

$pdf->Ln(7);
$pdf->Cell(85, $lineH + 1, "JASON VISION COMPANY LIMITED", 0, 0);
$pdf->Cell($spa - 10, $lineH + 1, '', 0, 0);
$pdf->Cell(85, $lineH + 1, 'GOVERNMENT CHEMIST LABORATORY AGENCY', 0, 1);
$pdf->Cell(85, $lineH + 1, "NAME: ........................................................", 0, 0);
$pdf->Cell($spa, $lineH + 1, '', 0, 0);
$pdf->Cell(85, $lineH + 1, 'NAME: ..........................................................', 0, 1);
$pdf->Cell(85, $lineH + 1, "SIGNATURE: .............................................", 0, 0);
$pdf->Cell($spa, $lineH + 1, '', 0, 0);
$pdf->Cell(85, $lineH + 1, 'SIGNATURE: ...............................................', 0, 1);
$pdf->Cell(85, $lineH + 1, "OFFICIAL STAMP: ....................................", 0, 0);
$pdf->Cell($spa, $lineH + 1, '', 0, 0);
$pdf->Cell(85, $lineH + 1, 'OFFICIAL STAMP: ......................................', 0, 1);
$pdf->Cell(85, $lineH + 1, "DATE: ........................................................", 0, 0);
$pdf->Cell($spa, $lineH + 1, '', 0, 0);
$pdf->Cell(85, $lineH + 1, 'DATE: ..........................................................', 0, 1);

$path = '../ledgers/ledger_' . uniqid() . '.pdf';

$pdf->Output($path, "F");