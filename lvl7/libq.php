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

function showAds($arr=null){
    if($arr){
        echo '<h2>Все объявления</h2>';
        if(!empty($arr)){
            foreach ($arr as $id=>$value){
                echo '<a style="border-bottom:1px solid orange" href="?edit='. $id . '">' . $value['title'] . '</a>|' . $value['price'] . '|' . $value['seller_name'] . '| <a href="?del=' . $id . '">Удалить</a><br/>';
            }
        }
    } else {
        return false;
    }
}