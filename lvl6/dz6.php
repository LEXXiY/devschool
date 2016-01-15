<?php
session_start();

if($_SESSION['ads']){
    $_SESSION['ads'][] = $_SESSION[];
}

if(array_key_exists('ads', $_SESSION) && !empty($_SESSION['ads'])){
    
    foreach ($_SESSION['ads'] as $id=>$value){
        echo '<a href="?edit='. $id . '">' . $value['title'] . '</a>|' . $value['cost'] . '|' . $value['name'] . '| <a href="?del="' . $id .'">Удалить</a>';
    }
    
}
?>