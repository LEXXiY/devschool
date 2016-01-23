<?php
require_once('lib.php');
require_once('data.php');

error_reporting(E_ERROR | E_NOTICE | E_PARSE | E_WARNING);
ini_set('display_errors', 1);

if (!empty($_POST)) {
    
    $id = (isset($_POST['id'])) ? $_POST['id'] : '';
    
    if(isset($_GET['action']) && $_GET['action']=='update' && isset($_SESSION['ads'][$id])){
        
        $_SESSION['ads'][$id] = prepareAd($_POST);

    } else {
        
        $_SESSION['ads'][] = prepareAd($_POST);
        
    }
    
    // $data = serialize($_POST);
    
    print_r($_POST);
} 
// elseif (/* condition */) {
//     // code...
// } elseif (/* condition */) {
//     // code...
// } else {
//     // code...
// }

if(!isset($formParam)){
    $formParam = prepareAd();
}


require_once('form.php');