<?php

require_once './connect.php';

class MysqlHelpers {
    
    function isEmpty($tableName)
    {
        global $db;
        $sql = "SELECT * FROM `$tableName`";
        $db->query($sql);
        if ($db->num_rows==0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
}