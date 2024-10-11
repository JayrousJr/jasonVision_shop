<?php include 'includes/guard.php';?>
<?php include 'includes/header.php';?>

<body>
   <!-- topbar starts -->
     <?php include 'includes/navbar.php' ?>
    <!-- topbar ends -->
<div class="ch-container">
   <div class="row">
       <!-- left menu starts -->
       <div class="col-sm-2 col-lg-2">
           <?php include 'includes/side-navs.php' ?>
       </div>
       <!-- left menu ends -->

<div id="content" class="col-lg-10 col-sm-10"><!-- content starts -->
  <div class="row">
    <div class="col-md-12">
      <?php include 'includes/inc/breadcrumb.php'; ?>
    <!-- CREATE INVOICE BOX FIELD -->
      <div class="row">
        <div class="box col-md-12" style="background-color:">
         <div class="box-inner homepage-box" id="su">
           <div class="box-header well" data-original-title="">
               <h2><i class="glyphicon glyphicon-edit"></i>Create New Invoice</h2>
               <div class="box-icon">
                   <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                   <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
               </div>
           </div>
           <div class="box-content">
               <div class="row">
                 <div class="col-md-12">
                   <table class='table table-bordered'>
                     <thead>
                       <tr>
                         <th>Name of Chemical</th>
                         <th>Description of Harzardous</th>
                         <th>Size / Unit</th>
                         <th>Sold</th>
                         <th>Remain</th>
                         <th width='7%'>#</th>
                       </tr>
                     </thead>
                     <tbody id="tbody1">
                       <tr id="row_1">
                         <td style="text-align: left;" contenteditable="true" class="cname"></td>
                         <td contenteditable="true" class="desc"></td>
                         <td contenteditable="true" class="size" data-row="row_1"></td>
                         <td contenteditable="true" class="sold"></td>
                         <td contenteditable="true" class="rem"></td>
                         <td><button style="display:none" class='btn btn-danger btn-xs remove-ledger-row' data-row='row_1'>- remove</button></td>
                       </tr>
                     </tbody>
                   </table>
                   <div align="right">
                     <button class="btn btn-primary btn-sm" onclick="add_row()">+ add row</button>
                     <button type="button" id="submit_ledger" onclick="manage_ledger();" class="btn btn-success btn-sm">Submit</button>
                   </div>
                 </div>
               </div>
            </div>
          </div>
        </div>
      </div><!-- CREATE INVOICE BOX END -->
    </div>
  </div>
</div><!--/fluid-row-->
<hr>
<?php include 'includes/inc/footer.php'; ?>