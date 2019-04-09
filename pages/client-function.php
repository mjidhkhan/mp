<?php
<?php

require_once dirname(__DIR__).'../../pages/views.php';
if(isset($_POST['action'])){
	

	$data = $_POST;
	$action = $_POST['action'];


	switch ($action) {
		case "SHOW_DETAILS":
            ShowDetails($data);
			break;
		
	}
}else{

}
function ShowDetails($id){
    echo $id;
    echo $twig->render('mp-admin/update-item.twig', array('stock' => 'Stock', 
        'page' => 'Update Item',
        'stock'=>$data, 
        'admin_data' =>$details,
        'stock_data'=>$stock_data,
        'order_data'=>$order_data
        ));

}