<?php

require_once dirname(__DIR__).'../../pages/views.php';
$recipe = new Recipe();
$ingredients = $recipe->getAllIngredients();
$mealType = $recipe->getAllMealTypes();
$mealCategory = $recipe->getAllMealCategoryType();

echo $twig->render('mp-admin/recipe.twig', array(
    'page' => 'Recipe',
    'title' => 'Test',
    'ingredients' => $ingredients,
    'mealType' => $mealType,
    'mealCategory' => $mealCategory,
    'path' => IMAGES,
    'fullname' => Session::get('fullname'), ));
