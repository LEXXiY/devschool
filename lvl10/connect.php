<?php
$filename = "config.json";
if (file_exists($filename)) {
    
    $file = unserialize(file_get_contents('config.json'));
    
    $servername = $file[0];
    $username = $file[1];
    $password = $file[2];
    $database = $file[3];
    $dbport = 3306;
    
    // Подключаем библиотеку.
    require_once "./dbsimple/config.php";
    require_once "./dbsimple/DbSimple/Generic.php";
    
    require_once "./firephp/FirePHP.class.php";
    
    $firephp = FirePHP::getInstance(true);
    
    $firephp->setEnabled(true);
    
    $myArray = array(
        'name'=>'Alexey',
        'age'=>31
    );
    
    $firephp->log($myArray);
    
    // Устанавливаем соединение.
    $link = "mysqli://" . $file[1] . ":" . $file[2] . "@" . $file[0] . "/" . $file[3];
    $db = DbSimple_Generic::connect($link);
    
    $db->setErrorHandler('databaseErrorHandler');

    // Код обработчика ошибок SQL.
    function databaseErrorHandler($message, $info)
    {
        // Если использовалась @, ничего не делать.
        if (!error_reporting()) return;
        // Выводим подробную информацию об ошибке.
        echo "SQL Error: $message<br><pre>"; 
        print_r($info);
        echo "</pre>";
        exit();
    }
    
} else {
    echo "Данные подключения к базе не найдены, перейдите к <a href='install.php'>файлу установки</a>";
}