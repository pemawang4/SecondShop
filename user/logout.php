<?php 
    $path = $_SERVER['DOCUMENT_ROOT'].'/secondShop/';
    include $path . 'classes/session.php';

    Session::start();
    Session::destroy();
?>