<?php
    if(isset($_SESSION["userID"])){
        $user = "root";
        $password = "";
        $db = "sitename_db";
        $connect = new mysqli("localhost",$user,$password,$db) or die("Unable to connect");
        $stmt = $connect->prepare('SELECT state FROM user WHERE uid = ?');
        $stmt->bind_param('i', $userID); 
            
        $userID = $_SESSION["userID"];
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            if($row["state"] == -1){
                unset($_SESSION["userID"]);
                unset($_SESSION["username"]);
                $_SESSION["userSuspend"] = 1;
                header("Location: suspend-user.php");
                exit();
            }
            elseif($row["state"] == 0){
                unset($_SESSION["state"]);
            }
            elseif($row["state"] == 1){
                $_SESSION["state"] = 1;
            }
        }
        else{
            $_SESSION["userUnknown"] = 1;
            header("Location: unknown-user.php");
            exit();
        }
    }
?>