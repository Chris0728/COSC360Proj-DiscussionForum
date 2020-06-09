<?php
    if(!isset($_GET["search"]) || !isset($_GET["search-type"]) || !isset($_SESSION["recordSearch"])){
        echo "<script> location.replace(\"unauthorized.php\"); </script>";
    }
    if(isset($_SESSION["userID"])){
        $user = "root";
        $password = "";
        $db = "sitename_db";
        $connect = new mysqli("localhost",$user,$password,$db) or die("Unable to connect");
        $stmt = $connect->prepare("INSERT INTO search VALUES (?, ?, ?)");
        $stmt->bind_param('iss', $userID, $search, $type); 
        
        $userID = $_SESSION["userID"];
        $search = $_GET["search"];
        $type = $_GET["search-type"];
        $stmt->execute();
    }
    unset($_SESSION["recordSearch"]);
?>