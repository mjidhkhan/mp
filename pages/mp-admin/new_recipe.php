<?php

require_once dirname(__DIR__).'../../pages/views.php';

$stock = new Stock();
$outof_stock = $stock->checkOutOfStock();
$low_stock = $stock->checkLowStock();
$outof_stock = $stock->checkOutOfStock();
$outof_stock = $stock->checkOutOfStock();

$recipe = new Recipe();
$ingredients = $recipe->getAllIngredients();
$mealType = $recipe->getAllMealTypes();
$mealCategory = $recipe->getAllMealCategoryType();

echo $twig->render('mp-admin/recipe.twig', array(
    'page' => 'Recipe',
    'title' => 'Test',
    'subtitle' => 'Control panel',
    'outofstock' => sizeof($outof_stock),
    'lowstock' => sizeof($low_stock),
    'today' => 20,
    'nextweek' => 30,
    'ingredients' => $ingredients,
    'mealType' => $mealType,
    'mealCategory' => $mealCategory,
    'path' => IMAGES,
    'admin_data' =>$details,
    'stock_data'=>$stock_data,
    'order_data'=>$order_data
 ));
