<?php
require_once dirname(__DIR__) . "/config/config.php";
function response($id){
    echo $id;
    echo $twig->render('mp-admin/update-item.twig', array('stock' => 'Stock', 
        'page' => 'Update Item',
        'stock'=>$data, 
        'admin_data' =>$details,
        'stock_data'=>$stock_data,
        'order_data'=>$order_data
        ));

}