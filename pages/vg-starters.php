<?php
require_once dirname(__DIR__).'/pages/views.php';

$product = new Products();
if(Session::get('ststus')== 3){
    $login = 'Logout';
}else{
    $login = 'Login';
}
echo $twig->render('vg-starters.twig', array('products' => $product->getAllVegetarianStarters(),'page' => 'Vegetarian Starters','login'=>$login, 'path' => IMAGES));

