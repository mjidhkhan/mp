<?php
require_once dirname(__DIR__).'../../pages/views.php';
$recipe = new Recipe();
$data = $recipe->getAllIngredients();


echo $twig->render('mp-admin/recipe.twig', array(
	'page' => 'Recipe', 
	'title'=>'Test', 
	'data'=>$data,
	'path' => IMAGES, 
	'fullname' => Session::get('fullname')));
