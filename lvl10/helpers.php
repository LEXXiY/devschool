<?php
function prepareData($data = null){
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