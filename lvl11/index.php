<?php
/**
 * Board system like avito.ru
 *
 * @package Example-application
 */

require './settings.php';

if( !empty($_POST) ) {

    $id = (isset($_POST['id'])) ? $_POST['id'] : '';
    $currads = selectAll();

    if( isset($_GET['action']) && $_GET['action']=='update' && isset($currads[$id]) ){

        $data = prepareData($_POST);
        updateInDb($id, $data);

    } else {

        $data = prepareData($_POST);
        insertToDb($data);

    }

} elseif( isset($_GET['del']) ){

    deleteFromDb((int)$_GET['del']);

} elseif( isset($_GET['edit']) && !isset($_GET['action']) ){
    
    $data = selectById($_GET['edit']);

    $formParam = prepareData($data);

}

if(!isset($formParam)){
    
    $formParam = prepareData();
}

$cities = get_cities();
$categories = get_categories();

$ads = selectAll();

$smarty->assign("cities", $cities);
$smarty->assign("categories", $categories); // assoc array group => array
$smarty->assign("formParam", $formParam);
$smarty->assign("allads", $ads);

$smarty->display('index.tpl'); 