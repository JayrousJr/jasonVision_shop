<?php 
//echo "Asset Disposal"; exit;
ob_start();
include('connection.php');
  
 session_start();
$id = $_GET['sales_id'];


if(isset($id))
{
	//echo"the id to be disposed is $id"; exit;
	//STEP1: Extract the data
	$assetquery = mysqli_query($conn,"SELECT * FROM credit WHERE sales_id='$id'");
	while($row = mysqli_fetch_assoc($assetquery)){
		$id = $row['sales_id'];
	  $drug_name=$row['drug_name'];
      $quantity=$row['quantity'];
      $price=$row['price'];
      $total=$row['total'];
      $soldby=$row['soldby'];
      $sale_date=$row['sale_date'];


		}
		

	//STEP2: Save the data into other table
		
 $query="INSERT INTO sales (drug_name,quantity,price,total,soldby,sale_date ) 
 VALUES('$drug_name','$quantity','$price','$total','$soldby','$sale_date' )";

@$result=mysqli_query($conn,$query);
	//STEP3: Delete the data from Original Table if The data is successifuly inserted
	//into disposal table
if($result)
    {

     mysqli_query($conn,"DELETE FROM credit WHERE sales_id='$id'")or die();
     echo "<font colour=\'red\' size=\'4\'>Item Paid successifuly </font>"; 

     header("Location:creditsales.php");
    
		die();
   
} else{
     echo "<font colour=\'red\' size=\'4\'>Item Disposal Failed </font>"; 
}

 

}
ob_end_flush();
?>