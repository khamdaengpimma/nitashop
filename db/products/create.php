<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=utf-8");
require('../db.php');

$data = json_decode(file_get_contents("php://input"));
if($_SERVER['REQUEST_METHOD']!=="POST"){
    echo json_encode(array("status"=>"error"));
    die();
}

try {
    $stmt = $db->prepare("INSERT INTO product( nameproduct,images,price,descriptions) VALUES (?, ?, ?, ?)");
    $stmt->bindParam(1, $data->nameproduct);
    $stmt->bindParam(2, $data->image);
    $stmt->bindParam(3, $data->price);
    $stmt->bindParam(4, $data->description);
    
    if($stmt->execute()){
        echo json_encode(array("status"=>"ok"));
    }else{
        echo json_encode(array("status"=>"error"));
    }
    
    $db = null;
} catch (PDOException $e) {
    print "Error!: ". $e->getMessage();
    die();
}
?>