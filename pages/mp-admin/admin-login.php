<?php

require_once dirname(__DIR__).'../../pages/views.php';
$user = new User();

$stock = new Stock();
$outof_stock = $stock->checkOutOfStock();
$low_stock = $stock->checkLowStock();
$outof_stock = $stock->checkOutOfStock();
$outof_stock = $stock->checkOutOfStock();

if (isset($_POST['action'])) {
    if ($_POST['action'] === 'LOGIN') {
        $user->AdminLogin($_POST);
        $type = Session::flashType();
        if ($type == 'danger' || $type == 'warning') {
            echo $twig->render('mp-admin/admin-login.twig', array('page' => 'Admin Login', 'message' => Session::flash(), 'type' => $type, 'title' => 'Whoops..!'));
        } else {
            $product = new Products();
            echo $twig->render('mp-admin/admin-dashboard.twig', array('products' => $product->getAllMeals(),
                'page' => 'Dashboard',
                'subtitle' => 'Control panel',
                'message' => Session::flash(),
                'type' => Session::flashType(),
                'stock_data'=>$stock_data,
                'order_data'=>$order_data,
                'today' => 20,
                'nextweek' => 30,
                'path' => IMAGES,
                'fullname' => Session::get('fullname'),
                'admin_data' =>$details
            ));
        }
    }
} else {
    echo $twig->render('mp-admin/admin-login.twig', array('page' => 'Admin Login'));
}
