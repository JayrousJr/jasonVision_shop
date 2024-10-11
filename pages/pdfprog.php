<?php 
require('fpdf/fpdf.php');
 
 
  
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
 	    $this ->Cell(176,10,'Other Programmes Report',0,0,'C');
 	    $this ->Ln(20);
 	    
 	}

 	    $this ->SetFont('Arial','B',10);
 	    $this ->SetFillColor(180,180,255);
 	    $this ->SetDrawColor(50,50,100);
 	    $this ->Cell(30,5,'Date',1,0,11,true);
 	    $this ->Cell(30,5,'Date Due',1,0,11,true);
 	    $this ->Cell(30,5,'Out Date ',1,0,11,true);
 	    $this ->Cell(30,5,'Amount',1,0,11,true);
 	    $this ->Cell(40,5,'Recomendation',1,0,11,true); 
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
 $pdf = new PDF('P','mm','A4');
 $pdf ->AliasNbPages('{pages}');
 $pdf ->SetAutoPageBreak(true,15);
 $pdf ->AddPage();


$pdf ->SetFont('Arial','',9);
$pdf ->SetDrawColor(50,50,100);
 

$con=mysqli_connect("localhost","root",'',"abel") ;
 

$query=mysqli_query($con,"SELECT * FROM prog");
while ($data=mysqli_fetch_array($query)) {

	 
	    $pdf ->Cell(30,5,$data['dat'],1,0);
 	    $pdf ->Cell(30,5,$data['datd'],1,0);
 	    $pdf ->Cell(30,5,$data['odate'],1,0);
 	    $pdf ->Cell(30,5,$data['amnt'],1,0);
 	    $pdf ->Cell(40,5,$data['reco'],1,0);
	    $pdf ->Cell(30,5,$data['user'],1,1);
 

}

 $pdf ->Output();
 ?>