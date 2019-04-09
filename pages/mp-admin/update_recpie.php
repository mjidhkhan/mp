<?php
require_once dirname(__DIR__).'../../pages/views.php';

if (isset($_POST['action'])) {
    if ($_POST['action'] === 'UPDATE_ITEM') {
echo $twig->render('mp-admin/update-item.twig', array('login' => 'Login', 'page' => 'Update Item','type'=>$type));

    }
}else{
    echo $twig->render('mp-admin/update-item.twig', array('login' => 'Login', 'page' => 'Update Item', 'admin_data' =>$details));
}