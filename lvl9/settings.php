<?php
require './libs/Smarty.class.php';
// require './fields.php';
require './connect.php';
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