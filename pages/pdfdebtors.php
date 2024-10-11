<?php 
require('fpdf/fpdf.php');
 
 
  
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
 	    $this ->Cell(276,10,'Debtors Report',0,0,'C');
 	    $this ->Ln(20);
 	    
 	}

 	    $this ->SetFont('Arial','B',10);
 	    $this ->SetFillColor(180,180,255);
 	    $this ->SetDrawColor(50,50,100);
 	    $this ->Cell(30,5,'First Name',1,0,11,true);
 	    $this ->Cell(30,5,'Middle Name',1,0,11,true);
 	    $this ->Cell(30,5,'Last Name',1,0,11,true);
 	    $this ->Cell(30,5,'Address1',1,0,11,true);
 	    $this ->Cell(25,5,'Address2',1,0,11,true);
 	    $this ->Cell(25,5,'City',1,0,11,true);
 	    $this ->Cell(30,5,'Country',1,0,11,true);
 	    $this ->Cell(30,5,'Debt Amount',1,0,11,true);
 	    $this ->Cell(30,5,'Compliance Date',1,0,11,true);
 	    $this ->Cell(25,5,'Expire Date',1,1,11,true);
 	     
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
 

$query=mysqli_query($con,"SELECT * FROM debtors");
while ($data=mysqli_fetch_array($query)) {

	 
	    $pdf ->Cell(30,5,$data['fname'],1,0);
 	    $pdf ->Cell(30,5,$data['mname'],1,0);
 	    $pdf ->Cell(30,5,$data['lname'],1,0);
 	    $pdf ->Cell(30,5,$data['addr'],1,0);
 	    $pdf ->Cell(25,5,$data['addrr'],1,0);
 	    $pdf ->Cell(25,5,$data['city'],1,0);
 	    $pdf ->Cell(30,5,$data['country'],1,0);
 	    $pdf ->Cell(30,5,$data['dmount'],1,0);
 	    $pdf ->Cell(30,5,$data['codate'],1,0);
 	    $pdf ->Cell(25,5,$data['exdate'],1,1);
	   
 

}

 $pdf ->Output();
 ?>