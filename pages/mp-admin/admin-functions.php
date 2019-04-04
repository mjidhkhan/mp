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
	if (Session::get('status') == 1 ) {
		if (!empty($_FILES['file']['type'])) {
			$fileName = time().'_'.$_FILES['file']['name'];
			$sourcePath = $_FILES['file']['tmp_name'];
			$targetPath = '../../static/mp/images/user/'.$fileName;
			$fileType = $_FILES['file']['type'];
			$user->fileUpload($fileName, $sourcePath, $targetPath, $fileType);
			echo $user->RegisterUser($data, $fileName);
		} 
	}else{
		echo false;
	}
	

}


