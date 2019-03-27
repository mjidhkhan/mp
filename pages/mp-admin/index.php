<?php

require_once "../../config/config.php";
require '../../vendor/Autoload.php';

echo $twig->render('mp-admin/admin-login.twig', array('page' => 'Admin Login'));
