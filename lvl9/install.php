<?php
/**
 * Created by PhpStorm.
 * User: a.evseev
 * Date: 04.02.2016
 * Time: 9:11
 */
 
    $servername = getenv('IP');
    $username = getenv('C9_USER');
    $password = "";
    $database = "c9";
    $dbport = 3306;
    
    // Create connection
    $db = new mysqli($servername, $username, $password, $database, $dbport);

    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    } 
    // echo "Connected successfully (".$db->host_info.")";
    
    require 'fields.php';
    
    ?>

    <form type="POST">
        <p>
            <label for="">Server Name</label>
            <input type="text" name=""/><br/>
        </p>
        <p>
            <label for="">User Name</label>
            <input type="text" name=""/><br/>
        </p>
        <p>
            <label for="">Password</label>
            <input type="text" name=""/><br/>
        </p>
        <p>
            <label for="">Database</label>
            <input type="text" name=""/><br/>
        </p>
        <p>
            <input type="submit" value="Install"/>
        </p>
    </form>