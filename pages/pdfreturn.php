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
        $this ->Cell(186,5,'Jason Vision Company Limited',0,0,'C');
       
        $this ->Ln();
        $this ->SetFont('Times','',12);
 	    $this ->Cell(186,10,'Sales Return Report',0,0,'C');
 	    $this ->Ln(20);
 	    
 	}
 		function Footer(){
 		$this ->SetY(-15);
 		$this ->SetFont('Arial','',8);
 		$this ->Cell(0,10,'Page'.$this ->PageNo().'/{nb}',0,0,'C');

 	}


 	    $this ->SetFont('Arial','B',10);
 	    $this ->SetFillColor(132, 224, 169);
 	    $this ->SetDrawColor(50,50,100);
 	    $this ->Cell(30,5,'Date',1,0,11,true);
 	    $this ->Cell(30,5,'Particulars',1,0,11,true);
 	    $this ->Cell(35,5,'Debit Note Number',1,0,11,true);
 	    $this ->Cell(25,5,'Quantity',1,0,11,true);
 	    $this ->Cell(30,5,'Details',1,0,11,true);
 	    $this ->Cell(25,5,'Total Amount',1,0,11,true);
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
 $pdf = new PDF('P','mm','A4');
 $pdf ->AliasNbPages('{pages}');
 $pdf ->SetAutoPageBreak(true,15);
 $pdf ->AddPage();


$pdf ->SetFont('Arial','',9);
$pdf ->SetDrawColor(50,50,100);

  
$query=mysqli_query($conn,"SELECT * FROM purchase");
while ($data=mysqli_fetch_array($query)) {

	 
	  $pdf ->Cell(30,5,$data['date'],1,0);
 	    $pdf ->Cell(30,5,$data['name'],1,0);
 	    $pdf ->Cell(35,5,$data['payment'],1,0);
 	    $pdf ->Cell(25,5,$data['descr'],1,0);
 	    $pdf ->Cell(30,5,$data['paid'],1,0);
 	    $pdf ->Cell(25,5,$data['amount'],1,0);
 	    $pdf ->Cell(25,5,$data['user'],1,1);
 	    
	 
 

}

 $pdf ->Output();
 ?>