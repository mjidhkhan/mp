<?php

require_once dirname(__DIR__) . "/pages/views.php";



if (isset($_POST['action'])) {
    
    $user = new User();
    if ($_POST['action'] === 'REGISTER') {
        $user->RegisterUser($_POST);
        $type = Session::flashType();
        if ($type == 'danger' || $type == 'warning') {
            echo $twig->render('register.twig', array('page' => 'New Membership', 'message' => Session::flash(), 'type' => $type, 'title' => 'Whoops..!'));
        } else {
           echo $twig->render('login.twig', array('page' => 'Members Login', 'message' => Session::flash(), 'type' => $type, 'title' => 'Whoops..!'));
        }
    }

} else {
    echo $twig->render('register.twig', array('page' => 'New Membership'));
}
