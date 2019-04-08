<?php
require_once dirname(__DIR__).'../../pages/views.php';

$staff = new Staff();
	if (Session::get('status') == 1 || Session::get('status') == 2 ) {
        
		   $designation = $staff->getDesignation(); 
		   $employees = $staff->getAllEmployees();
		echo $twig->render('mp-admin/new-staff.twig', array('staff' => 'Staff', 'page' => 'New Staff', 'types'=>$designation,'employees'=>$employees,'path' => IMAGES));
	}else{
		echo $twig->render('mp-admin/admin-login.twig', array('page' => 'Admin Login'));
	}


