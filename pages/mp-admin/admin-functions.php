<?php

require_once dirname(__DIR__).'../../pages/views.php';
if(isset($_POST['action'])){
	


	$data = $_POST;
	$action = $_POST['action'];


	switch ($action) {
		case "NEW_ITEM":
				processAddNewItem($data);
			break;
		case "DELETE_ITEM":
			processDeleteStockItem($data);
			break;
		case "pastel":
			echo "i es un pastel";
			break;
	}
}else{

}

function processAddNewItem($data){
	$stock = new Stock();
	if (Session::get('status') == 1 || Session::get('status') == 2 ) {
		echo $stock->addItemInStock($data);
	}

}

function processDeleteStockItem($data){
	$stock = new Stock();
	 if($stock->removeItemFromStock($data) > 0){
		echo true;
	 }else{
		 echo false;
	 }
}



