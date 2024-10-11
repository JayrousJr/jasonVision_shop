<?php 
require('fpdf/fpdf.php');
 
 
  
 class PDF extends FPDF
 {
 	
 	function Header()
 	{
        
 		$this ->SetFont('Arial','B',15);
 	    $this ->Cell(12);

 	    //$this ->Image('img/tb.jpg',10,10,10);
 	        
 	    $this ->Cell(100,10,'GCLA Report',0,1);
 	    $this ->Ln(5);

 	    $this ->SetFont('Arial','B',10);
 	    $this ->SetFillColor(180,180,255);
 	    $this ->SetDrawColor(50,50,100);
 	    $this ->Cell(30,5,'Date',1,0,11,true);
 	    $this ->Cell(30,5,'Name',1,0,11,true);
 	    $this ->Cell(30,5,'Pnone',1,0,11,true);
 	    $this ->Cell(80,5,'Description',10,0,11,true);
 	 
 	    $this ->Cell(30,5,'Recorded_By',1,1,11,true);
 	  
 	     
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
 

$con=mysqli_connect("localhost","root",'',"abel") ;
 

$query=mysqli_query($con,"SELECT * FROM market");
while ($data=mysqli_fetch_array($query)) {

	 
	    $pdf ->Cell(30,5,$data['dat'],1,0);
 	    $pdf ->Cell(30,5,$data['name'],1,0);
 	    $pdf ->Cell(30,5,$data['phn'],1,0);
 	    $pdf ->Cell(80,5,$data['tex'],10,0);
 	   
 	    $pdf ->Cell(30,5,$data['user'],1,1);
	   
 

}

 $pdf ->Output();
 ?>