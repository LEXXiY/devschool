<?php
/**
 * Example Application
 *
 * @package Example-application
 */

require './libs/Smarty.class.php';
require './data.php';

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



$smarty->assign("cities", $cities);
$smarty->assign("categories", $all_category);

$smarty->display('index.tpl'); 