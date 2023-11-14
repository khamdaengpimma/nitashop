<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=utf-8");
require('../db.php');
try {

    
    $stmt=$db->prepare("SELECT * from product where id= ?");
    $stmt->execute([$_GET['id']]);
    foreach ($stmt as $row){
        $users = array(
            'id'=>$row['id'],
            'nameproduct'=>$row['nameproduct'],
            'images'=>$row['images'],
            'price'=>$row['price'],
            'descriptions'=>$row['descriptions'],
        );
        echo json_encode($users);
        break;
    };
    
    $db = null;
} catch (PDOException $e) {
    print "Error!: ". $e->getMessage();
    die();
}
?>