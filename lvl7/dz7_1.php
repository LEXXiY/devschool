<?php
require_once('lib.php');
require_once('data.php');

error_reporting(E_ERROR | E_NOTICE | E_PARSE | E_WARNING);
ini_set('display_errors', 1);

if( !empty($_POST) ) {
    
    $id = (isset($_POST['id'])) ? $_POST['id'] : '';
    
    if( isset($_GET['action']) && $_GET['action']=='update' && isset($_COOKIE["ads[".$id."]"]) ){
        
        setcookie("ads[".$id."]", serialize(prepareAd($_POST)), time());

    } else {
        
        setcookie("ads[]", prepareAd($_POST), time());
        
    }
    
} elseif( isset($_GET['del']) ){
    
    setcookie("ads[".$_GET['del']."]", "", time()-3600);
    
} elseif( isset($_GET['edit']) && !isset($_GET['action']) ){
    
    $id = $_GET['edit'];
   
    $formParam = prepareAd($_COOKIE["ads[".$id."]"]);

}

if(!isset($formParam)){
    $formParam = prepareAd();
}


require_once('form.php');