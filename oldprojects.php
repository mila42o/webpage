<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'constanti.php';
require_once 'zaqwki.php';
$db = new DB(ServName, UserName, Pasw, DatabaseN);
$db->wruzka(ServName, UserName, Pasw, DatabaseN);
$user = $_SESSION['userid'];
$no=1;
$rol = $db->rolq($user);
if (isset($_GET['ime'])) {
    $sort1 = $_GET['ime'];
} else {
    $sort1=0;
}
if (isset($_GET['awt'])) {
    $sort2 = $_GET['awt'];
} else {
    $sort2=0;
}
$sql = $db->podredba($user, $rol, $sort1, $sort2);
$rows = [];
$rows = $db->fetchAll($sql);
$db->close();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <title>Project manager</title>
        <link rel="stylesheet" href="css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" />
        <style>
            .hiksche{
                height: 20px;
                width: 20px;
                margin-left: 18px;
                margin-top: 3px;
            }
            table, th, td {
                border: 2px solid black;
                margin-left: auto;
                margin-right: auto;
            }
            .class4{
                align-items: center;
            }
            .sort-buttons {
            display: inline-flex;
            flex-direction: column;
            margin-left: 4px;
            }
            .sort-button {
                background: none;
                border-bottom: 1px solid black;
                cursor: pointer;
            }
            .but{
                align-items: center;
                display: flex;
                float: left;
            }
            h4{
                margin-top: 2px;
                margin-bottom: 2px;
            }
        </style>
    </head>
    <body>
        <h1>old projects</h1>
        <hr>
        <div class="class5">
            <a href="nowproekt.html" class="butoni">Start a new project</a>
            <a href="starproekt.php" class="butoni">Open project</a>
            <a href="moyaprofil.php" class="butoni">View profile</a>
        </div>
        <hr>
        <div class="class4">
            <br>
            <?php
            if($rol=="1"){ 
                if ($rows > 0) {?>
                    <table>
                        <thead>
                            <tr>
                            <th>ProjectNo</th>
                            <th class="but">
                            <h4>ProjectName</h4>
                            <div class="sort-buttons">
                            <form action="starproekt.php"><input type="hidden" name="ime" value="1"><input class="sort-button" type="submit" value="▲"></form>
                            <form action="starproekt.php"><input type="hidden" name="ime" value="2"><input class="sort-button" type="submit" value="▼"></form>
                            </div>
                            </th>
                            <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php 
                    foreach($rows as $row) { ?>
                        <tr>
                        <td><?php echo $no ?></td> 
                        <td><?php echo $row["projectDBname"] ?> </td>
                        <td>
                            <form action="triene.php" method="post">
                                <input type="hidden" name="projectid" value="<?php echo $row["projectid"] ?> ">
                                <input type="image" src="imgs/x.png" class="hiksche">
                            </form>
                        </td>
                        </tr>
                    <?php $no++;
                    } ?>
                    </tbody>
                </table>
                <?php
                } else {
                    echo "0 results";
                }
            }else{ ?>
                <table>
                    <thead>
                        <tr>
                        <th>ProjectNo</th>
                        <th class="but" colspan="1">
                        <h4>ProjectName</h4>
                        <div class="sort-buttons">
                        <form action="starproekt.php"><input type="hidden" name="ime" value="1"><input class="sort-button" type="submit" value="▲"></form>
                        <form action="starproekt.php"><input type="hidden" name="ime" value="2"><input class="sort-button" type="submit" value="▼"></form>
                        </div>
                        </th>
                        <th class="but" colspan="1">
                        <h4>Author</h4>
                        <div class="sort-buttons">
                        <form action="starproekt.php"><input type="hidden" name="awt" value="1"><input class="sort-button" type="submit" value="▲"></form>
                        <form action="starproekt.php"><input type="hidden" name="awt" value="2"><input class="sort-button" type="submit" value="▼"></form>
                        </div>
                        </th>
                        <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php
                if ($rows > 0) {
                    foreach($rows as $row) { ?>
                        <tr>
                        <td> <?php echo $no ?> </td> 
                        <td> <?php echo $row["projectDBname"] ?> </td> 
                        <td> <?php echo $row["username"] ?> </td>
                        <td>
                            <form action="triene.php" method="post">
                            <input type="hidden" name="projectid" value="<?php echo $row["projectid"] ?>" >
                            <input type="image" src="imgs/x.png" class="hiksche">
                            </form>
                        </td>
                        </tr>
                        <?php $no++;
                    }
                } else {
                    echo "0 results";
                }
            }
            ?>
                </tbody>
            </table>
            <br>
        </div>
        <hr>
	    <a href="index.html" class="linkowe2">log out of my profile</a>
    </body>
</html>