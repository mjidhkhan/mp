<?php
require_once dirname(__DIR__).'../../pages/views.php';

$stock = new Stock();
	if (Session::get('status') == 1 || Session::get('status') == 2 ) {
        $data = $stock->getStock();   
	}

echo $twig->render('mp-admin/update-item.twig', array('stock' => 'Stock', 'page' => 'Update Item', 'stock'=>$data, 'admin_data' =>$details));
