<?php
/**
 * Created by PhpStorm.
 * User: a.evseev
 * Date: 04.02.2016
 * Time: 9:11
 */
 
    $servername = $_POST['servername']||getenv('IP');
    $username = $_POST['username']||getenv('C9_USER');
    $password = "";
    $database = "c9";
    $dbport = 3306;
    
    // Create connection
    $db = new mysqli($servername, $username, $password, $database, $dbport);

    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    } 

    function dropBase($db){
        
        $sql = "DROP TABLE IF EXISTS `ads`, `cities`, `categories`";
    
        $result = $db->query($sql);
        
    }
    dropBase($db);
    
    function createTable($db){
        
        
        
    }
    createTable($db);
    ?>

    <form type="POST">
        <p>
            <label for="">Server Name</label>
            <input type="text" name="servername"/><br/>
        </p>
        <p>
            <label for="">User Name</label>
            <input type="text" name="username"/><br/>
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