<?php

require_once dirname(__DIR__) . '/pages/views.php';
$user = new User();
$user->LogOut();
sleep(0.25);
echo $twig->render('mp-client/login.twig', array('page' => 'Login'));

 