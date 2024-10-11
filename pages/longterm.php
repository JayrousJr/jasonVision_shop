   

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
    <link rel="stylesheet" type="text/css" href="gritter/css/jquery.gritter.css" />
    <link href='tooltip/tooltip-viewport.css' rel='stylesheet'>
    <link href="fonts/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="admin.css">
    <link href='css/sweetalert.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/custom.css">

<style type="text/css">
#excel{
  width: 30px;
  height: 30px;
}

.du{
   overflow-x: scroll;
   height: 200px;
   width: 700px;
}
#tab{
  text-decoration: none;
  background-color: white;
}
.css3-notification
{
  font-size: .8em;
  text-align: center;
  padding: 10px;
  position: relative;
  font-weight: bold;
  -webkit-animation: bounce 800ms ease-out;
  -moz-animation: bounce 800ms ease-out;
  -o-animation: bounce 800ms ease-out;
  animation: bounce 800ms ease-out;
}
</style>
    <script type="text/javascript" src="tooltip/tooltip-viewport.js"></script>

    <script type="text/javascript">
    (function (global) {

    if(typeof (global) === "undefined") {
        throw new Error("window is undefined");
    }

    var _hash = "!";
    var noBackPlease = function () {
        global.location.href += "#";

        // making sure we have the fruit available for juice (^__^)
        global.setTimeout(function () {
            global.location.href += "!";
        }, 50);
    };

    global.onhashchange = function () {
        if (global.location.hash !== _hash) {
            global.location.hash = _hash;
        }
    };

    global.onload = function () {
        noBackPlease();

        // disables backspace on page except on input fields and textarea..
        document.body.onkeydown = function (e) {
            var elm = e.target.nodeName.toLowerCase();
            if (e.which === 8 && (elm !== 'input' && elm  !== 'textarea')) {
                e.preventDefault();
            }
            // stopping event bubbling up the DOM tree..
            e.stopPropagation();
        };
    }

})(window);
</script>
<!--title of Jason Vision-->
<script type="text/javascript">
    $(document).ready(function()
{

    function animate(element_ID, animation)
    {
        $(element_ID).addClass(animation);
        var wait = window.setTimeout( function(){
            $(element_ID).removeClass(animation)}, 1300
        );
    }

});

</script>
<!--end of title-->
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

    <!-- The fav icon -->
    <link rel="shortcut icon" href="img/logo.png">
</head>

<body id="gu">
    <!-- topbar starts -->
     <?php include 'includes/navbar.php' ?>  
    <!-- topbar ends -->
<div class="ch-container-fluid">
    <div class="row">
        
        <!-- left menu starts -->
      <div class="col-sm-2 col-lg-2">
          <?php include 'includes/side-navs.php'; ?>  
        </div>
        <!-- left menu ends -->

       <form method="POST" class="form-group">

        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
            <div class="row">
     <div class="col-md-12" >
       <?php include 'includes/inc/breadcrumb.php' ?>
            <center><h3>Jason Vision Management System</h3></center><hr>
       </div>
</div>


<!--box form start-->
      <div class="box col-md-12" style="background-color:">
        <div class="box-inner homepage-box" id="su">
            <div class="box-header well" data-original-title="">
                <a href="expense.php"><h2><i class="glyphicon glyphicon-globe"></i>Daily Expenses Register</h2></a>
   
                <div class="box-icon">
                      <a   class="btn btn-setting btn-round btn-default"   data-toggle="tooltip" title="  Delete Expenses" class="" href="expensesreport.php" onclick="centeredPopup(this.href,'myWindow','1400','400','yes');return false");"><i
                            class="glyphicon glyphicon-cog"></i></a>
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
       
<center><font color="black"><u>Longterm Expenses</u></font></center>
    <div class="row" style="margin-left:5px; ">
     <div class="col-md-12">
        <div class="col-md-3">  <?php
        
if (isset($_POST['sav']))
{

$id=$_POST['date']; 
$fn=$_POST['name'];
$ln=$_POST['payment'];
$phn=$_POST['paid'];
$gen=$_POST['descr'];
$user = $_SESSION['userName']; 
 

$query="INSERT INTO longterm(date,name,payment,descr,paid,user) VALUES ('$id','$fn','$ln','$gen','$phn','$user')";

@$result=mysqli_query($conn,$query);
if($result)
    {
    
echo "<span style='color: red;' /><center><i><b>Longterm Expenses Registered Successfully!</b></i></center></span>";
}
}
}
?>
 </div>
<div class="col-md-3"><b>Date of Payment:</b><br><input type="date" name="date" class="form-control" required></div>
     <div class="col-md-3"><b> Paid To:</b><br><input type="text" name="name" class="form-control" required></div>
<div class="col-md-2">
 </div>
     </div>
     </div><br>


     <div class="row" style="margin-left:5px; ">
     <div class="col-md-12">
        <div class="col-md-3"></div>
         
<div class="col-md-3"><b>Method of Payament:</b><br>
    <select name="payment" class="form-control" id="sele">
        <option></option>
        <option>Cash</option>
        <option>Credit</option>
        <option>Check</option>
    </select></div>
 <div class="col-md-3"><b>Amount Paid<br><input type="number" name="paid" class="form-control" required>
         </div>
         <div class="col-md-2"> </div>
     </div>
     </div><br>


     <div class="row" style="margin-left:5px; ">
     <div class="col-md-12">
       
        <div class="col-md-2"> </div>
      <div class="col-md-1"> </div>
         
         <div class="col-md-1"> </div>
          <div class="col-md-4">Description:<br> 
            <textarea name="descr" id="sele" class="form-control" required></textarea>
          </div>
   
     </div>
     </div>

      <br>
     <div class="row">
         <center><input type="reset" name="" value="Clear" class="btn btn-danger"> 
                    <input type="submit" name="sav" value="Save"   class="btn btn-info">
                </center>
     </div>
        </div>
    </div>
    <!--box form end-->
   
     <div class="row">
     <div class="col-md-4"></div>
     </div>
 
     <div class="row">
     <div class="col-md-4"></div>
     </div>
 
       </form>         
</div>

<div class="row" >
 
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

 <?php include 'includes/inc/footer.php' ?>
