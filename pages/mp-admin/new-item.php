<?php
require_once dirname(__DIR__).'../../pages/views.php';

if (isset($_POST['action'])) {
    if ($_POST['action'] === 'NEW_ITEM') {
echo $twig->render('mp-admin/new-item.twig', array('login' => 'Login', 'page' => 'Add new Item','type'=>$type));

    }
}else{
    echo $twig->render('mp-admin/new-item.twig', array('login' => 'Login', 'page' => 'Add new Item','logedin-admin' =>$details));
}