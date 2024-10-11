<?php 
	session_start();
	include '../libraries/autoload.php';
	require '../libraries/PHPExcel.php';

	$return_URL = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
	$shop_id = array('shop_id', $shop->get_id());

	if (empty($return_URL)) {
	  exit('Unauthorized Access!');
	}

    $objPHPExcel = new PHPExcel();
    $objPHPExcel->getProperties()->setCreator("");
    $objPHPExcel->getProperties()->setLastModifiedBy("");
    $objPHPExcel->getProperties()->setTitle("");
    $objPHPExcel->getProperties()->setSubject("");
    $objPHPExcel->getProperties()->setDescription("");
    $objPHPExcel->setActiveSheetIndex(0);

    $sheet = $objPHPExcel->getActiveSheet();

    $styleArray = array(
    'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => '000000'),
        'size'  => 15,
        'name'  => 'Verdana'
    ));

    $type = $_GET['type'];

    switch ($type) {
    	case 'stock':
    		$sheet->setCellValueByColumnAndRow(0, 1, "JASON VISION COMPANY - STOCKS DETAILS SHEET");
    		$sheet->getStyle('A1:J1')->applyFromArray($styleArray);
		    $sheet->mergeCells('A1:J1');
		    $sheet->getStyle('A1:J1')->getAlignment()->applyFromArray(
			    array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
			);

    		$sheet->getColumnDimension('A')->setWidth(30);
		    $sheet->getColumnDimension('B')->setWidth(10);
		    $sheet->getColumnDimension('C')->setWidth(15);
		    $sheet->getColumnDimension('D')->setWidth(10);
		    $sheet->getColumnDimension('E')->setWidth(13);
		    $sheet->getColumnDimension('F')->setWidth(15);
		    $sheet->getColumnDimension('G')->setWidth(13);
		    $sheet->getColumnDimension('H')->setWidth(13);
		    $sheet->getColumnDimension('I')->setWidth(13);
		    $sheet->getColumnDimension('J')->setWidth(30);

		    #Table Titles
		    $sheet->setCellValue("A2","Item Name");
		    $sheet->setCellValue("B2","Batch No");
		    $sheet->setCellValue("C2","Category");
		    $sheet->setCellValue("D2","Quantity");
		    $sheet->setCellValue("E2","Entry Date");
		    $sheet->setCellValue("F2","Manufacture");
		    $sheet->setCellValue("G2","Expire Date");
		    $sheet->setCellValue("H2","Cost");
		    $sheet->setCellValue("I2","Price");
		    $sheet->setCellValue("J2","Remark");

		    $sheet->getStyle("A2:J2")->getFont()->setBold(true);

		    $row = 3;
		    $data = $db->get_all('stock', $shop_id);

		    if ($data) {
			    foreach ($data as $value) {
			     	$sheet->setCellValue("A".$row,$value->dname);
			     	$sheet->setCellValue("B".$row,$value->batch);
			     	$sheet->setCellValue("C".$row,$value->category);
			     	$sheet->setCellValue("D".$row,$value->quantity);
			     	$sheet->setCellValue("E".$row,$value->edate);
			     	$sheet->setCellValue("F".$row,$value->mprice);
			     	$sheet->setCellValue("G".$row,$value->exdate);
			     	$sheet->setCellValue("H".$row,$value->bprice);
			     	$sheet->setCellValue("I".$row,$value->sprice);
			     	$sheet->setCellValue("J".$row,$value->discr);
			     	$row++;
			    }
			}

		    #Book and Sheet name/Title
		    $filename = "stock_details_".date("Y-m-d-H-i-s").".xls";
		    $sheet->setTitle("Stock");
    		break;
   		case 'sales':
    		$sheet->setCellValueByColumnAndRow(0, 1, "JASON VISION COMPANY - SALES RETURN SHEET");
    		$sheet->getStyle('A1:F1')->applyFromArray($styleArray);
		    $sheet->mergeCells('A1:F1');
		    $sheet->getStyle('A1:F1')->getAlignment()->applyFromArray(
			    array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
			);

    		$sheet->getColumnDimension('A')->setWidth(30);
		    $sheet->getColumnDimension('B')->setWidth(15);
		    $sheet->getColumnDimension('C')->setWidth(15);
		    $sheet->getColumnDimension('D')->setWidth(15);
		    $sheet->getColumnDimension('E')->setWidth(15);
		    $sheet->getColumnDimension('F')->setWidth(15);

		    #Table Titles
		    $sheet->setCellValue("A2","Item Name");
		    $sheet->setCellValue("B2","Quantity");
		    $sheet->setCellValue("C2","Price");
		    $sheet->setCellValue("D2","Grand Total");
		    $sheet->setCellValue("E2","Seller");
		    $sheet->setCellValue("F2","Date");

		    $sheet->getStyle("A2:F2")->getFont()->setBold(true);

		    $row = 3;
		    $data = $db->get_all('sales', $shop_id);

		    if ($data) {
			    foreach ($data as $value) {
			     	$sheet->setCellValue("A".$row,$value->drug_name);
			     	$sheet->setCellValue("B".$row,$value->quantity);
			     	$sheet->setCellValue("C".$row,$value->price);
			     	$sheet->setCellValue("D".$row,$value->total);
			     	$sheet->setCellValue("E".$row,$value->soldby);
			     	$sheet->setCellValue("F".$row,$value->sale_date);
			     	$row++;
			    }
			}

		    #Book and Sheet name/Title
		    $filename = "sales_details_".date("Y-m-d-H-i-s").".xls";
		    $sheet->setTitle("Sales");
    		break;
    	case 'employee':
    		$sheet->setCellValueByColumnAndRow(0, 1, "JASON VISION COMPANY - EMPLOYEES SHEET");
    		$sheet->getStyle('A1:E1')->applyFromArray($styleArray);
		    $sheet->mergeCells('A1:E1');
		    $sheet->getStyle('A1:E1')->getAlignment()->applyFromArray(
			    array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
			);

    		$sheet->getColumnDimension('A')->setWidth(30);
		    $sheet->getColumnDimension('B')->setWidth(15);
		    $sheet->getColumnDimension('C')->setWidth(15);
		    $sheet->getColumnDimension('D')->setWidth(35);
		    $sheet->getColumnDimension('E')->setWidth(20);

		    #Table Titles
		    $sheet->setCellValue("A2","Full Name");
		    $sheet->setCellValue("B2","Gender");
		    $sheet->setCellValue("C2","Phone");
		    $sheet->setCellValue("D2","Email Address");
		    $sheet->setCellValue("E2","Position/Status");

		    $sheet->getStyle("A2:E2")->getFont()->setBold(true);

		    $row = 3;
		    $data = $db->get_all('managers', $shop_id);


		    if ($data) {
			    foreach ($data as $value){
			     	$sheet->setCellValue("A".$row,ucwords($value->fname.' '.$value->lname));
			     	$sheet->setCellValue("B".$row,$value->gender);
			     	$sheet->setCellValue("C".$row,$value->phone);
			     	$sheet->setCellValue("D".$row,$value->mail);
			     	$sheet->setCellValue("E".$row,$value->status);
			     	$row++;
			    }
			}

		    #Book and Sheet name/Title
		    $filename = "employees_details_".date("Y-m-d-H-i-s").".xls";
		    $sheet->setTitle("Employees");
    		break;
    	case 'expense':
    		$sheet->setCellValueByColumnAndRow(0, 1, "JASON VISION COMPANY - EXPENSES SHEET");
    		$sheet->getStyle('A1:F1')->applyFromArray($styleArray);
		    $sheet->mergeCells('A1:F1');
		    $sheet->getStyle('A1:F1')->getAlignment()->applyFromArray(
			    array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
			);

    		$sheet->getColumnDimension('A')->setWidth(25);
		    $sheet->getColumnDimension('B')->setWidth(15);
		    $sheet->getColumnDimension('C')->setWidth(20);
		    $sheet->getColumnDimension('D')->setWidth(20);
		    $sheet->getColumnDimension('E')->setWidth(13);
		    $sheet->getColumnDimension('F')->setWidth(60);

		    #Table Titles
		    $sheet->setCellValue("A2","Title");
		    $sheet->setCellValue("B2","Amount");
		    $sheet->setCellValue("C2","Payment Method");
		    $sheet->setCellValue("D2","Recorded By");
		    $sheet->setCellValue("E2","Date");
		    $sheet->setCellValue("F2","Remark");

		    $sheet->getStyle("A2:F2")->getFont()->setBold(true);

		    $row = 3;
		    $data = $db->get_all('expense', $shop_id);

		    if ($data) {
			    foreach ($data as $value){
			     	$sheet->setCellValue("A".$row,$value->name);
			     	$sheet->setCellValue("B".$row,$value->paid);
			     	$sheet->setCellValue("C".$row,$value->payment);
			     	$sheet->setCellValue("D".$row,$value->user);
			     	$sheet->setCellValue("E".$row,$value->date);
			     	$sheet->setCellValue("F".$row,$value->descr);
			     	$row++;
			    }
			}

		    #Book and Sheet name/Title
		    $filename = "expenses_details_".date("Y-m-d-H-i-s").".xls";
		    $sheet->setTitle("Expenses");
    		break;
    	case 'asset':
    		$sheet->setCellValueByColumnAndRow(0, 1, "JASON VISION COMPANY - ASSETS DETAILS SHEET");
    		$sheet->getStyle('A1:G1')->applyFromArray($styleArray);
		    $sheet->mergeCells('A1:G1');
		    $sheet->getStyle('A1:G1')->getAlignment()->applyFromArray(
			    array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
			);

    		$sheet->getColumnDimension('A')->setWidth(10);
		    $sheet->getColumnDimension('B')->setWidth(20);
		    $sheet->getColumnDimension('C')->setWidth(15);
		    $sheet->getColumnDimension('D')->setWidth(15);
		    $sheet->getColumnDimension('E')->setWidth(15);
		    $sheet->getColumnDimension('F')->setWidth(15);
		    $sheet->getColumnDimension('G')->setWidth(60);

		    #Table Titles
		    $sheet->setCellValue("A2","Code");
		    $sheet->setCellValue("B2","Name");
		    $sheet->setCellValue("C2","Location");
		    $sheet->setCellValue("D2","Purchased date");
		    $sheet->setCellValue("E2","Current Price");
		    $sheet->setCellValue("F2","Category");
		    $sheet->setCellValue("G2","Remark");

		    $sheet->getStyle("A2:G2")->getFont()->setBold(true);

		    $row = 3;
		    $data = $db->get_all('asset', $shop_id);

		    if ($data) {
			    foreach ($data as $value) {
			     	$sheet->setCellValue("A".$row,$value->codi);
			     	$sheet->setCellValue("B".$row,$value->aname);
			     	$sheet->setCellValue("C".$row,$value->locat);
			     	$sheet->setCellValue("D".$row,$value->pdate);
			     	$sheet->setCellValue("E".$row,$value->price);
			     	$sheet->setCellValue("F".$row,$value->category);
			     	$sheet->setCellValue("G".$row,$value->dname);
			     	$row++;
			    }
			}

		    #Book and Sheet name/Title
		    $filename = "assets_details_".date("Y-m-d-H-i-s").".xls";
		    $sheet->setTitle("Assets");
    		break;
    	default: 
    		header("Location: ".$return_URL);
    		exit();
    }

	#Required Headers
    header("Pragma: public");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Content-Type: application/force-download");
	header("Content-Type: application/octet-stream");
	header("Content-Type: application/download");;
	header("Content-Disposition: attachment;filename=$filename");


    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
    //force user to download the Excel file without writing it to server's HD
    $objWriter->save('php://output');
    set_time_limit(30);
    exit;    
    
?>