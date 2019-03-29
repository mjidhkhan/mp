<?php
require_once dirname(__DIR__).'../../pages/views.php';
if(isset($_POST)){
	$recipe = new Recipe();
	echo print_r($_POST);

	/* add data below in database
	[mealtype] => 1
    [mealcat] => 3
    [rcpname] => 34

    [item1] => 1
    [qty_1] => 22
    [item2] => 2
    [qty_2] => 32
    [item3] => 7
    [qty_3] => 13
    [item4] => 13
    [qty_4] => 23
	
    [sd] => This is description
	*/
	if(!empty($_FILES["file"]["type"])){
		$fileName = time().'_'.$_FILES['file']['name'];
		$sourcePath = $_FILES['file']['tmp_name'];
		$targetPath = "../../static/mp/images/".$fileName;
		$fileType = $_FILES["file"]["type"];
		$recipe->fileUpload($fileName, $sourcePath, $targetPath, $fileType);
    }else{
		echo 'ERROR';
	}
}