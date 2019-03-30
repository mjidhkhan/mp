<?php

require_once dirname(__DIR__).'../../pages/views.php';
echo $twig->render('mp-admin/admin-dashboard.twig', array(
    'page' => 'Recipe',
    'fullname' => Session::get('fullname'), ));
