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