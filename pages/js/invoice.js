$(document).ready(function () {
	var add = $('#add_row');
	var tbody = $('#tbody1');
	var count = 1;
	add.click(function () {
		count += 1;
		var newLine = "<tr id='row_" + count + "'>";
		newLine += "<td style='text-align: left;' class='name'>";
		newLine += "<input type='text' class='form-control' name='name[]'></td>";

		newLine += "<td class='qty' data-row='row_" + count + "'>";
		newLine += "<input type='text' class='form-control' name='qty[]'></td>";

		newLine += "<td class='rate' data-row='row_" + count + "'>";
		newLine += "<input type='text' class='form-control' name='rate[]'></td>";

		newLine += "<td class='amt'>";
		newLine += "<input type='text' readonly class='form-control' name='amount[]'></td>";

		newLine += "<td><button class='btn btn-danger btn-xs remove' data-row='row_" + count + "'>- remove</button></td>";
		newLine += "</tr>";
		tbody.append(newLine);
	});

	// Remove table row
	$(document).on('click', '.remove', function () {
		var data_row = $(this).data('row');
		$('#' + data_row).remove();
	});

	// Remove table row
	$(document).on('click', '.remove-row', function () {
		var data_row = $(this).data('row');
		$('#' + data_row).remove();
	});

	// Calculate amount
	$(document).on('keyup', '.rate', function () {
		var row = $(this).data('row');
		var amts = $('#' + row + '>.amt input');

		// Get index and values
		var index = parseInt(row.split('_')[1]) - 1;
		var qty   = parseInt(getInputValues("input[name='qty[]']")[index]);
		var rate  = parseInt(getInputValues("input[name='rate[]']")[index]);

		amts.val(qty * rate);
	});

	// Submit button once clicked
	$('#submit-inv').click(function (e) {
		var custName = $('#custName').val();
		var lpo = $('#lpo').val();
		var charge = $('#charge').val();

		var names = getInputValues("input[name='name[]']");
		var qty = getInputValues("input[name='qty[]']");
		var rates = getInputValues("input[name='rate[]']");
		var amounts = getInputValues("input[name='amount[]']");

		$.ajax({
			url: 'includes/invoice.inc.php',
			dataType: 'json',
			method: 'POST',
			data: { key: 'get_invoice', cust: custName, charge: charge, name: names, qty: qty, rate: rates, amt: amounts, lpo: lpo },
			success: function (data) {
				if (data.status === 0) {
					alert("All fields are REQUIRED!");
				} else {
					let url = 'includes/print.php?get=preview&doc=ledger&file=' + data.path;
					success_confirm(url);
				}
			}
		});
	});

	// Invoice dataTable
	$('#inv-table').DataTable();
})


function getInputValues(selector) {
	return $(selector).map(function() { 
		return $(this).val().trim(); 
	}).get();
}

// FUNCTIONS
// Add row for ledger
let count = 1;
function add_row() {
	let tbody = $('#tbody1');
	count += 1;
	let newLine = "<tr id='row_" + count + "'>";
	newLine += "<td autofocus style='text-align: left;' contenteditable='true' class='cname'></td>";
	newLine += "<td contenteditable='true' class='desc' data-row='row_" + count + "'></td>";
	newLine += "<td contenteditable='true' class='size' data-row='row_" + count + "'></td>";
	newLine += "<td contenteditable='true' class='sold'></td>";
	newLine += "<td contenteditable='true' class='rem'></td>";
	newLine += "<td><button class='btn btn-danger btn-xs remove-row' data-row='row_" + count + "'>- remove</button></td>";
	newLine += "</tr>";
	tbody.append(newLine);
}

// Manage LEDGER
function manage_ledger() {
	let cname = [];
	let desc = [];
	let size = [];
	let sold = [];
	let rem = [];

	$('.cname').each(function () {
		cname.push($(this).text().trim());
	});
	$('.desc').each(function () {
		desc.push($(this).text().trim());
	});
	$('.size').each(function () {
		size.push($(this).text().trim());
	});
	$('.sold').each(function () {
		sold.push($(this).text().trim());
	});
	$('.rem').each(function () {
		rem.push($(this).text().trim());
	});

	$.ajax({
		url: 'includes/ledger.inc.php',
		dataType: 'json',
		method: 'POST',
		data: { key: 'get_invoice', rem: rem, cname: cname, desc: desc, size: size, sold: sold },
		success: function (data) {
			if (data.status) {
				let url = 'includes/print.php?get=preview&doc=ledger&file=' + data.path;
				success_confirm(url);
			} else
				alert("Something went wrong. Contact @mpembainc");
			// console.log(data);
		}
	});
}


// DELETE INVENTORY WITH SWEET ALERT
function delete_inv(id, path) {
	swal({
		title: "Are you Sure?",
		text: "You will not be able to recover this file!",
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: "Yes, delete it!",
		cancelButtonText: "No, cancel!",
		closeOnConfirm: false,
		closeOnCancel: false,
		showLoaderOnConfirm: true
	}, function (isConfirm) {
		if (isConfirm) {
			$.ajax({
				url: 'includes/delete.inc.php',
				method: 'POST',
				data: { isAjax: true, action: 'delete_inv', id: id, file: path },
				success: function (data) {
					if (data == 'success') {
						swal({ title: "Deleted!", text: "Your imaginary file has been deleted.", type: "success" }, () => {
							location.reload();
						});
					} else {
						swal("Not Deleted!", "There are some error in the server.", "error");
					}
				}
			});
		} else {
			swal("Cancelled", "Your imaginary file is safe :)", "error");
		}
	});
}


// DELETE RECEIPT WITH SWEET ALERT
function delete_rec(id, type) {
	swal({
		title: "Are you Sure?",
		text: "You will not be able to recover this file!",
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: "Yes, delete it!",
		cancelButtonText: "No, cancel!",
		closeOnConfirm: false,
		closeOnCancel: false,
		showLoaderOnConfirm: true
	}, function (isConfirm) {
		if (isConfirm) {
			$.ajax({
				url: 'includes/delete.inc.php',
				method: 'POST',
				data: { action: 'delete_rec', id: id, type: type },
				success: data => {
					if (data === 'success') {
						swal({ title: "Deleted!", text: "Your imaginary file has been deleted.", type: "success" }, () => {
							location.reload();
						});
					} else {
						swal("Not Deleted!", "There are some error in the server.", "error");
					}
				}
			});
		} else {
			swal("Cancelled", "Your imaginary file is safe :)", "error");
		}
	});
}

// SWEET ATLERT SUCCESS CONFIRM
function success_confirm(url) {
	swal({
		title: "Successfully!",
		text: "Do you want to preview?",
		type: "success",
		showCancelButton: true,
		confirmButtonClass: "btn-primary",
		confirmButtonText: "Yes!",
		cancelButtonText: "No!",
		closeOnConfirm: false,
		closeOnCancel: false
	}, function (isConfirm) {
		if (isConfirm) {
			window.location = url;
		} else {
			window.location.reload();
		}
	});
}