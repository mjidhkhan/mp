
<?php
require_once dirname(__DIR__).'/pages/views.php';

$product = new Products();
if(Session::get('ststus')== 3){
    $login = 'Logout';
}else{
    $login = 'Login';
}
echo $twig->render('nv-starters.twig', array('products' => $product->getAllNonVegetarian(),'page' => 'Non Vegetarian Starters','login'=>$login, 'path' => IMAGES));

