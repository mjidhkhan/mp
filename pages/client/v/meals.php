<?php

//<pre>{{ dump(user) }}</pre>


require_once dirname(dirname(__DIR__)) . "/views.php";

$product = new Products();
echo $twig->render('starters.twig', array('products' => $product->getAllVegetarian(ID),'page' => 'Desserts', 'path' => IMAGES));

