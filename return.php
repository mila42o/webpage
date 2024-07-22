<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Content-Type");
    header('Content-Type: application/json');
    session_start();
    $postData = file_get_contents("php://input");
    $request = json_decode($postData, true);
    $name = $request['username'];
    $pas = $request['password'];
    $response = false;
    require_once 'db.php';
    $sql = "SELECT * from userdata";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        if(($row['username'] === $name || $row['email'] === $name) && $row['pasword'] === $pas){
            $response = true;
            $_SESSION["userid"]=$row['id'];
        }
    }
    header('Content-Type: application/json');
    echo json_encode($response);
    
?>