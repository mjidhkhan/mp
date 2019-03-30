<?php

require_once dirname(__DIR__).'../../pages/views.php';
$user = new User();

if (isset($_POST['action'])) {
    if ($_POST['action'] === 'LOGIN') {
        $user->AdminLogin($_POST);
        $type = Session::flashType();
        if ($type == 'danger' || $type == 'warning') {
            echo $twig->render('mp-admin/admin-login.twig', array('page' => 'Admin Login', 'message' => Session::flash(), 'type' => $type, 'title' => 'Whoops..!'));
        } else {
            $product = new Products();
            echo $twig->render('mp-admin/admin-dashboard.twig', array('products' => $product->getAllMeals(),
                'page' => 'My Account',
                'message' => Session::flash(),
                'type' => Session::flashType(),
                'title' => 'Success..!', 'path' => IMAGES,
                'fullname' => Session::get('fullname'), ));
        }
    }
} else {
    echo $twig->render('mp-admin/admin-login.twig', array('page' => 'Admin Login'));
}
