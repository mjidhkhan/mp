<?php

require_once dirname(__DIR__).'/pages/views.php';

if(isset($_POST['action'])){
	$data = $_POST;
	$action = $_POST['action'];
	switch ($action) {
		case "SHOW_DETAILS":
            ShowDetails($data,  $twig);
			break;
		
	}
}else{

}
function ShowDetails($id, $twig){
  
    $recipe = new Products();
   $product=  $recipe->getProductDetails($id);
  
        echo $twig->render('product-details.twig', array('page' => 'Product Details',
         'page'=>$product[0]['course_name'],
         'product'=>$product,
         'path' => IMAGES,
    ));

}