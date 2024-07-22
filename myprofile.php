<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'constanti.php';
$conn = new mysqli(ServName, UserName, Pasw, DatabaseN);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$user = $_SESSION['userid'];
$sql1 = "SELECT username FROM userdata WHERE id = $user";
$sql2 = "SELECT email FROM userdata WHERE id = $user";
$sql3 = "SELECT rolq FROM userdata WHERE id = $user";
$result1 = $conn->query($sql1);
if ($result1->num_rows > 0) {
    while($row = $result1->fetch_assoc()) {
        $line1 = $row["username"];
    }
} else {
    echo "0 results";
}
$result2 = $conn->query($sql2);
if ($result2->num_rows > 0) {
    while($row = $result2->fetch_assoc()) {
        $line2 = $row["email"];
    }
} else {
    echo "0 results";
}
$rol = 1;
$line3 = "User";
$result3 = $conn->query($sql3);
if ($result3->num_rows > 0) {
    while($row = $result3->fetch_assoc()) {
        $rol = $row["rolq"];
    }
} else {
    echo "0 results";
}
if($rol=="0"){
    $line3 = "Admin";
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <title>Project manager</title>
        <link rel="stylesheet" href="css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" />
    </head>
    <body>
        <h1>profile info</h1>
        <hr>
        <div class="class5">
            <a href="newproject.html" class="butoni">Start a new project</a>
            <a href="oldprojects.php" class="butoni">Open projects</a>
            <a href="myprofile.php" class="butoni">View profile</a>
        </div>
        <hr>
        
        <div class="class4">
            <div class="items">
                <img class="ikonki" src="imgs/3.png" alt="usericon"/>
                <p class="inf" ><?php echo $line2; ?></p>
            </div>
            <div class="items">
                <img class="ikonki" src="imgs/4.png" alt="emailicon"/>
                <p class="inf" ><?php echo $line1; ?></p>
            </div>
            <div class="items">
                <img class="ikonki" src="imgs/5.png" alt="roleicon"/>
                <p class="inf" ><?php echo $line3; ?></p>
            </div>
        </div>
        <hr>
	    <a href="index.html" class="linkowe2">log out of my profile</a>
    </body>
</html>