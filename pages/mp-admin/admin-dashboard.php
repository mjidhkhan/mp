<?php

require_once dirname(__DIR__).'../../pages/views.php';

$stock = new Stock();
$outof_stock = $stock->checkOutOfStock();
$low_stock = $stock->checkLowStock();
$outof_stock = $stock->checkOutOfStock();
$outof_stock = $stock->checkOutOfStock();

echo $twig->render('mp-admin/admin-dashboard.twig', array(
    'page' => 'Dashboard',
    'subtitle' => 'Control panel',
    'outofstock' => sizeof($outof_stock),
    'lowstock' => sizeof($low_stock),
    'today' => 20,
    'nextweek' => 30, 'path' => IMAGES,
    'fullname' => Session::get('fullname'), ));
