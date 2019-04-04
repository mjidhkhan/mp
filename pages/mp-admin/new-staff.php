<?php
require_once dirname(__DIR__).'../../pages/views.php';

$user = new User();
	if (Session::get('status') == 1 || Session::get('status') == 2 ) {
        
       $designation = $user->getDesignation(); 
         
	}

echo $twig->render('mp-admin/new-staff.twig', array('staff' => 'Staff', 'page' => 'New Staff', 'types'=>$designation));
