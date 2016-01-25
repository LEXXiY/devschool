<?php
require_once('libq.php');
require_once('data.php');

error_reporting(E_ERROR | E_NOTICE | E_PARSE | E_WARNING);
ini_set('display_errors', 1);

print_r($_COOKIE);

if( !empty($_POST) ) {
    
    $id = (isset($_POST['id'])) ? $_POST['id'] : '';
    
    if( isset($_GET['action']) && $_GET['action']=='update' && isset($data["ads"][$id]) ){
        
        $_COOKIE["ads"][$id] = serialize(prepareAd($_POST));

    } else {
        
        setcookie("ads", serialize(prepareAd($_POST)), time()+3600);
        
    }
    
} elseif( isset($_GET['del']) ){
    
    unset($_COOKIE["ads"][$id]);
    
} elseif( isset($_GET['edit']) && !isset($_GET['action']) ){
    
    $id = $_GET['edit'];
   
    $formParam = prepareAd($_COOKIE["ads"][$id]);

}

if(!isset($formParam)){
    $formParam = prepareAd();
}


require_once('formq.php');