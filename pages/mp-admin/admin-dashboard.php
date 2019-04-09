<?php

require_once dirname(__DIR__).'../../pages/views.php';



echo $twig->render('mp-admin/admin-dashboard.twig', array(
    'page' => 'Dashboard',
    'subtitle' => 'Control panel',
    'stock_data'=>$stock_data,
    'order_data'=>$order_data,
    'today' => 20,
    'nextweek' => 30, 'path' => IMAGES,
    'admin_data' =>$details ));
