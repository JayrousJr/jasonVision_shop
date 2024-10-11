<?php
session_start();
require_once '../../libraries/autoload.php';
include 'dbh.php';
include 'func.inc.php';

$unexpected_error = "<strong>Unexpected error:</strong> Please contact <a href='mailto:husmukh154@gmail.com'>@mpembainc</a>";

#Save asset
if (isset($_POST['save-asset-btn'])) {
    $data = array(
        'shop_id' => $shop->get_id(),
        'codi' => $_POST['code'],
        'locat' => $_POST['location'],
        'aname' => $_POST['name'],
        'dname' => $_POST['remark'],
        'pdate' => $_POST['date'],
        'price' => $_POST['price'],
        'category' => $_POST['category'],
        'user' => Session::get('username')
    );

	$check =mysqli_query($conn,"SELECT * FROM asset WHERE codi = '".$_POST['code']."'");
	if (mysqli_num_rows($check) > 0) {
    	Session::flash('error', " Asset code is already exist,Please Change the CODE");
	}else{
	    if($db->insert('asset', $data)) {
            Session::flash('success', 'Asset has been saved');
	    } else {
            echo $unexpected_error;
            exit();
        }
	}
    Redirect::to('../assets');
}

#Register Customer
if (isset($_POST['save-customer-btn'])) {
	$error = '';

	if (isExist($conn, 'managers','phone', $_POST['phone'])){
    	$error = "<strong>Ooops: </strong> Phone Number is already exist";
    } elseif (isExist($conn, 'managers', 'mail', $_POST['email'])) {
    	$error = "<strong>Ooops: </strong> E-mail is already exist";
    }

    if (!$error) {
    	$data = array(
            'shop_id' => $shop->get_id(),
    		'fname' => $_POST['fname'],
    		'lname' => $_POST['lname'],
    		'phone' => $_POST['phone'],
    		'email' => $_POST['email'],
    		'address' => $_POST['address'],
    		'remark' => $_POST['remark'],
    		'user' => Session::get('username')
    	);

    	if ($db->insert('customers', $data)) {
    		Session::flash('success', 'Customer has been saved');
    	} else {
    		echo "Unexpected error: Please contact <a href='mailto:husmukh154@gmail.com'>@mpembainc</a>";
    	}
    } else {
    	Session::flash('error', $error);
    }

    Redirect::to('../customers');
}

#Register Staff
if (isset($_POST['save-staff-btn'])) {
	$error = '';

	if (isExist($conn, 'managers','phone', $_POST['phone'])){
    	$error = "<strong>Ooops: </strong> Phone Number is already exist";
    } elseif (isExist($conn, 'managers', 'mail', $_POST['email'])) {
    	$error = "<strong>Ooops: </strong> E-mail is already exist";
    }

    if (!$error) {
    	$data = array(
    		'fname' => $_POST['fname'],
    		'lname' => $_POST['lname'],
    		'gender' => $_POST['gender'],
    		'phone' => $_POST['phone'],
    		'mail' => $_POST['email'],
    		'status' => $_POST['role'],
    		'user' => Session::get('username')
    	);

    	if ($db->insert('managers', $data)) {
    		Session::flash('success', 'Staff has been saved');
    	} else {
    		echo "Unexpected error: Please contact <a href='mailto:husmukh154@gmail.com'>@mpembainc</a>";
    	}
    } else {
    	Session::flash('error', $error);
    }

    Redirect::to('../staffs');
}

#Add Expense
if (isset($_POST['save-expense-btn'])) {
    $data = array(
        'name' => $_POST['name'],
        'payment' => $_POST['method'],
        'paid' => $_POST['amount'],
        'descr' => $_POST['remark'],
        'date'=> $_POST['date'],
        'shop_id' => $shop->get_id(),
        'user' => Session::get('username')
    );

    if ($db->insert('expense', $data)) {
        Session::flash('success', 'Expenses has been saved');
    } else {
        exit($unexpected_error);
    }

    Redirect::to('../expenses');
}

#Update User
if (isset($_POST['get_update'])) {
	$field = (isset($_POST['field']))  ? $_POST['field'] : 'id';
	$data = $db->get_where($_POST['table'], array($field, '=', $_POST['id']));
	if ($data) {
		echo json_encode($data[0]);
        exit();
	}
}

#Get Cart count
if (isset($_POST['key']) && $_POST['key'] == 'getCount') {
	echo $db->count('soud', array('user_id', $_SESSION['user_id']));
    exit();
}

echo $unexpected_error;