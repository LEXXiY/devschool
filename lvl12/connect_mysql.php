<?php
$filename = "config.json";

if (file_exists($filename)) {
    
    $file = unserialize(file_get_contents('config.json'));
    $link = "mysqli://" . $file[1] . ":" . $file[2] . "@" . $file[0] . "/" . $file[3];
    
    require_once $project_root.'/dbsimple/config.php';
    require_once $project_root.'/dbsimple/dbsimple/Generic.php';
    
    $mysql = mydb::getInstance();
    $mysql->setConfig($link);
    $db = $mysql->getDb();
    
    // // Устанавливаем обработчик ошибок.
    // $db->setErrorHandler('databaseErrorHandler');
    // // Код обработчика ошибок SQL.
    // function databaseErrorHandler($message, $info){
    //     // Если использовалась @, ничего не делать.
    //     if (!error_reporting()) return;
    //     // Выводим подробную информацию об ошибке.
    //     echo "SQL Error: $message<br><pre>"; 
    //     print_r($info);
    //     echo "</pre>";
    //     exit();
    // }
        
    require_once ($project_root.'/FirePHPCore/FirePHP.class.php');
   
} else {
    echo "Данные подключения к базе не найдены, перейдите к <a href='install.php'>файлу установки</a>";
}