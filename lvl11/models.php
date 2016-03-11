<?php

function get_cities(){
    
    global $db;

    $result = $db->selectCol("SELECT city_id AS ARRAY_KEY, city FROM cities");
    
    return $result;

}

function get_categories(){
    
    global $db;
    
    $result = $db->select('SELECT *, cat_id AS ARRAY_KEY FROM categories');
    
    $options = array();
    
    $maincat = array();
    
    foreach ($result as $value){
        
        if ($value['parent'] === NULL) {
            $options[$value['cat_name']] = array();
            $maincat[$value['cat_id']] = $value['cat_name'];
        } elseif (array_key_exists($value['parent'],$maincat)){
            $options[$maincat[$value['parent']]][$value['cat_id']] = $value['cat_name'];
        }

    }

   return $options;
    
}

function insertToDb($arr){
    
    global $db;
    
    $db->query('INSERT INTO ads SET ?a', $arr);

}

function updateInDb($id, $data){
    
    global $db;
    
    $db->query('UPDATE ads SET ?a WHERE id=?d', $data, $id);
    
}

function selectById($id){
    
    global $db;
    
    $result = $db->selectRow("SELECT * FROM `ads` WHERE id=?d", $id);
    
    return $result;
}

function selectAll(){
    
    global $db;
    
    $result = $db->select("SELECT *, id AS ARRAY_KEY FROM `ads`");
    
    return $result;
}

function deleteFromDb($id){
    
    global $db;
        
    $db->query('DELETE FROM `ads` WHERE id=?d', $id);

}