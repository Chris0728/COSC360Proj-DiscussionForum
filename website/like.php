<?php
    session_start();
    if((!isset($_GET["pid"]) && !isset($_GET["cid"])) || !isset($_SESSION["userID"])){
        echo "<script> location.replace(\"unauthorized.php\"); </script>";
    }
    $user = "root";
    $password = "";
    $db = "sitename_db";
    $connect = new mysqli("localhost",$user,$password,$db) or die("Unable to connect");
    if(isset($_GET["pid"])){
        $statement = 'INSERT INTO postvote(pid, uid) VALUES (?, ?)';
        $stmt = $connect->prepare($statement);
        $stmt->bind_param('ii', $postID, $userID); 
        $postID = $_GET["pid"];
    }
    else{
        $statement = 'INSERT INTO commentvote(cid, uid) VALUES (?, ?)';
        $stmt = $connect->prepare($statement);
        $stmt->bind_param('ii', $commentID, $userID); 
        $commentID = $_GET["cid"];
    }
    $userID = $_SESSION["userID"];
    $stmt->execute();
?>