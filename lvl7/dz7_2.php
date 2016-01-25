<?php
require_once('lib.php');
require_once('data.php');

error_reporting(E_ERROR | E_NOTICE | E_PARSE | E_WARNING);
ini_set('display_errors', 1);

$data = (file_exists('ads.txt')) ? readFromFile('ads.txt'):'';

if( !empty($_POST) ) {
    
    $id = (isset($_POST['id'])) ? $_POST['id'] : '';
    
    if( isset($_GET['action']) && $_GET['action']=='update' && isset($data[$id]) ){
        
        $data[$id] = $_POST;

    } else {
        
        $data[] = $_POST;
        
    }
    
} elseif( isset($_GET['del']) ){
    
    unset($data[$_GET['del']]);
    
} elseif( isset($_GET['edit']) && !isset($_GET['action']) ){
    
    $id = $_GET['edit'];
   
    $formParam = prepareAd($data[$id]);

}

if(!isset($formParam)){
    $formParam = prepareAd();
}

require_once('form.php');

saveFile('ads.txt', $data);