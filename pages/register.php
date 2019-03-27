<?php

require_once dirname(__DIR__).'/pages/views.php';

if (isset($_POST['action'])) {
    $user = new User();
    if ($_POST['action'] === 'REGISTER') {
        $user->RegisterUser($_POST);
        $type = Session::flashType();
        if ($type == 'danger' || $type == 'warning') {
            echo $twig->render('mp-client/register.twig', array('page' => 'New Membership', 'message' => Session::flash(), 'type' => $type, 'login' => 'Login', 'title' => 'Whoops..!'));
        } else {
            echo $twig->render('mp-client/login.twig', array('page' => 'Members Login', 'message' => Session::flash(), 'type' => $type, 'login' => 'Login', 'title' => 'Success..!'));
        }
    }
} else {
    echo $twig->render('mp-client/register.twig', array('page' => 'New Membership'));
}
