<?php

require_once dirname(__DIR__).'/pages/views.php';
$user = new User();
if (isset($_SESSION)) {
    Session::destroy();
    Session::init();
}

if (isset($_POST['action'])) {
    if ($_POST['action'] === 'LOGIN') {
        $user->LoginUser($_POST);
        $type = Session::flashType();
        if ($type == 'danger' || $type == 'warning') {
            echo $twig->render('mp-client/login.twig', array('page' => 'Login', 'message' => Session::flash(), 'type' => $type, 'login' => 'Login', 'title' => 'Whoops..!'));
        } else {
            $product = new Products();
            $stock = new Stock();
            $outof_stock = $stock->checkOutOfStock();
            $low_stock = $stock->checkLowStock();
            $outof_stock = $stock->checkOutOfStock();
            $outof_stock = $stock->checkOutOfStock();

            if(Session::get('status') == 1 || Session::get('status')== 2){
                $product = new Products();
            echo $twig->render('/mp-admin/admin-dashboard.twig', array('products' => $product->getAllMeals(),
                'page' => 'Dashboard',
                'subtitle' => 'Control panel',
                'message' => Session::flash(),
                'type' => Session::flashType(),
                'title' => 'Success..!', 'path' => IMAGES,
                'fullname' => Session::get('fullname'),
              
                'outofstock' => sizeof($outof_stock),
                'lowstock' => sizeof($low_stock),
                'today' => 20,
                'nextweek' => 30, 'path' => IMAGES,
                'fullname' => Session::get('fullname'),
            
            ));

            }else{
            echo $twig->render('mp-client/account.twig', array('login' => 'Logout', 'products' => $product->getAllMeals(),
                'page' => 'My Account',
                'message' => Session::flash(),
                'type' => Session::flashType(),
                'title' => 'Success..!', 'path' => IMAGES,
                'fullname' => Session::get('fullname'), ));
            }
        }
    }
} else {
    echo $twig->render('mp-client/login.twig', array('login' => 'Login', 'page' => 'Login'));
}
