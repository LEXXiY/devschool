<?php
$filename = "config.json";
if (file_exists($filename)) {
    
    $file = unserialize(file_get_contents('config.json'));
    
    $servername = $file[0];
    $username = $file[1];
    $password = $file[2];
    $database = $file[3];
    $dbport = 3306;
    
    
// Create connection
    $db = new mysqli($servername, $username, $password, $database, $dbport);
    $db->set_charset("utf8");

    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }
    
} else {
    echo "Данные подключения к базе не найдены, перейдите к <a href='install.php'>файлу установки</a>";
}