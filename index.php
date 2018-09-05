<?php
    include 'database/db_tools.php';
    
    $db = new db_tools();
    $con = $db->openConnection();    
    if($con){
        echo "get it";
    }else{
        echo "not";
    }
?>