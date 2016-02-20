<?php
/**
 * Board system like avito.ru
 *
 * @package Example-application
 */

require './libs/Smarty.class.php';
require './fields.php';
require './models.php';
require './helpers.php';

error_reporting(E_ERROR | E_NOTICE | E_PARSE | E_WARNING);
ini_set('display_errors', 1);

$smarty = new Smarty();

// $smarty->force_compile = true;
$smarty->debugging = true;

$smarty->template_dir = './templates/';
$smarty->compile_dir = './templates_c/';
$smarty->config_dir = './configs/';
$smarty->cache_dir = './cache/';

$all_category = [];

foreach($categories as $group=>$single_cat){
    $all_category[$group] = $single_cat;
}

$ads = selectAll($db);

if( !empty($_POST) ) {

    $id = (isset($_POST['id'])) ? $_POST['id'] : '';

    if( isset($_GET['action']) && $_GET['action']=='update' && isset($ads[$id]) ){

        $data = prepareAd($_POST);
        updateInDb($id, $data, $db);

    } else {

        $data = prepareAd($_POST);
        insertToDb($data, $db);

    }

} elseif( isset($_GET['del']) ){

    deleteFromDb((int)$_GET['del'], $db);

} elseif( isset($_GET['edit']) && !isset($_GET['action']) ){
    
    $data = selectById($_GET['edit'], $db);

    $formParam = prepareAd($data);

}

if(!isset($formParam)){
    
    $formParam = prepareAd();
}

$cities = get_cities($db);

$smarty->assign("cities", $cities);
$smarty->assign("categories", $all_category); // assoc array group => array
$smarty->assign("formParam", $formParam);
$smarty->assign("allads", $ads);


$smarty->display('index.tpl'); 