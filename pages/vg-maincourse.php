<?php

require_once dirname(__DIR__).'/pages/views.php';

$product = new Products();
if(Session::get('ststus')== 3){
    $login = 'Logout';
}else{
    $login = 'Login';
}
echo $twig->render('vg-maincourses.twig', array('products' => $product->getAllNonVegetarianMains(),'page' => 'Vegetarian Main Courses','login'=>$login, 'path' => IMAGES));
