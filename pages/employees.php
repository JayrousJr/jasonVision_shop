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
     <link rel="stylesheet" type="text/css" href="js/jquery.dataTables.min.js">
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
     <style>
#customers {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;

}

#customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;

}

#customers tr:nth-child(even){
    background-color: #f2f2f2;
}

#customers tr:hover {
    background-color: #ddd;
}

#customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #0b72e0;
    color: white;

}
    #gu{
        overflow-y: scroll;
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

    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

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
<div class="ch-container">
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
                                 <li><a href="searchsales.php">Sales</a></li>
                              <li><a href="searchasset.php">Asset</a></li>
                            </ul>
                        </li>
                        
                        
                       
                        <li><a href=""><i class="glyphicon glyphicon-globe"></i><span>Expense Management</span></a></li>
                        <li><a class="ajax-link" href="purchase.php"><i
                                    class="glyphicon glyphicon-star"></i><span>Purchase Return</span></a></li>
                         
                        
                    </ul>
                     
                </div>
            </div>
        </div>
        <!--/span-->
        <!-- left menu ends -->

      

        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
            <div class="row">
     <div class="col-md-12" ><hr>
            <center><h3>Jason Vision Management System</h3></center><hr>
       </div>
</div>
<div class=" row"><form method="POST">
      <center><p><b>Point Of Sales</b></p>
     <div class="container">
<div class="col-md-5 input-group">
    <input type="text" name="sach" class="query form-control" placeholder="Search for Medicine..." />
      <span class="input-group-btn">
        <button class="btn btn-search btn-danger" type="submit" name="submit"><i class="fa fa-search fa-fw"></i> Search</button>
      </span>
</div>
</div>
<br>
 </center></form>
 <center>
     <?php
$output = '';

if (isset($_POST['submit'])) {

    $search = $_POST['sach'];
    //$search = preg_replace("#[^)0-9a-z]#i", "", $search);
    $query = mysql_query("SELECT * FROM stock WHERE dname LIKE '$search%'") or die("could not search");
    $count =mysql_num_rows($query);
    if ($count == 0) {
        echo " <font color=\"red\" size=\"4\">There is no search results!</font>";
    }

    else{

        ?>


     <center><div  >
        <table id="customers"   >
            <thead>
            <tr >
                <th width="10%" >S/NO</th>
                <th width="20%" >Drug_Name</th>
                <th width="20%" >Generic_Name</th>
                <th width="15%" >Category</th>
                <th width="20%" >Price</th>
                <th width="15%" >Current_Stock</th>
                <th width="10%" >Action</th>
            </tr>
</thead>
        <?php
        $no=1;
           while ($row = mysql_fetch_array($query)) {
            $did = $row['dID'];
            $dname= $row['dname'];
            $gname= $row['gname'];
            $category= $row['category'];
            $sprice= $row['sprice'];
            $quantity= $row['quantity'];
            $output .= '<div>' .$dname.''.$gname.'</div>';


            ?>

           <tbody> <tr><td><?php echo $no ?></td>
                <td><?php echo $dname; ?></td>
                <td><?php echo $gname; ?></td>
                <td><?php echo $category; ?></td>
                <td><?php echo $sprice; ?></td>
                <td><?php echo $quantity; ?></td>
                <td><a href="selling.php?id=<?php echo $did; ?>" onclick="centeredPopup(this.href,'myWindow','430','300','yes');return false");><button><b>Select</b></button></a></td>
            </tr></tbody>
     <?php 
$no++;
    } ?>

        </table></div></center>
<?php
        }
    }
 }
 ?>
 </center>
</div>


 
  
 

  
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

