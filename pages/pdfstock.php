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
        $this ->Cell(276,5,'Jason Vision Company Limited',0,0,'C');
       
        $this ->Ln();
        $this ->SetFont('Times','',12);
 	    $this ->Cell(276,10,'Stock Report',0,0,'C');
 	    $this ->Ln(20);
 	    
 	}
 	// 	function Footer(){
 	// 	$this ->SetY(-15);
 	// 	$this ->SetFont('Arial','',8);
 	// 	$this ->Cell(0,10,'Page'.$this ->PageNo().'/{nb}',0,0,'C');

 	// }

 	    $this ->SetFont('Arial','B',10);
 	    $this ->SetFillColor(132, 224, 169);
 	    $this ->SetDrawColor(50,50,100);
 	    $this ->Cell(30,5,'Item Name',1,0,11,true);
 	    $this ->Cell(30,5,'Supplier',1,0,11,true);
 	    $this ->Cell(20,5,'Batch No.',1,0,11,true);
 	    $this ->Cell(30,5,'Category',1,0,11,true);
 	    $this ->Cell(30,5,'Supplier Contact',1,0,11,true);
 	    $this ->Cell(20,5,'Quantity',1,0,11,true);
 	    
 	    $this ->Cell(30,5,'Expire Date',1,0,11,true);
 	   
 	    $this ->Cell(30,5,'Manufacturer',1,0,11,true);
 	  
 	    $this ->Cell(25,5,'Recorded_By',1,1,11,true);
 	}
 	

 	function Footer(){
 		//add table bottom line
 		//$this ->Cell(190,0,'','T',1,'',true);



 		$this ->SetY(-15);
 		$this ->SetFont('Arial','',8);
 		$this ->Cell(0,10,'Page'.$this ->PageNo()."/{pages}",0,0,'C');

 	}
 	


 }
 $pdf = new PDF('L','mm','A4');
 $pdf ->AliasNbPages('{pages}');
 $pdf ->SetAutoPageBreak(true,15);
 $pdf ->AddPage();


$pdf ->SetFont('Arial','',9);
$pdf ->SetDrawColor(50,50,100);


  
$query=mysqli_query($conn,"SELECT * FROM stock");
while ($data=mysqli_fetch_array($query)) {

	 
	    $pdf ->Cell(30,5,$data['dname'],1,0);
 	    $pdf ->Cell(30,5,$data['gname'],1,0);
 	    $pdf ->Cell(20,5,$data['batch'],1,0);
 	    $pdf ->Cell(30,5,$data['category'],1,0);
 	    $pdf ->Cell(30,5,$data['dosage'],1,0);
 	    $pdf ->Cell(20,5,$data['quantity'],1,0);
 	   
 	    $pdf ->Cell(30,5,$data['exdate'],1,0);
 	   
 	    $pdf ->Cell(30,5,$data['mprice'],1,0);
 	  
 	    $pdf ->Cell(25,5,$data['user'],1,1);
	 
 

}

 $pdf ->Output();
 ?>