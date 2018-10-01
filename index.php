<?php
    include 'database/db_tools.php';
    //ตัวอย่าง
    $db = new db_tools();
    $db->openConnection();    
    // $db->createStement("select * from zoo where zoo_enable = :sts");
//      $db->conditions("zoo","zoo_type = :sts")->Stement();
//     $db->findByPK("zoo","zoo_id",":sts")->Stement();
    $db->findAll("zoo")->Stement();
     $db->runStmSql(array());
    while($cols = $db->moveNext_getRow()){
        echo $cols[1],"<br>";
        // echo $cols['zoo_name'],"<br>";
}    
    echo $db->closeConnection();
?>