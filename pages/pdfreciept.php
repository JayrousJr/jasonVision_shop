<?php 
session_start();
require('fpdf/fpdf.php');
include 'includes/dbh.php';
include 'includes/func.inc.php';

 class PDF extends FPDF{
 	function Footer(){
 		$this->SetY(-15);
 		$this->SetFont('Arial','I',8);
 	}
 	
 	function manyText($text2){
 		$cellWidth = 98;
		$cellHeight = 6;

		// calculate the height needed
		$textLength = strlen($text2);
		$errMargin = 10;
		$startChar = 0;
		$maxChar = 0;
		$textArray = array();
		$tmpString = "";

		while ($startChar < $textLength) {
			while ($this->GetStringWidth($tmpString)< ($cellWidth-$errMargin) && ($startChar + $maxChar) < $textLength) {
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
		$this->MultiCell(92,7,$text2,1);
		$this->SetXY($xPos+$cellWidth, $yPos);
 	}
 }


// My variables
$ln = 6;
$lsp = 72;
$lus = 0;
$id = $_GET['id'];

if (!isset($_GET['preview'])) {
	$name = $_GET['name'];
	$phone = $_GET['phone'];
	$address = $_GET['address'];
	$rec_id = $id;
	$date = date("Y-m-d");
}else{
	$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM cash_receipt WHERE rec_no = '$id'"));
	$name = $data['customer_name'];
	$phone = $data['phone'];
	$address = $data['address'];
	$rec_id = $data['id'];
	$date = $data['rec_date'];
}

// PDF Files
$pdf = new PDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetY(20);
$pdf->SetFont('Arial','B',14);
$pdf->Image('img/logo.jpg',90,10,33);
$pdf->Ln(14);
$pdf->Cell(0,7,'JASON VISION COMPANY LTD',0,1 ,'C');
$pdf->SetFont('Arial','I',10);
$pdf->Cell(0,6,'Importers & Wholesales of lab Chemicals, Equipments & Glassware',0,1,'C');
$pdf->Cell(0,6,'Tel:+255687972320/+255745065883, Email:info@jasonvision.co.tz or jasonvision2015@gmail.com,',0,1,'C');
$pdf->Cell(0,6,'Website: www.jasonvision.co.tz, Address: Nkurumah Street near Deluxe, Mwanza Tanzania',0,1,'C');
$pdf->Ln(7);
$pdf->SetFont('Arial','BU',14);
$pdf->Cell(0,6,'Cash Sales Receipt',0,1,'C');
$pdf->Ln(21);

// Customer Address
$pdf->SetFont('Arial','',12);
$pdf->Cell(35,$ln,'Customer Name',0,0);
$pdf->Cell(60,$ln,': '.$name,0,1);
$pdf->Cell(35,$ln,'Phone Number',0,0);
$pdf->Cell(60,$ln,': '.$phone,0,0);

$pdf->Cell(16,$ln,'',0,0);
$pdf->Cell(27,$ln,'Date',1,0,'C');
$pdf->Cell(2,$ln,'',0,0);
$pdf->Cell(25,$ln,'Receipt No',1,0,'C');
$pdf->Cell(2,$ln,'',0,0); 
$pdf->Cell(25,$ln,'Tin No',1,1,'C');

$pdf->Cell(35,$ln,'Address',0,0);
$pdf->Cell(60,$ln,': '.$address,0,0); 

$pdf->Cell(16,$ln,'',0,0);
$pdf->Cell(27,$ln,split_time($date)[0],1,0,'C');
$pdf->Cell(2,$ln,'',0,0);
$pdf->Cell(25,$ln,inv_display($id),1,0,'C');
$pdf->Cell(2,$ln,'',0,0); 
$pdf->Cell(25,$ln,'129-174-803',1,1,'C');

$pdf->Ln($ln);

$pdf->SetFont('Arial','B',12);
$pdf->SetFillColor(123, 126, 177);
$pdf->SetDrawColor(50,50,100);
$pdf->Cell(50,$ln,'Item Name',1,0,'C',1);
$pdf->Cell(50,$ln,'Quantity',1,0,'C',1);
$pdf->Cell(50,$ln,'Price',1,0,'C',1);
$pdf->Cell(40,$ln,'Total',1,1,'C',1);


// Receipt Details
$pdf ->SetFont('Arial','',12);
$pdf ->SetDrawColor(50,50,100);

$query=mysqli_query($conn,"SELECT * FROM sales WHERE rec_id = '$rec_id'");
$total = 0;
while ($data=mysqli_fetch_array($query)) {
	$pdf->Cell(50,$ln,' '.$data['drug_name'],1,0);
	$pdf->Cell(50,$ln,$data['quantity'],1,0,'C');
	$pdf->Cell(50,$ln,$data['price'],1,0,'C');
	$pdf->Cell(40,$ln,($data['quantity'] * $data['price']),1,1,'C');
	$total = $total + ($data['quantity'] * $data['price']);
	$lus += 1;
	$lsp = ($lus > 2  && $lsp != 6) ? $lsp -= 6 : $lsp;
}

$pdf ->SetFont('Arial','B',12);
$pdf ->Cell(150,$ln,"Total Cost",1,0);
$pdf ->Cell(40,$ln,number_format($total,2)." Tsh",1,1,'C');

$pdf->Ln(6);
$pdf ->SetFont('Arial','',12);
$pdf->Cell(35,$ln,'Sales Person : ',0,0);
$pdf->Cell(40,$ln,$_SESSION['name'],0,0);
$pdf->Cell(20,$ln,'',0,0); 
$pdf->Cell(45,$ln,'Signature and Stamp : ',0,0);
$pdf->Cell(40,$ln,'..............................',0,1);

$pdf->Ln($lsp);

$pdf->SetFont('Arial','I',8);
$pdf->Cell(0,6,'TERMS: 1. Goods once sold will not be accepted back  2. Kindly verify each item requested before payments 3. Payments of credit on agreed period.',0,1,'C');
$pdf->Cell(0,6,'will be subjected 10% interest monthly when not paid.',0,1,'C');

$pdf->Cell(0,6,'PAY THROUGH: NMB Kenyatta Road Mwanza  Account Name: JASON VISION COMPANY LTD Account Number: 3111 0029 095,',0,1,'C');
$pdf->Cell(0,6,'M-PESA: 351962 Name Beatrice ANTONIA KITIGA',0,1,'C');
$pdf->Cell(0,6,'Jason vision Company Limited, Tel:+255687972320/+255745065883, Email:info@jasonvision.co.tz, Mwanza Tanzania',0,1,'C');
$pdf ->Output();
?>