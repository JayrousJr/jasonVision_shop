$(document).ready(function(){
  getData();
  countCartRows();
    $('#showcart').click(function(){
  });

  $('#confirm').click(function(){
      $('.cust-info').css('display','block');
      $('#confirm').attr('onclick','confirm()');
  });
});

function confirmDelete() {
  return confirm("Are sure you want to delete?") ? true : false;
}

// MY FUNCTIONS
function getData(){
  $.ajax({
    url:'server.php',
    method:'POST',
    dataType:'json',
    data:{key:'getTotal'},
    success:function(response){
      $('#tbody').html(response.tbody);
      $('#cartTable').html(response.cart_table);
    }
  });
}

// Edit Data
function sell(id){
  $.ajax({
    url:'server.php',
    method:'POST',
    dataType:'json',
    data:{key:'getRowData',rowID:id},
    success:function(response){
      $('#editRowID').val(id);
      $('#pname').val(response.name);
      $('#price').val(response.price);
      $('#actualPrice').val(response.price);
      $('#qty').val(1);
      $('#sellModal').modal("show");
    }
  });
}

// Summations
function add(){
  var qty = $('#qty').val();
  var price = $('#actualPrice').val();
  var total = qty * price;
  $('#price').val(total);
}

// Save records and retrive
function save(){
  var id = $('#editRowID').val();
  var name = $('#pname').val();
  var qty = $('#qty').val();
  var total = $('#price').val();
  $.ajax({
    url:'server.php',
    method:'POST',
    dataType:'text',
    data:{key:'sendGet',name:name,qty:qty,total:total,id:id},
    success:function(response){
      if (response == 'success') {
        //console.log(response);
        getData();
        countCartRows();
        //document.location.reload();
        $('.badge').html(response);
        $('#sellModal').modal("toggle");
      }else{
        $('.msg').css("display","block","important");
        $('.msg').html(response);
         setTimeout(function(){
            $('.msg').fadeOut();
         },1500);
        //console.log(response);
      }
    }
  });
}

// delete
function deleteData(id){
  if (confirm("Are you sure you want to remove?")) {
    $.ajax({
      url:'server.php',
      method:'POST',
      dataType:'text',
      data:{key:'delete',id:id},
      success:function(response){
        getData();
        countCartRows();
     }
    });
  } else {
    return;
  }
}

// search
function search(){
  var search = $('#search').val();
  $.ajax({
    url:'server.php',
    method:'POST',
    dataType:'text',
    data:{key:'search',search:search},
    success:function(response){
      //console.log(response);
      $('#tbody').html(response);
    }
  });
}

function confirm_sales() {
  var name = $('#cust-name').val();
  var phone = $('#cust-phone').val();
  var address = $('#cust-addr').val();
  $.ajax({
    url:'server.php',
    method:'POST',
    dataType:'json',
    data:{key:'confirm',name:name,phone:phone,address:address},
    success:function(resp){
      //console.log(resp);
      window.location = "pdfreciept.php?id="+resp.sid+"&r_no="+resp.rno+"&name="+name+"&phone="+phone+"&address="+address;
    }
  });
}

// DataTables
function renderDataTable(columns, order = 0, currentUser = null) {
  var options = {
        order: [[order, "desc"]]
    };

    if (!currentUser || currentUser != 'employee') {
      options.dom = 'Bfrtip';
      options.buttons = [
          {
            extend: 'print',
            text: 'Print This Records',
            exportOptions: {
                columns: columns
            }
          }
      ];
    }
    
    $('.datatable').DataTable(options);
}

// Fetch Updated data
async function get_update(table, id, field = false) {
  const formData = new FormData();
  formData.append('get_update', true);
  formData.append('table', table);
  formData.append('id', id);

  if (field !== false) {
    formData.append('field', field);
  }

  try {
    const response = await fetch('includes/actions.php', {
      method: 'POST',
      body: formData
    });

    const result = await response.json();
    return result;
  } catch(e) {
    return null;
  }
}

function countCartRows() {
  $.ajax({
    url:'includes/actions.php',
    method:'POST',
    data:{key:'getCount'},
    success:function(response){
      if (response == 0) {
        $('.checkout').addClass('disabled');
      } else {
        $('.checkout').removeClass('disabled');
      }
    }
  });
}