<?php
require_once dirname(__DIR__).'../../pages/views.php';

echo $twig->render('mp-admin/recipe.twig', array('page' => 'Recipe', 'title'=>'Test'));
