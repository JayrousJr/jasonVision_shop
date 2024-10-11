<?php
  include 'includes/guard.php';
  include 'includes/func.inc.php'; 
    

  if (isset($_POST['sav'])){

    $iname=$_POST['iname']; 
    $supplier=$_POST['supplier']; 
    $batch=$_POST['batch'];
    $category=$_POST['category'];
    $supcont=$_POST['supcont'];
    $qty=$_POST['qty'];
    $edate=$_POST['edate'];
    $bdate=$_POST['bdate'];
    $scontry=$_POST['scontry'];
    $descr=$_POST['descr'];
    $user = $_SESSION['userName'];

 
   $query="INSERT INTO blockitems (iname,supplier,batch,category,supcont,qty,edate,bdate,scontry,descr,user) VALUES
 ('$iname','$supplier','$batch','$category','$supcont','$qty','$edate','$bdate','$scontry','$descr','$user')";

    @$result=mysqli_query($conn,$query);
      if($result){
         $msg = "<strong>Success: </strong>Block Item Recorded Successfully!";
         $alert = 'success';
      }
    
  } 

    // HEADER
    include 'includes/header.php';
?>
<body id="gu">
    <!-- topbar starts -->
    <?php include 'includes/navbar.php' ?>
    <!-- topbar ends -->
<div class="ch-container">
    <div class="row">
        
        <!-- left menu starts -->
        <div class="col-sm-2 col-lg-2">
            <?php include 'includes/side-navs.php' ?>
        </div>
        <!--/span-->
        <!-- left menu ends -->

       <form method="POST" class="form-group">

        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
            <div class="row">
     <div class="col-md-12" >
        <center><h3>Jason Vision Management System</h3></center><hr> 
        <?php include 'includes/inc/breadcrumb.php'; ?> 
       
       <?php if (isset($msg) && $msg != ''): ?>
          <div class="alert alert-<?php echo $alert; ?> alert-dismissible text-center" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $msg; ?>
          </div>
       <?php endif ?>
       </div>
    </div>


<!--box form start-->
<div class="row">
      <div class="box col-md-12" >
        <div class="box-inner homepage-box" id="su">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-save"></i>Blocked Items</h2>
 
                <div class="box-icon">
                    
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
              
 <br>
    

    <div class="row" style="margin-left:5px; ">
     <div class="col-md-12">


        <div class="col-md-3">                    
<a href="viewblock.php"><input type="button" value="View Blocked Items" class="btn btn-primary btn-sm"></a> <br><br>
<a href="searchblock.php"><input type="button" value="Search Blocked Items By Date" class="btn btn-info btn-sm"></a> 
   </div>
<form method="POST" class="form-group">
<div class="col-md-2"><b>Item Name:</b><br><input type="text" name="iname" class="form-control" required></div>
     <div class="col-md-2"><b>Supplier:</b><br><input type="text" name="supplier" class="form-control" required></div>
<div class="col-md-2"><b>Batch No:</b><br><input type="number" name="batch" class="form-control" ></div>
     </div>
     </div><br>

     <div class="row" style="margin-left:5px; ">
     <div class="col-md-12">
        <div class="col-md-3"></div>
         <div class="col-md-2"><b>Category:</b><br><select id="sele" name="category" class="form-control">
            <option></option>
            <option>Litre</option>
            <option>Carton</option>
            <option>Piece</option>
            <option>Packet</option>
            <option>Kilogram</option>
            <option>Mills</option>
            <option>Grams</option>
            <option>Box</option>
        </select></div>
<div class="col-md-2"><b>Supplier_Contact:</b><br>
  <input type="text" name="supcont" id="sele" class="form-control" required>
   
   </div>
 <div class="col-md-2"><b>Quantity:<br><input type="number" name="qty" class="form-control" required>
         </div>
     </div>
     </div><br>

     <div class="row" style="margin-left:5px; ">
     <div class="col-md-12">
        <div class="col-md-3"></div>
          <div class="col-md-2">Entry Date:<br><input type="date" name="edate" class="form-control" required></div>
     <div class="col-md-2">Blocked Date:<br><input type="date" name="bdate" class="form-control" required> </div>
     <div class="col-md-2">  Supplier Country:<br> <input type="text" name="scontry" class="form-control" required></div>
     </div>
     </div><br>

 
        <div class="row" style="margin-left:5px; ">
     <div class="col-md-12">
        <div class="col-md-3"></div>
          <div class="col-md-6">
            Description:<br> 
      <textarea name="descr" id="sele" class="form-control" required></textarea>
          </div>
     <div class="col-md-2"> </div>
     <div class="col-md-1"> </div>
     </div>
     </div>
         <div class="row" style="margin-left:5px; ">
     <div class="col-md-12">
        <div class="col-md-3"></div>
          <div class="col-md-2">

          </div>
     <div class="col-md-2">
      
      </div>
     <div class="col-md-2"> </div>
         <div class="col-md-2"> </div>
     </div>
     </div>
       <div class="row" style="margin-left:5px; ">
     <div class="col-md-12">
        <div class="col-md-5">

        </div>
          <div class="col-md-3">
            <br><br><input type="reset" name="" value="Clear" class="btn btn-danger"> 
                    <input type="submit" name="sav" value="Save"   class="btn btn-info">
          </div>
     <div class="col-md-2"> </div>
     <div class="col-md-1"> </div>
     </div>
     </div>
     </div>
     <div class="row">

            
</div>
</div>
</div>
</div>

    

     <div class="row">
     <div class="col-md-4"></div>
     </div>
 <div class="row">
     <div class="col-md-4"></div>
     </div>
 
       </form> 
            </div>
        </div>
    </div>
    <!--box form end-->

  </form>
</div><!--/fluid-row-->
<script type="text/javascript">
  if (window.history.replaceState) {
    window.history.replaceState(null,null,window.location.href);
  }
</script>
   <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to Log Out?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
               
            </button>
          </div>
          <div class="modal-body">Select "Logout" below to End Up the session.</div>
          <div class="modal-footer">
            <button class="btn btn-primary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-danger" href="logout.php">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Ad ends -->
<hr>
<?php include 'includes/inc/footer.php'; ?>