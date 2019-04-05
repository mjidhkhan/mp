<?php
require_once dirname(__DIR__).'/pages/views.php';

$product = new Products();
echo $twig->render('vg-starters.twig', array('products' => $product->getAllVegetarianStarters(),'page' => 'Starters', 'path' => IMAGES));

