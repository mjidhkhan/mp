<?php
require_once dirname(__DIR__).'../../pages/views.php';

$stock = new Stock();
	if (Session::get('status') == 1 || Session::get('status') == 2 ) {
        
        $data = $stock->getOutOfStock(); 
         
	}

echo $twig->render('mp-admin/outofstock-items.twig', array('stock' => 'Stock', 'page' => 'Out of Stock', 'stock'=>$data));