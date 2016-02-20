<?php

function get_cities($db){

    $sql = "SELECT * FROM cities";
    
    $result = $db->query($sql);
    
    while ($row = $result->fetch_assoc()){
        $arr[$row['city_id']]=$row['city'];
    }
    
    return $arr;

}

function get_categories($db){
    
}

function insertToDb($arr, $db){
    
    $values = implode('","', $arr);
    
    $sql = "INSERT INTO ads (`forma`, `seller_name`, `email`, `newsletter`, `phone`, `location_id`, `category_id`, `title`, `description`, `price`) VALUES (\"".$values."\")";
    
    $result = $db->query($sql);
    
    return true;
}

function updateInDb($id, $data, $db){
    
    $sql = "UPDATE ads SET ";
    $sql .= "forma=" . $data['forma'];
    $sql .= ",seller_name=\"" . $data['seller_name'] . "\"";
    $sql .= ",email=\"" . $data['email'] . "\"";
    $sql .= ",newsletter=" . $data['newsletter'];
    $sql .= ",phone=\"" . $data['phone'] . "\"";
    $sql .= ",location_id=" . $data['location_id'];
    $sql .= ",category_id=" . $data['category_id'];
    $sql .= ",title=\"" . $data['title'] . "\"";
    $sql .= ",description=\"" . $data['description'] . "\"";
    $sql .= ",price=" . $data['price'] . " ";
    $sql .= "WHERE id=$id";
    
    $result = $db->query($sql);
    
    return true;
    
}

function selectById($id, $db){
    
    $sql = "SELECT * FROM `ads` WHERE id=$id";
    
    $result = $db->query($sql);
    
    return $result->fetch_assoc();
}

function selectAll($db){
    
    $sql = "SELECT * FROM `ads`";
    
    $result = $db->query($sql);
    
    while ($row = $result->fetch_assoc()){
        $arr[$row['id']]=$row;
    }
    
    return $arr;
}

function deleteFromDb($id, $db){
    
    if(is_numeric($id)){
    
        $sql = "DELETE FROM `ads` WHERE id=$id";
        
        $db->query($sql);
        
        return true;
    
    }
}