<?php
require_once dirname(__DIR__).'/pages/views.php';
$stock = new Stock();
if (isset($_SESSION)) {
    Session::destroy();
    Session::init();
}

if (isset($_POST['addItem'])) {
    
} else {
    echo $twig->render('mp-admin/new-item.twig', array('login' => 'Login', 'page' => 'Login'));
}
