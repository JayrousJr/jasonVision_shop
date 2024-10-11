  <script type="text/javascript">
	function CheckAll(){
		l = document.forms[0].length;
		for(i=0;i<l-0;i++)
		{
			document.forms[0].elements[i].checked = true;
		}
	}
	function unCheckAll(){
		l = document.forms[0].length;
		for(i=0;i<l-0;i++)
		{
			document.forms[0].elements[i].checked = false;
		}
	}
	  
</script>

<?php
    include 'connection.php';
      
    mysql_select_db('abel');
    $sql="select * from purchase";
    $records=mysql_query($sql);
     session_start();
   if (!isset($_SESSION['user'])) {
          header("Location:../alert/index.html");
           }else{
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="editdecor.css">
	<link rel="stylesheet" type="text/css" href="tabletext.css">

	<style type="text/css">
		.mytable{border-collapse: collapse; }
		.mytable td{border:1px solid;}
		.mytable tr:nth-child(2n+0){
			background:#A4D1FF;
		}
		.mytable tr:nth-child(2n+1){
			background:#EAF4FF;
		}

	</style>
	<title>Mnagers</title>
</head>
<body class="deco">
<form method="POST">
<table class="mytable" width="100%" border="1" cellpadding="1" cellspacing="1" scrollbar="1">
<tr><th><input type="submit" name="delSel" value="Delete Selected"></th>
<th><a href="javascript:void(0)" onclick="unCheckAll()" class="button1"><b>UnCheckAll</b></a></th>

</tr>
	<tr>
	<th width="5%" align="left"><a href="javascript:void(0)" onclick="CheckAll()" class="button1"><b>CheckAll</b></a></th>
	     <th>S/NO</th>
		<th>Date</th>
		<th>Particulars</th>
		<th colspan="1">Debit Note No</th>
		<th>LF/Ledger Folio</th>
		<th>Details</th>
		<th>Total Amount</th>
		<th colspan="2">Action</th>
		 
	</tr>
	<?php
	$no=1;
	while($customers=mysql_fetch_assoc($records)){
		$id = $customers['id'];
		echo "<tr>";
		echo "<td><input type='checkbox' name='num[]' value='".$id."'></td>";
		echo "<td>".$no."</td>";
		echo "<td>".$customers['date']."</td>";
		echo "<td>".$customers['name']."</td>";
		echo "<td>".$customers['payment']."</td>";
		echo "<td>".$customers['descr']."</td>";
		echo "<td>".$customers['paid']."</td>";
		echo "<td>".$customers['amount']."</td>";
		 
	 		//echo "<td>".$customers['pswd']."</td>";
		echo "<td><a href='editmag.php?id=$id' class='button1'>Edit</a></td>";
		echo "<td><a href='deletepurchase.php?id=$id' class='button'>Delete</a></td>";
		 echo "</tr>";
		$no++; 
	}
}

	?>
</form>
</table>
<?php 
if (isset($_POST['delSel'])) {
	
	$del = $_POST['num'];
	while (list($key,$val) = @each($del)) {
		$deleted=mysql_query("DELETE FROM purchase WHERE id='$val'")or die();
		header("Location:displaypurchase.php");
	}
}

?>
</body>
</html>