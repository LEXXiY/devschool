<?php
require_once('libq.php');
require_once('data.php');

error_reporting(E_ERROR | E_NOTICE | E_PARSE | E_WARNING);
ini_set('display_errors', 1);

$data = (!empty($_COOKIE['ads'])) ? unserialize($_COOKIE['ads']) : [];

if( !empty($_POST) ) {
    
    $id = (isset($_POST['id']) && is_numeric($_POST['id'])) ? $_POST['id'] : '';
    
    if( isset($_GET['action']) && $_GET['action']=='update' && isset($data[$id]) ){
        
        $data[$id] = prepareAd($_POST);

    } else {
        
        $data[] = prepareAd($_POST);
        
    }
    
} elseif( isset($_GET['del']) && isset($data[$_GET['del']]) ){

    $id = (int)$_GET['del'];

    unset($data[$id]);
    
} elseif( isset($_GET['edit']) && !isset($_GET['action']) ){

    $id = (int)$_GET['edit'];
   
    $formParam = prepareAd($data[$id]);

}

if(!empty($data)) setcookie("ads", serialize($data), time()+3600);

if(!isset($formParam)){
    $formParam = prepareAd();
}

require_once('formq.php');