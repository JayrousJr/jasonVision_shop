$(document).ready(function(){
  getData();
  $('#showcart').click(function(){
  });

  $('#confirm').click(function(){
    $('.cust-info').css('display','block');
    $('#confirm').attr('onclick','confirm()')
  });
});

// MY FUNCTIONS
function getData(){
  $.ajax({
    url:'credit1.php',
    method:'POST',
    dataType:'json',
    data:{key:'getTotal'},
    success:function(response){
      //console.log(response);
      $('.badge').html(response.rows);
      $('#tbody').html(response.tbody);
      //$('.pagination').append(response.pagenation);
    }
  });
}
// Edit Data
function sell(id){
  $.ajax({
    url:'credit1.php',
    method:'POST',
    dataType:'json',
    data:{key:'getRowData',rowID:id},
    success:function(response){
      //console.log(response);
      $('#editRowID').val(id);
      $('#pname').val(response.name);
      $('#price').val(response.price);
      $('#actualPrice').val(response.price);
      $('#cartTable').append(response.result);
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
    url:'credit1.php',
    method:'POST',
    dataType:'text',
    data:{key:'sendGet',name:name,qty:qty,total:total,id:id},
    success:function(response){
      if (response == 'success') {
        //console.log(response);
        getData();
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

function cart(){
  $.ajax({
    url:'credit1.php',
    method:'POST',
    dataType:'json',
    data:{key:'getCart'},
    success:function(response){
      //console.log(response);
      $('#cartTable').html(response.result);
      $('#amount').html(response.total);
      $('#cartModal').modal("show");
    }
  });
}


// delete
function deleteData(id){
  $.ajax({
    url:'credit1.php',
    method:'POST',
    dataType:'text',
    data:{key:'delete',id:id},
    success:function(response){
      //console.log(response);
      cart();
      getData();
   }
  });
}

// search
function search(){
  var search = $('#search').val();
  $.ajax({
    url:'credit1.php',
    method:'POST',
    dataType:'text',
    data:{key:'search',search:search},
    success:function(response){
      //console.log(response);
      $('#tbody').html(response);
    }
  });
}

function confirm(){
  var name = $('#cust-name').val();
  var phone = $('#cust-phone').val();
  var address = $('#cust-addr').val();

  $.ajax({
    url:'credit1.php',
    method:'POST',
    dataType:'json',
    data:{key:'confirm',name:name,phone:phone,address:address},
    success:function(resp){
      console.log(resp);
      window.location = "pdfC.php?id="+resp.sid+"&r_no="+resp.rno+"&name="+name+"&phone="+phone+"&address="+address;
    }
  });
}
