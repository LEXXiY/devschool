<?php
if ($db){
function get_cities(){
    
    global $db;

    $sql = "SELECT * FROM cities";
    
    $result = $db->query($sql);
    
    while ($row = $result->fetch_assoc()){
        $arr[$row['city_id']]=$row['city'];
    }
    
    return $arr;

}

function get_categories(){
    
    global $db;
    
    $sql = "SELECT * FROM categories";
    
    $result = $db->query($sql);
    
    $options = array();
    
    $maincat = array();
    
    while ($row = $result->fetch_assoc()){
        
        if ($row['parent'] === NULL) {
            $options[$row['cat_name']] = array();
            $maincat[$row['cat_id']] = $row['cat_name'];
        } elseif (array_key_exists($row['parent'],$maincat)){
            $options[$maincat[$row['parent']]][$row['cat_id']] = $row['cat_name'];
        }

    }

    return $options;
    
}

function insertToDb($arr){
    
    global $db;
    
    $values = implode('","', $arr);
    
    $sql = "INSERT INTO ads (`forma`, `seller_name`, `email`, `newsletter`, `phone`, `location_id`, `category_id`, `title`, `description`, `price`) VALUES (\"".$values."\")";
    
    $result = $db->query($sql);
    
    return true;
}

function updateInDb($id, $data){
    
    global $db;
    
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

function selectById($id){
    
    global $db;
    
    $sql = "SELECT * FROM `ads` WHERE id=$id";
    
    $result = $db->query($sql);
    
    return $result->fetch_assoc();
}

function selectAll(){
    
    global $db;
    
    $arr=array();
    
    $sql = "SELECT * FROM `ads`";
    
    if(isset($db) && $result = $db->query($sql)){
    
        while ($row = $result->fetch_assoc()){
            $arr[$row['id']]=$row;
        }
    }
    
    return $arr;
}

function deleteFromDb($id){
    
    global $db;
    
    if(is_numeric($id)){
    
        $sql = "DELETE FROM `ads` WHERE id=$id";
        
        $db->query($sql);
        
        return true;
    
    }
}
}