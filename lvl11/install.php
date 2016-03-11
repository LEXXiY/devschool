<?php
/**
 * Created by PhpStorm.
 * User: a.evseev
 * Date: 04.02.2016
 * Time: 9:11
 */
 
//error_reporting(E_ERROR | E_NOTICE | E_PARSE | E_WARNING);
//ini_set('display_errors', 1);
 
 if($_POST){
    $servername = $_POST['servername'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $database = $_POST['database'];
    $dbport = 3306;
    
    // Устанавливаем соединение.
    $link = "mysqli://$username:$password@$servername/$database";
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
    
    function successInstall(){
        
        global $_POST;
        
        $settings = array($_POST['servername'], $_POST['username'], $_POST['password'], $_POST['database']);
        
        $data = serialize($settings);
        
        file_put_contents('./config.json', $data);
        
        echo "Установка прошла успешно, перейдите на <a href='/'>главную страницу</a>";
    }
    
    function createTable(){
        
        global $db;
        
        $sql = file_get_contents("dump.sql");
        
        $queries = explode(';', $sql);

        for ($i=0;$i<count($queries);$i++){
            $db->query($queries[$i]);
        }
        
        successInstall();
    }
    createTable();
}
    ?>
    <h1>Установка avito 2.0 на ваш сервер</h1>
    <p>Необходимо правильно заполнить все поля для продолжения установки</p>
    <form method="POST">
        <p>
            <label for="">Server Name</label>
            <input type="text" name="servername" value="<?php getenv('IP')?>"/><br/> 
        </p>
        <p>
            <label for="">User Name</label>
            <input type="text" name="username" value="<?php getenv('C9_USER')?>"/><br/>
        </p>
        <p>
            <label for="">Password</label>
            <input type="text" name="password"/><br/>
        </p>
        <p>
            <label for="">Database</label>
            <input type="text" name="database"/><br/>
        </p>
        <p>
            <input type="submit" value="Install"/>
        </p>
    </form>