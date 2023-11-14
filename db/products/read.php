<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=utf-8");
require('../db.php');
try {

    $users = array();
    foreach($db->query('SELECT * from product')as $row){
        array_push($users, array(
            'id'=>$row['id'],
            'nameproduct'=>$row['nameproduct'],
            'images'=>$row['images'],
            'price'=>$row['price'],
            'descriptions'=>$row['descriptions'],
        ));
    };
    echo json_encode($users);
    $db = null;
} catch (PDOException $e) {
    print "Error!: ". $e->getMessage() ."<br/>";
    die();
}
?>