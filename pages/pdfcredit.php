<?php 
require('fpdf/fpdf.php');
include 'includes/dbh.php';
 
  
 class PDF extends FPDF
 {
 	
 	function Header()
 	{

 			{
       // $this ->Image('img/tb.jpg',10,10,10);
        $this ->SetFont('Arial','B',14);
       $this ->Cell(176,5,'Jason Vision Company Limited',0,0,'C');
        $this ->Ln();
        $this ->SetFont('Times','',12);
 	    $this ->Cell(176,10,'Credit Sales Report',0,0,'C');
 	    $this ->Ln(10);
 	    
 	}
 		$cone = mysqli_connect("localhost","root","","abel");
 	   $result = mysqli_query($cone,"SELECT sum(total) FROM credit") or die(mysqli_error());
        while ($rows = mysqli_fetch_array($result)) {
        $this ->Cell(176,10,'Total Credit Sales Tsh:',0,0,'C');
        $this ->Ln(5);
        $this ->Cell(176,10,$rows['sum(total)'],0,0,'C');
        	}
        	$this ->Ln(10);
 	 

 	    $this ->SetFont('Arial','B',10);
 	    $this ->SetFillColor(132, 224, 169);
 	    $this ->SetDrawColor(50,50,100);
 	    $this ->Cell(30,5,'Item Name',1,0,11,true);
 	    $this ->Cell(10,5,'Qty',1,0,11,true);
 	    $this ->Cell(25,5,'Price',1,0,11,true);
 	    $this ->Cell(30,5,'Total',1,0,11,true);
 	 
 	    $this ->Cell(35,5,'Sold By',1,0,11,true);
 	      // $this ->Cell(35,5,'Customer Name',1,0,11,true);
 	      //   $this ->Cell(35,5,'Customer Phone',1,0,11,true);
 	    $this ->Cell(25,5,'Sale Date',1,1,11,true);
 	}

 	function Footer(){
 		//add table bottom line
 		//$this ->Cell(190,0,'','T',1,'',true);



 		$this ->SetY(-15);
 		$this ->SetFont('Arial','',8);
 		$this ->Cell(0,10,'Page'.$this ->PageNo()."/{pages}",0,0,'C');

 	}
 	


 }
 $pdf = new PDF('P','mm','A4');
 $pdf ->AliasNbPages('{pages}');
 $pdf ->SetAutoPageBreak(true,15);
 $pdf ->AddPage();


$pdf ->SetFont('Arial','',9);
$pdf ->SetDrawColor(50,50,100);

  
$query=mysqli_query($conn,"SELECT * FROM credit");
while ($data=mysqli_fetch_array($query)) {

	 
	  $pdf ->Cell(30,5,$data['drug_name'],1,0);
 	    $pdf ->Cell(10,5,$data['quantity'],1,0);
 	    $pdf ->Cell(25,5,$data['price'],1,0);
 	    $pdf ->Cell(30,5,$data['total'],1,0);
 	   
 	    $pdf ->Cell(35,5,$data['soldby'],1,0);
 	    // $pdf ->Cell(35,5,$data['cust_name'],1,0);
 	    // $pdf ->Cell(35,5,$data['cust_phone'],1,0);
 	    $pdf ->Cell(25,5,$data['sale_date'],1,1);
	 
 

}

 $pdf ->Output();
 ?>