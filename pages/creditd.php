 <?php include 'includes/guard.php';
?>
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
     <script type="text/javascript" src="tooltip/tooltip-viewport.js"></script>
     <!--dash start-->
     <script src="dash/js/jquery.js" type="text/javascript"></script>
     <!-- <script src="dash/js/bootstrap.js" type="text/javascript"></script> -->

     <script type="text/javascript" charset="utf-8" language="javascript" src="dash/js/jquery.dataTables.js"></script>
     <script type="text/javascript" charset="utf-8" language="javascript" src="dash/js/DT_bootstrap.js"></script>

     <style type="text/css">
     #excel {
         width: 30px;
         height: 30px;
     }

     .du {
         overflow-x: scroll;
         height: 200px;
         width: 700px;
     }

     #tab {
         text-decoration: none;
         background-color: white;
     }

     .css3-notification {
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
     (function(global) {

         if (typeof(global) === "undefined") {
             throw new Error("window is undefined");
         }

         var _hash = "!";
         var noBackPlease = function() {
             global.location.href += "#";

             // making sure we have the fruit available for juice (^__^)
             global.setTimeout(function() {
                 global.location.href += "!";
             }, 50);
         };

         global.onhashchange = function() {
             if (global.location.hash !== _hash) {
                 global.location.hash = _hash;
             }
         };

         global.onload = function() {
             noBackPlease();

             // disables backspace on page except on input fields and textarea..
             document.body.onkeydown = function(e) {
                 var elm = e.target.nodeName.toLowerCase();
                 if (e.which === 8 && (elm !== 'input' && elm !== 'textarea')) {
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
     $(document).ready(function() {

         function animate(element_ID, animation) {
             $(element_ID).addClass(animation);
             var wait = window.setTimeout(function() {
                 $(element_ID).removeClass(animation)
             }, 1300);
         }

     });
     </script>
     <!--end of title-->
     <!-- jQuery -->
     <script src="bower_components/jquery/jquery.min.js"></script>
     <script language="javascript">
     var popupWindow = null;

     function centeredPopup(url, winName, w, h, scroll) {
         LeftPosition = (screen.width) ? (screen.width - w) / 2 : 0;
         TopPosition = (screen.height) ? (screen.height - h) / 2 : 0;
         settings =
             'height=' + h + ',width=' + w + ',top=' + TopPosition + ',left=' + LeftPosition + ',scrollbars=' + scroll +
             ',resizable'
         popupWindow = window.open(url, winName, settings)
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
             <!--/span-->
             <!-- left menu ends -->



             <div id="content" class="col-lg-10 col-sm-10">
                 <?php include 'includes/inc/breadcrumb.php' ?>
                 <!-- content starts -->
                 <div class="row">
                     <div class="col-md-12">


                     </div>
                     <div class=" row">
                         <!--box form start-->


                         <div class="col-md-18">
                             <div class="container-fluid" style="margin-top:0px;">
                                 <div class="row">
                                     <div class="panel panel-default">
                                         <div class="panel-body">
                                             <div class="table-responsive">

                                                 <center>
                                                     <p><b>
                                                             <font size="5">Credit Sales</font>
                                                         </b></p>
                                                 </center>
                                                 <form method="POST">
                                                     <div class="col-md-offset-9">
                                                         <input type="submit" name="send" class="btn btn-danger"
                                                             value="Delete All Sales">
                                                         <?php
   if (isset($_POST['send'])){

      
$truncatetable= mysqli_query($conn,"TRUNCATE TABLE credit");

if($truncatetable !== FALSE)
{
   echo("All rows have been deleted.");
}
else
{
   echo("No rows have been deleted.");
}

 
  }
  ?>


                                                     </div>
                                                 </form>
                                                 <form method="post" action="delete.php">
                                                     <table cellpadding="0" cellspacing="0" border="0"
                                                         class="table table-condensed" id="example">

                                                         <thead class="table-bordered table-hover" id="customers">

                                                             <tr>

                                                                 <th>Item_Name</th>
                                                                 <th>Quantity</th>
                                                                 <th>Price</th>
                                                                 <th>Total</th>
                                                                 <th>Sold By</th>
                                                                 <th>Sale Date</th>
                                                                 <th>Action</th>

                                                             </tr>
                                                         </thead>
                                                         <tbody class="table-bordered table-hover" id="customers">
                                                             <?php 
                            $query=mysqli_query($conn,"select * from credit ORDER BY sales_id asc")or die(mysqli_error());
                            while($row=mysqli_fetch_array($query)){
                                $id=$row['sales_id'];
                            $drug_name=$row['drug_name'];
                            $quantity=$row['quantity'];
                            $price=$row['price'];
                            $total=$row['total'];
                            $soldby=$row['soldby'];
                            $sale_date=$row['sale_date'];
                            ?>

                                                             <tr>

                                                                 <td><?php echo $row['drug_name'] ?></td>
                                                                 <td><?php echo $row['quantity'] ?></td>
                                                                 <td><?php echo $row['price'] ?></td>
                                                                 <td><?php echo $row['total'] ?></td>
                                                                 <td><?php echo $row['soldby'] ?></td>
                                                                 <td><?php echo $row['sale_date'] ?></td>

                                                                 <?php
                echo "<td> <a href='#' class='btn btn-primary sm button1' onclick='editDet($id)' data-toggle='modal' data-target='#exae'>
                <i class='glyphicon glyphicon-edit icon-white'></i>
                Edit
            </a> 
               
               
                              
              <a href='deletesales.php?sales_id=$id' class='button'><input type='button' class='btn btn-danger' value='Delete'></a></td>";?>
                                                             </tr>

                                                             <?php } ?>
                                                         </tbody>
                                                     </table>
                                                     <!--modal of edit start-->
                                                     <div class="modal fade" id="exae" tabindex="-1" role="dialog"
                                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                         <div class="modal-dialog " role="document">
                                                             <div class="modal-content ">
                                                                 <div class="modal-header" style="background-color: ;">
                                                                     <h5 class="modal-title" id="exampleModalLabel">
                                                                         Update Sales</h5>
                                                                     <button type="button" class="close"
                                                                         data-dismiss="modal" aria-label="Close">
                                                                         <span aria-hidden="true">&times;</span>
                                                                     </button>
                                                                 </div>
                                                                 <form method="POST" action="" class="form-group">
                                                                     <div class="modal-body">
                                                                         <div class="col-md-12">

                                                                             <div class="row">

                                                                                 <div class=" col-md-3">
                                                                                     <label>Item_Name</label>
                                                                                     <input type="text" name="drug_name"
                                                                                         class="form-control"
                                                                                         id="drug_name">
                                                                                 </div>
                                                                                 <div class=" col-md-3">
                                                                                     <label>Quantity</label>
                                                                                     <input type="number"
                                                                                         name="quantity"
                                                                                         class="form-control"
                                                                                         id="quantity">
                                                                                 </div>
                                                                                 <div class=" col-md-3">
                                                                                     <label>Price</label>
                                                                                     <input type="number" name="price"
                                                                                         class="form-control"
                                                                                         id="price">
                                                                                 </div>


                                                                             </div>

                                                                             <div class="row">
                                                                                 <div class=" col-md-3">
                                                                                     <label>Total</label>
                                                                                     <input type="number" name="total"
                                                                                         class="form-control"
                                                                                         id="total">
                                                                                 </div>
                                                                                 <div class=" col-md-3">
                                                                                     <label>Sold_By</label>
                                                                                     <input type="text" name="soldby"
                                                                                         class="form-control"
                                                                                         id="soldby">
                                                                                 </div>
                                                                                 <div class=" col-md-3">
                                                                                     <label>Sale_Date</label>
                                                                                     <input type="text" name="sale_date"
                                                                                         class="form-control"
                                                                                         id="sale_date">
                                                                                 </div>



                                                                             </div>


                                                                             <br>
                                                                         </div>
                                                                         <div class="row">
                                                                             <div class="col-md-8 col-md-offset-3">
                                                                                 <input type="hidden" id="rowID"
                                                                                     value="0">
                                                                                 <button type="reset"
                                                                                     class="btn btn-danger">Clear</button>
                                                                                 <input type="button" name="submit"
                                                                                     id="submit" onclick="updateDet()"
                                                                                     value="Save Changes"
                                                                                     class="btn btn-primary" />
                                                                                 <input type="hidden" name="sales_id"
                                                                                     id="sales_id" />
                                                                                 <button type="button"
                                                                                     class="btn btn-secondary"
                                                                                     data-dismiss="modal">Close</button>
                                                                             </div>
                                                                         </div>
                                                                     </div>
                                                                     <div class="modal-footer">


                                                                     </div>
                                                                 </form>


                                                             </div>
                                                         </div>
                                                     </div>
                                                     <!--modal end-->


                                                 </form>
                                                 <script>
                                                 function editDet(id) {

                                                     $.ajax({
                                                         url: 'fetchcredit.php',
                                                         method: 'POST',
                                                         dataType: 'json',
                                                         data: {
                                                             key: 'editUser',
                                                             editId: id
                                                         },
                                                         success: function(userdata) {
                                                             console.log(userdata);
                                                             $('#rowID').val(id);
                                                             $('#drug_name').val(userdata.drug_name);
                                                             $('#quantity').val(userdata.quantity);
                                                             $('#price').val(userdata.price);
                                                             $('#total').val(userdata.total);
                                                             $('#soldby').val(userdata.soldby);
                                                             $('#sale_date').val(userdata.sale_date);

                                                         }
                                                     });
                                                 }

                                                 function updateDet() {

                                                     var id = $('#rowID').val();
                                                     var drug_name = $('#drug_name').val();
                                                     var quantity = $('#quantity').val();
                                                     var price = $('#price').val();
                                                     var total = $('#total').val();
                                                     var soldby = $('#soldby').val();
                                                     var sale_date = $('#sale_date').val();

                                                     $.ajax({
                                                         url: 'fetchcredit.php',
                                                         method: 'POST',
                                                         dataType: 'text',
                                                         data: {
                                                             key: 'update',
                                                             editId: id,
                                                             drug_name: drug_name,
                                                             quantity: quantity,
                                                             price: price,
                                                             total: total,
                                                             soldby: soldby,
                                                             sale_date: sale_date
                                                         },
                                                         success: function(userdata) {
                                                             //console.log(userdata);
                                                             document.location.reload();
                                                         }
                                                     });
                                                 }
                                                 </script>
                                             </div>



                                         </div>
                                     </div>
                                 </div>
                             </div>






                         </div>
                         <!--/fluid-row-->

                         <!-- Ad ends -->


                         <hr>


                     </div>
                     <!--/.fluid-container-->
                     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                         <div class="modal-dialog" role="document">
                             <div class="modal-content">
                                 <div class="modal-header">
                                     <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to Log Out?
                                     </h5>
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
                 </div>
             </div>
         </div>
         <!--   <script type="text/javascript">
        $(document).ready(function () {
        var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'Welcome to Jason Vision Management System!',
            // (string | mandatory) the text inside the notification
            text: 'You can manage your stock,Asset,Employees,Return inward,Reports and Sales easly within a minutes!<br><a href="" target="_blank" style="color:#ffd777">suriakhan77@gmail.com</a>.',
            // (string | optional) the image to display on the left
            image: 'img/logo.png',
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: true,
            // (int | optional) the time you want it to be alive for before fading out
            time:'',
            // (string | optional) the class name you want to apply to that specific message
            class_name: 'my-sticky-class'
        });

        return false;
        });
    </script> -->

         <script type="text/javascript" src="gritter/js/jquery.gritter.js"></script>
         <script type="text/javascript" src="gritter-conf.js"></script>
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
         <script type="text/javascript">
         if (window.history.replaceState) {
             window.history.replaceState(null, null, window.location.href);
         }
         </script>
 </body>

 </html>