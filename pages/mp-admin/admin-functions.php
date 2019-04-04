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
		case "UPDATE_ITEM":
				processUpdateStockItems($data);
			break;
		case "NEW_STAFF":
				newStaffMember($data);
			break;
	}
}else{

}



// STOCK RELATED FUNCTIONS

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

function processUpdateStockItems($data){
	$stock = new Stock();
	if($stock->updateInStockItems($data)> 0){
		echo true;
	}else{
		echo false;
	}
}

// STAFF RELATED FUNCTIONS

function newStaffMember($data){
	$user = new User();
print_r($data);
	return;
	if (Session::get('status') == 1 ) {
		echo $user->RegisterUser($data);
	}else{
		echo false;
	}
	

}


