
<?php
require_once dirname(__DIR__).'/pages/views.php';

$product = new Products();
echo $twig->render('nv-starters.twig', array('products' => $product->getAllNonVegetarian(ID),'page' => 'Desserts', 'path' => IMAGES));

