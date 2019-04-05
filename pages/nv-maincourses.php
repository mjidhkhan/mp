<?php

require_once dirname(__DIR__).'/pages/views.php';

$product = new Products();
if(Session::get('ststus')== 3){
    $login = 'Logout';
}else{
    $login = 'Login';
}
echo $twig->render('nv-maincourse.twig', array('products' => $product->getAllNonVegetarianMains(),'page' => 'Non Vegetarian Main Courses','login'=>$login, 'path' => IMAGES));
