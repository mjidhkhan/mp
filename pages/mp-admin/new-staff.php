<?php
require_once dirname(__DIR__).'../../pages/views.php';

//$stock = new Stock();
	if (Session::get('status') == 1 || Session::get('status') == 2 ) {
        
       // $data = $stock->getOutOfStock(); 
         
	}

echo $twig->render('mp-admin/new-staff.twig', array('staff' => 'Staff', 'page' => 'New Staff'));
