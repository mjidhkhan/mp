<?php

require_once dirname(__DIR__).'../../pages/views.php';

$staff = new Staff();
	if (Session::get('status') == 1 || Session::get('status') == 2 ) {
        
       	$employees = $staff->getAllEmployees(); 
		echo $twig->render('mp-admin/all-staff.twig', array('staff' => 'Staff', 
		'page' => 'New Staff',
		 'employees'=>$employees,
		 'path' => IMAGES,
		  'admin_data' =>$details,
		  'stock_data'=>$stock_data,
		  'order_data'=>$order_data
		));
	}else{
		echo $twig->render('mp-admin/admin-login.twig', array('page' => 'Admin Login'));
	}