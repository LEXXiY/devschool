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

// function readData($db){
    
//     $result = $db->query("SELECT * FROM `cities`");
    
//     $result->fetch_assoc();
    
//     return $result;
    
// }

// function saveData($array, $db){
    
//     if (empty($array)) return;
    
//     $values = implode(',', $array);
    
//     $sql = "INSERT INTO `ads` VALUES ($values)";
    
//     $db->query($sql);
    
// }

function insertToDb($arr, $db){
    
    $values = implode(', ', $arr);
    
    $sql = "INSERT INTO ads (`id`, `forma`, `seller_name`, `email`, `newsletter`, `phone`, `location_id`, `category_id`, `title`, `description`, `price`) VALUES (NULL, $values)";
    
    $result = $db->query($sql);
    
    return true;
}

function selectFromDb($id = NULL, &$db){
    
    global $db;
    
    $sql = "SELECT * FROM `ads` LIMIT 10";
    
    $db->query($sql);
    
    return true;
}

function updateInDb($id){
    
}

function deleteFromDb($id){
    
    global $db;
    
    if(is_numeric($id)){
    
        $sql = "DELETE FROM `ads` WHERE id=$id";
        
        $db->query($sql);
        
        return true;
    
    }
}