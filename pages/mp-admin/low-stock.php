<?php
require_once dirname(__DIR__).'../../pages/views.php';

$stock = new Stock();
	if (Session::get('status') == 1 || Session::get('status') == 2 ) {

		$outof_stock = $stock->checkOutOfStock();
		$low_stock = $stock->checkLowStock();
		$outof_stock = $stock->checkOutOfStock();
		$outof_stock = $stock->checkOutOfStock();
        $data = $stock->checkLowStock(); 
         
	}

echo $twig->render('mp-admin/lowstock-items.twig', array('stock' => 'Stock', 
								'page' => 'Low Stock', 
								'outofstock' => sizeof($outof_stock),
								'lowstock' => sizeof($low_stock),
								'today' => 20,
								'nextweek' => 30, 
								'path' => IMAGES,
								'stock'=>$data, 'admin_data' =>$details));