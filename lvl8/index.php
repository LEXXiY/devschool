<?php
/**
 * Example Application
 *
 * @package Example-application
 */

require './libs/Smarty.class.php';
require './fields.php';
require './helpers.php';

$smarty = new Smarty();

//$smarty->force_compile = true;
$smarty->debugging = true;

$smarty->template_dir = './templates/';
$smarty->compile_dir = './templates_c/';
$smarty->config_dir = './configs/';
$smarty->cache_dir = './cache/';

$all_category = [];

foreach($categories as $group=>$single_cat){
    $all_category[$group] = $single_cat;
}

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

$smarty->assign("cities", $cities);
$smarty->assign("categories", $all_category);

$smarty->display('index.tpl'); 