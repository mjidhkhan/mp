<?php

require_once dirname(__DIR__).'../../pages/views.php';
if (isset($_POST)) {
    $recipe = new Recipe();
    $data = $_POST;
    if (!empty($_FILES['file']['type'])) {
        $fileName = time().'_'.$_FILES['file']['name'];
        $sourcePath = $_FILES['file']['tmp_name'];
        $targetPath = '../../static/mp/images/'.$fileName;
        $fileType = $_FILES['file']['type'];
        $recipe->fileUpload($fileName, $sourcePath, $targetPath, $fileType);
        $response  = $recipe->createNewRecipe($data, $fileName);
        echo $response;
    } else {
        echo 'ERROR';
    }
}
