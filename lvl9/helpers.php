<?php

function all_cities($city_id=''){
    global $cities;
    foreach ($cities as $id=>$city){
        $selected = ($city_id == $id) ? 'selected=""' : '';
        echo '<option data-coords=",,"' . $selected . ' value="' . $id . '">' . $city . '</option>';
    }
}

function all_categories($category_id=''){
    global $categories;
    foreach ($categories as $name=>$block_category){
        echo '<optgroup label="' . $name . '">';

        foreach ($block_category as $id=>$category){
            $selected = ($category_id == $id) ? 'selected=""' : '';
            echo '<option value="' . $id . '"'. $selected .'>' . $category . '</option>';
        }

        echo '</optgroup>';
    }
}

function prepareAd($data = null){
    return array(
        'forma' => (isset($data['forma']) && $data['forma'] == 1) ? 1 : 0,
        'seller_name' => isset($data['seller_name']) ? $data['seller_name'] : '',
        'email' => isset($data['email']) ? $data['email'] : '',
        'newsletter' => (isset($data['newsletter']) && $data['newsletter'] == 1) ? 1 : 0,
        'phone' => isset($data['phone']) ? $data['phone'] : '',
        'location_id' => isset($data['location_id']) ? $data['location_id'] : '',
        'category_id' => isset($data['category_id']) ? $data['category_id'] : '',
        'title' => isset($data['title']) ? $data['title'] : '',
        'description' => isset($data['description']) ? $data['description'] : '',
        'price' => isset($data['price']) ? $data['price'] : ''
    );
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