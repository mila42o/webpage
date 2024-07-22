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
    $email = $request['email'];
    $role = $request['role'];
    $country = $request['country'];
    $response = true;
    require_once 'db.php';
    $sql = "SELECT * from userdata";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        if($row['username'] === $name || $row['email'] === $email){
            $response = false;
        }
    }
    if($response){
        $sql2 = "INSERT INTO userdata (username, email, pasword, rolq, country) VALUES ('$name','$email','$pas',$role,'$country')";
        $conn->query($sql2);
        $last_id = $conn->insert_id;
        $_SESSION["userid"]=$last_id;
    }
    header('Content-Type: application/json');
    echo json_encode($response);
    
?>