 <?Php
require "connection.php"; // connection to database 
$count="select * from asset"; // SQL to get 10 records "select * from asset LIMIT 0,10";
require('fpdf/fpdf.php');
$pdf = new FPDF(); 
$pdf->AddPage();

$width_cell=array(20,50,40,40,40);
$pdf->SetFont('Arial','B',16);

$pdf->SetFillColor(193,229,252); // Background color of header 
// Header starts /// 
$pdf->Cell($width_cell[0],10,'CODE',1,0,c,true); // First header column 
$pdf->Cell($width_cell[1],10,'LOCATION',1,0,c,true); // Second header column
$pdf->Cell($width_cell[2],10,'ASSET',1,0,c,true); // Third header column 
$pdf->Cell($width_cell[3],10,'LOCATION',1,0,c,true);
$pdf->Cell($width_cell[4],10,'DATE',1,0,c,true);
$pdf->Cell($width_cell[3],10,'PRICE',1,0,c,true); 
$pdf->Cell($width_cell[3],10,'CATEGORY',1,0,c,true);// Fourth header column
$pdf->Cell($width_cell[4],10,'DISCRIPTION',1,1,c,true); // Third header column 

//// header ends ///////

$pdf->SetFont('Arial','',14);
$pdf->SetFillColor(235,236,236); // Background color of header 
$fill=false; // to give alternate background fill color to rows 

/// each record is one row  ///
foreach ($dbo->query($count) as $row) {
$pdf->Cell($width_cell[0],10,$row['codi'],1,0,C,$fill);
$pdf->Cell($width_cell[1],10,$row['locat'],1,0,L,$fill);
$pdf->Cell($width_cell[2],10,$row['aname'],1,0,C,$fill);
$pdf->Cell($width_cell[3],10,$row['dname'],1,0,C,$fill);
$pdf->Cell($width_cell[4],10,$row['pdate'],1,0,C,$fill);
$pdf->Cell($width_cell[4],10,$row['price'],1,0,C,$fill);
$pdf->Cell($width_cell[4],10,$row['category'],1,0,C,$fill);
$pdf->Cell($width_cell[4],10,$row['descr'],1,1,C,$fill);
$fill = !$fill; // to give alternate background fill  color to rows
}
/// end of records /// 

$pdf->Output();
?>