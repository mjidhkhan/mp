<?php
require_once dirname(__DIR__).'../../pages/views.php';


	if (Session::get('status') == 1 || Session::get('status') == 2 ) {

         
	

echo $twig->render('mp-admin/outofstock-items.twig', array('stock' => 'Stock', 
								'page' => 'Out of Stock', 
								'outofstock' => sizeof($outof_stock),
								'lowstock' => sizeof($low_stock),
								'today' => 20,
								'nextweek' => 30, 
								'path' => IMAGES,
								'stock'=>$data,'admin_data' =>$details, 
								'stock_data'=>$stock_data,
								'order_data'=>$order_data));
	}
