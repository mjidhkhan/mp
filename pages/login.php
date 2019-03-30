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

            echo $twig->render('mp-client/account.twig', array('login' => 'Logout', 'products' => $product->getAllMeals(),
                'page' => 'My Account',
                'message' => Session::flash(),
                'type' => Session::flashType(),
                'title' => 'Success..!', 'path' => IMAGES,
                'fullname' => Session::get('fullname'), ));
        }
    }
} else {
    echo $twig->render('mp-client/login.twig', array('login' => 'Login', 'page' => 'Login'));
}
