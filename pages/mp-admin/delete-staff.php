<?php
require_once dirname(__DIR__).'../../pages/views.php';

$staff = new Staff();
	if (Session::get('status') == 1 || Session::get('status') == 2 ) {
        $employees = $staff->getAllEmployees();   
	}

echo $twig->render('mp-admin/delete-staff.twig', array('staff' => 'Employees',
 'page' => 'Delete Staff Member',
  'employees'=>$employees,
  'admin_data' =>$details));


