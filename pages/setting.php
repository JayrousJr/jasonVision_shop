<?php include 'includes/guard.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
     
    <meta charset="utf-8">
    <title>Jason Vision</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="author" content="Sudi Ahmad">

    <!-- The styles -->
    <link id="bs-css" href="css/bootstrap-cerulean.min.css" rel="stylesheet">

    <link href="css/charisma-app.css" rel="stylesheet">
    <link href='bower_components/fullcalendar/dist/fullcalendar.css' rel='stylesheet'>
    <link href='bower_components/fullcalendar/dist/fullcalendar.print.css' rel='stylesheet' media='print'>
    <link href='bower_components/chosen/chosen.min.css' rel='stylesheet'>
    <link href='bower_components/colorbox/example3/colorbox.css' rel='stylesheet'>
    <link href='bower_components/responsive-tables/responsive-tables.css' rel='stylesheet'>
    <link href='bower_components/bootstrap-tour/build/css/bootstrap-tour.min.css' rel='stylesheet'>
    <link href='css/jquery.noty.css' rel='stylesheet'>
    <link href='css/noty_theme_default.css' rel='stylesheet'>
    <link href='css/elfinder.min.css' rel='stylesheet'>
    <link href='css/elfinder.theme.css' rel='stylesheet'>
    <link href='css/jquery.iphone.toggle.css' rel='stylesheet'>
    <link href='css/uploadify.css' rel='stylesheet'>
    <link href='css/animate.min.css' rel='stylesheet'>
    <link href='tooltip/tooltip-viewport.css' rel='stylesheet'>
        <script type="text/javascript" src="tooltip/tooltip-viewport.js"></script>

    <style type="text/css">
      input[type=text],input[type=number] ,input[type=date],input[type=password],option{
    background-color:#73aaef;
    color:black;
    border-color: ;
}
#sele{
   background-color:#73aaef;
    color:black;
}
    </style>
     <style type="text/css">
        .mytable{
            border-collapse: collapse; 
        }
        .mytable td{
            border:1px solid;
        }
        .mytable tr:nth-child(2n+0){
            background:#A4D1FF;
        }
        .mytable tr:nth-child(2n+1)
        {
            background:#EAF4FF;
        }
        #table{
    height: 300px;
   // border: 1px solid black;
    overflow: hidden;
    overflow-y: scroll;
}
    #gu{
        overflow-y: scroll;
      }
#table table,th,td{
    border: 1px solid;
    border-collapse: collapse;
}
 .scroll-table-container {
border:2px solid green; 
height: 300px; 
overflow: scroll;
}
.scroll-table, td, th {
border-collapse:collapse; 
border:1px solid #777; 
min-width: 300px;}
#saa{
  margin-top: 15px;
}
    </style>

    <!-- jQuery -->
    <script src="bower_components/jquery/jquery.min.js"></script>
    <script language="javascript">
var popupWindow = null;
function centeredPopup(url,winName,w,h,scroll){
LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
settings =
'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
popupWindow = window.open(url,winName,settings)
}
</script>
    <script>  
    function   sayOuch(){
    //Don't Click function
    //Andy Harris
    //demonstrates use of functions
    document.bgColor = "red";
    alert ("Record Added Successfully");
    document.bgColor = "white";
    
    }
    </script>

     <!--time-->
 <script language="javascript" type="text/javascript">
        /* Visit http://www.yaldex.com/ for full source code
and get more free JavaScript, CSS and DHTML scripts! */
        <!-- Begin
        var timerID = null;
        var timerRunning = false;
        function stopclock (){
            if(timerRunning)
                clearTimeout(timerID);
            timerRunning = false;
        }
        function showtime () {
            var now = new Date();
            var hours = now.getHours();
            var minutes = now.getMinutes();
            var seconds = now.getSeconds()
            var timeValue = "" + ((hours >12) ? hours -12 :hours)
            if (timeValue == "0") timeValue = 12;
            timeValue += ((minutes < 10) ? ":0" : ":") + minutes
            timeValue += ((seconds < 10) ? ":0" : ":") + seconds
            timeValue += (hours >= 12) ? " P.M." : " A.M."
            document.clock.face.value = timeValue;
            timerID = setTimeout("showtime()",1000);
            timerRunning = true;
        }
        function startclock() {
            stopclock();
            showtime();
        }
        window.onload=startclock;
        // End -->
    </script> 
<!--end time-->

    <!-- The fav icon -->
    <link rel="shortcut icon" href="img/logo.png">

</head>

<body id="gu">
    <!-- topbar starts -->
     <div class="navbar navbar-default" role="navigation">

        <div class="navbar-inner">
            <button type="button" class="navbar-toggle pull-left animated flip">
                <span class="sr-only"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href=" ">  
                <span>Jason Vision</span></a>

            <!-- user dropdown starts -->
             <div class="btn-group pull-right">
           <button class="btn btn-default" data-toggle="modal"><a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="glyphicon glyphicon-log-out"></i>Logout</a></button>
                  
            </div>
            <!-- user dropdown ends -->

            <!-- theme selector starts -->
            <div class="btn-group pull-right theme-container animated tada">
                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-tint"></i><span
                        class="hidden-sm hidden-xs"> Change Color</span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" id="themes">
                    <li><a data-value="classic" href="#"><i class="whitespace"></i> Classic</a></li>
                    <li><a data-value="cerulean" href="#"><i class="whitespace"></i> Cerulean</a></li>
                    <li><a data-value="cyborg" href="#"><i class="whitespace"></i> Cyborg</a></li>
                    <li><a data-value="simplex" href="#"><i class="whitespace"></i> Simplex</a></li>
                    <li><a data-value="darkly" href="#"><i class="whitespace"></i> Darkly</a></li>
                    <li><a data-value="lumen" href="#"><i class="whitespace"></i> Lumen</a></li>
                    <li><a data-value="slate" href="#"><i class="whitespace"></i> Slate</a></li>
                    <li><a data-value="spacelab" href="#"><i class="whitespace"></i> Spacelab</a></li>
                    <li><a data-value="united" href="#"><i class="whitespace"></i> United</a></li>
                </ul>
            </div>
            <!-- theme selector ends -->

            <ul class="collapse navbar-collapse nav navbar-nav top-menu">
              
               <li class="dropdown">
                    <a href="#" data-toggle="dropdown"><i class="glyphicon glyphicon-link"></i>  Reports 1 <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="pdfsales.php">Cash Sales Report</a></li>
                         <li class="divider"></li>
                         <li><a href="pdfcredit.php">Credit Sales Report</a></li>
                         <li class="divider"></li>
                        <li><a href="pdfexpenses.php">Expenses Report</a></li>
                         <li class="divider"></li>
                        <li><a href="pdfreturn.php">Sales Return Report</a></li>
                        <li class="divider"></li>
                        <li><a href="pdfasset.php">Asset Report</a></li>
                        <li class="divider"></li>
                        <li><a href="pdfstock.php">Stock Report</a></li>
                         <li class="divider"></li>
                        <li><a href="pdfemployee.php">Employees Report</a></li>
                          <li class="divider"></li>
                        <li><a href="pdfdisposal.php">Disposable Asset</a></li>
                         <li class="divider"></li>
                         <li><a href="pdfcust.php">Customer Report</a></li>
                          <li class="divider"></li>
                          <li><a href="pdfdebtors.php">Debtors Report</a></li>
                  
                    </ul>
                </li>

               <li class="dropdown">
                    <a href="#" data-toggle="dropdown"><i class="glyphicon glyphicon-link"></i>  Reports 2<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                    
                           
                           <li><a href="pdfgpsa.php">GPSA Report</a></li>
                            <li class="divider"></li>
                            <li><a href="pdflicence.php">Licence Report</a></li>
                             <li class="divider"></li>
                             <li><a href="pdfloan.php">Loan Report</a></li>
                              <li class="divider"></li>
                              <li><a href="pdfprog.php">Programmes Report</a></li>
                               <li class="divider"></li>
                               <li><a href="pdfsalary.php">Salary Report</a></li>
                                <li class="divider"></li>
                                <li><a href="pdftra.php">Revenue/TRA Reports</a></li>
                                 <li class="divider"></li>
                                  <li><a href="pdfgcla.php">GCLA Reports</a></li>
                    </ul>
                </li>
                    <li class="dropdown">
                    <a href="#" data-toggle="dropdown"><i class="glyphicon glyphicon-hand-down"></i>Other Programmes<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="debtors.php">Add Debtors</a></li>
                         <li class="divider"></li>
                        <li><a href="salary.php">Salary</a></li>
                         <li class="divider"></li>
                        <li><a href="licence.php">Add Licence</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Add Revenue/TRA</a></li>
                        <li class="divider"></li>
                        <li><a href="prog.php">Add Programmes</a></li>
                         <li class="divider"></li>
                        <li><a href="gpsa.php">GPSA Records</a></li>
                          <li class="divider"></li>
                        <li><a href="loan.php">Add Loans</a></li>
                        <li class="divider"></li>
                        <li><a href="customers.php">Add Customers</a></li>
                        <li class="divider"></li>
                        <li><a href="rent.php">Add Rent</a></li>
                        <li class="divider"></li>
                        <li><a href="bank.php">Add Bank</a></li>
                        <li class="divider"></li>
                         <li><a href="gcla.php">GCLA</a></li>
                          <li class="divider"></li>
                         <li><a href="market.php">Marketing</a></li>
                    </ul>
                </li>
                      <li class="dropdown">
                    <a href="#" data-toggle="dropdown"><i class="glyphicon glyphicon-hand-down"></i>
                        <font color="black">View Records</font><span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="viewdebtors.php">Debtors</a></li>
                         <li class="divider"></li>
                        <li><a href="viewsalary.php">Salary</a></li>
                         <li class="divider"></li>
                        <li><a href="viewlicence.php">Licence</a></li>
                        <li class="divider"></li>
                        <li><a href="viewtra.php">Revenue/TRA</a></li>
                        <li class="divider"></li>
                        <li><a href="viewprog.php">Programmes</a></li>
                         <li class="divider"></li>
                        <li><a href="viewgpsa.php">GPSA Records</a></li>
                          <li class="divider"></li>
                        <li><a href="viewloan.php">Loans</a></li>
                        <li class="divider"></li>
                        <li><a href="viewcust.php">Customers</a></li>
                          <li class="divider"></li>
                        <li><a href="viewrent.php">Rent</a></li>
                          <li class="divider"></li>
                        <li><a href="viewbank.php">Bank Statement</a></li>
                         <li class="divider"></li>
                        <li><a href="viewgcla.php">GCLA</a></li>
                          <li class="divider"></li>
                        <li><a href="viewmark.php">Marketing Records</a></li>

                    </ul>
                </li>
               
                     <li>
                 <form name="clock" id="saa">
                    <input  class="glyphicon glyphicon-user btn btn-danger " id="trans" type="submit"  name="face" value="" >
                </form>
            </li>
                 <li>
 
 
                     
                </li>
                 <li> <a href=""><button class="glyphicon glyphicon-user btn btn-danger"><?php
            if (isset($_SESSION['user'])) {
                echo "Hello!..Welcome: ".$_SESSION['userName'];
            }
            ?></button></a></li>
            </ul>
        </div></div>
    </div>
    <!-- topbar ends -->
<div class="ch-container-fluid">
    <div class="row">
        
        <!-- left menu starts -->
        <div class="col-sm-2 col-lg-2">
            <div class="sidebar-nav">
                <div class="nav-canvas">
                    <div class="nav-sm nav nav-stacked">

                    </div>
                    <ul class="nav nav-pills nav-stacked main-menu">
                        <li class="nav-header"></li>
                        <li><a class="ajax-link" href="Admin.php"><i class="glyphicon glyphicon-home"></i><span> Dashboard</span></a>
                        </li>
                        <li><a class="ajax-link" href="sales.php"><i class="glyphicon glyphicon-shopping-cart"></i><span>Add Cash Sales</span></a>
                        </li>
                         <li><a class="ajax-link" href="credit2.php"><i class="glyphicon glyphicon-shopping-cart"></i><span>Add Credit Sales</span></a>
                        </li>
                        <li><a class="ajax-link" href="stock.php"><i
                                    class="glyphicon glyphicon-edit"></i><span>Add Stock</span></a></li>

                        <li><a class="ajax-link" href="managers.php"><i class="glyphicon glyphicon-user"></i><span>Add Jason Vision Staff</span></a>
                        </li>

                        <li><a class="ajax-link" href="asset.php"><i class="glyphicon glyphicon-share"></i><span>Asset Register</span></a>
                        </li>
                         <li class="accordion">
                            <a href="#"><i class="glyphicon glyphicon-share-alt"></i><span>Reports</span></a>
                            <ul class="nav nav-pills nav-stacked">
                        <li><a href="pdfsales.php">Sales Report</a></li>
                         <li class="divider"></li>
                        <li><a href="pdfexpenses.php">Expenses Report</a></li>
                         <li class="divider"></li>
                        <li><a href="pdfreturn.php">Purchase Return Report</a></li>
                        <li class="divider"></li>
                        <li><a href="pdfasset.php">Asset Report</a></li>
                        <li class="divider"></li>
                        <li><a href="pdfstock.php">Stock Report</a></li>
                         <li class="divider"></li>
                        <li><a href="pdfemployee.php">Employees Report</a></li>
                          <li class="divider"></li>
                        <li><a href="pdfdisposal.php">Disposable Asset</a></li>   
                            </ul>
                        </li>
                        <li><a class="ajax-link" href="disposable.php"><i class="glyphicon glyphicon-compressed"></i><span>Disposaable Assets</span></a>
                        </li>
                        <li><a class="ajax-link" href="Jason Vision system.php"><i
                                    class="glyphicon glyphicon-user"></i><span>Manage All Users</span></a></li>
                             <li class="accordion">
                            <a href="#"><i class="glyphicon glyphicon-search"></i><span>Search By Date/Name</span></a>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="searchstock.php">Stock</a></li>
                                <li><a href="#">Sales</a></li>
                                <li><a href="#">Return Inward</a></li>
                                 <li><a href="#">Expenses</a></li>
                                 <li><a href="searchasset.php">Asset</a></li>
                                 <li><a href="#">Staff</a></li>
                            </ul>
                        </li>
                       
                        <li class="accordion">
                            <a href="#"><i class="glyphicon glyphicon-plus"></i><span>Stock Reports</span></a>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Stock In</a></li>
                                <li><a href="#">Stock Out</a></li>
                                <li><a href="#">Puchases</a></li>
                                 <li><a href="#">Current Stock</a></li>
                            </ul>
                        </li>
                         <li class="accordion">
                            <a href="#"><i class="glyphicon glyphicon-plus"></i><span>Sales Reports</span></a>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Sales By Date</a></li>
                                <li><a href="#">All Sales</a></li>
                                
                            </ul>
                        </li>
                       
                        <li><a href="expense.php"><i class="glyphicon glyphicon-globe"></i><span>Expense Management</span></a></li>
                        <li><a class="ajax-link" href="purchase.php"><i
                                    class="glyphicon glyphicon-star"></i><span>Purchase Return</span></a></li>
                         
                        
                    </ul>
                     
                </div>
            </div>
        </div>
        <!--/span-->
        <!-- left menu ends -->

       <form method="POST" class="form-group">

        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
            <div class="row">
     <div class="col-md-12" >
       <div class="date">
                <i class="glyphicon glyphicon-calendar"></i>
                <?php
                $Today = date('y:m:d');
                $new = date('l, F d, Y', strtotime($Today));
                echo $new;
                ?>
            </div>
      <hr>
            <center><h3>Jason Vision Management System</h3></center><hr>
       </div>
</div>


<!--box form start-->
      <div class="box col-md-12" style="background-color:">
        <div class="box-inner homepage-box">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-user"></i>New User Creation</h2>

                <div class="box-icon">
                      <a   class="btn btn-setting btn-round btn-default"   data-toggle="tooltip" title="Edit & Delete Users" class=""  href="displaypaswd.php"  onclick="centeredPopup(this.href,'myWindow','900','580','yes');return false");><i
                            class="glyphicon glyphicon-cog"></i></a>
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
              
   <div class="col-md-12 ">


      <div class="row">
   
       <div class="col-md-2"></div>
      <div class="col-md-3"></div>
      <div class="col-md-3 "><br>
           
       <b> Username:</b><br>
          <input type="text" name="uname" class="form-control" required>
      </div> </div><br>
         <div class="row">
           <div class="col-md-2"></div>
      <div class="col-md-3"></div>
      <div class="col-md-3">
        <b>Password:</b><br>
           <input type="password" name="cpsw" class="form-control" required>
      </div></div> <br>
         <div class="row">
           <div class="col-md-2"></div>
      <div class="col-md-3"></div>
      <div class="col-md-3">
        <b>Status:</b><br>
          <select name="status" id="sele" class="form-control " required>
            <option></option>
              <option>Director</option>
          <option>Manager</option>
            <option>Employee</option>
              <option>Accountant</option>
          </select>
      </div></div> <br>
         <div class="row">
           <div class="col-md-2"></div>
      <div class="col-md-3"></div>
              <div class="col-md-3">
      <center><input type="reset" name="" value="Clear" class="btn btn-danger"> 
                    <input type="submit" name="sav" value="Save" onclick="return mess();"  class="btn btn-info">
                </center></div></div><br>
                
  <?php   
if (isset($_POST['sav'])){

    $id=$_POST['uname']; 
    /*$fn=md5($_POST['cpsw']);*/
    $fn=$_POST['cpsw'];
    $ln=$_POST['status'];


    if(strlen($fn) < 5){
      echo "<script>alert('Password is too short')</script>";
    }elseif(!preg_match('/^[A-Za-z]*$/', $id)){
        echo "<script>alert('Username is incorrect')</script>";
    }else{
    $check = mysql_query("SELECT * FROM staff WHERE cpsw = '$fn'");
    if (mysql_num_rows($check) > 0)
     {
     
    print "<font  color=\"red\" size=\"4\">Password is already exist </font>";
    }
    
   else{
    $query="INSERT INTO staff(uname,cpsw,status) VALUES
     ('$id','$fn','$ln')";

    @$result=mysql_query($query);
    if($result)
      {
       
    
  header("Location:setting.php");
  exit();
    }
  }
}
}

?>

 
     </div>
<script type="text/javascript">
  function mess(){
 
  return true;
}
</script>
     <div class="row">
     <div class="col-md-4"></div>
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

<div class="row" >
 
</div>


  </form>
 

  
</div><!--/fluid-row-->

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
   <footer class="row">
        <p class="col-md-9 col-sm-9 col-xs-12 copyright" align="right">&copy; <a href="" target="_blank" >Sudi
                Ahmad</a>2018</p>

         
    </footer> 

</div><!--/.fluid-container-->

<!-- external javascript -->

<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- library for cookie management -->
<script src="js/jquery.cookie.js"></script>
<!-- calender plugin -->
<script src='bower_components/moment/min/moment.min.js'></script>
<script src='bower_components/fullcalendar/dist/fullcalendar.min.js'></script>
<!-- data table plugin -->
<script src='js/jquery.dataTables.min.js'></script>

<!-- select or dropdown enhancer -->
<script src="bower_components/chosen/chosen.jquery.min.js"></script>
<!-- plugin for gallery image view -->
<script src="bower_components/colorbox/jquery.colorbox-min.js"></script>
<!-- notification plugin -->
<script src="js/jquery.noty.js"></script>
<!-- library for making tables responsive -->
<script src="bower_components/responsive-tables/responsive-tables.js"></script>
<!-- tour plugin -->
<script src="bower_components/bootstrap-tour/build/js/bootstrap-tour.min.js"></script>
<!-- star rating plugin -->
<script src="js/jquery.raty.min.js"></script>
<!-- for iOS style toggle switch -->
<script src="js/jquery.iphone.toggle.js"></script>
<!-- autogrowing textarea plugin -->
<script src="js/jquery.autogrow-textarea.js"></script>
<!-- multiple file upload plugin -->
<script src="js/jquery.uploadify-3.1.min.js"></script>
<!-- history.js for cross-browser state change on ajax -->
<script src="js/jquery.history.js"></script>
<!-- application script for Charisma demo -->
<script src="js/charisma.js"></script>
</body>
</html>

