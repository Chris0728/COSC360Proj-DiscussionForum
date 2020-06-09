<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("style-links.php"); ?>
        <title>Change Password</title>
    </head>
    <body>
        <p>Changing password...</p>
        <?php
            if(!isset($_SESSION["userID"]) || !isset($_POST["old-password"])){
                echo "<script> location.replace(\"unauthorized.php\"); </script>";
            }
            $user = "root";
            $password = "";
            $db = "sitename_db";
            $connect = new mysqli("localhost",$user,$password,$db) or die("Unable to connect");
            $stmt = $connect->prepare('SELECT * FROM user WHERE uid = ? AND password = ?');
            $stmt->bind_param('is', $userID, $oldPassword); 
            
            $userID = $_SESSION["userID"];
            $oldPassword = $_POST["old-password"];
            $stmt->execute();
            $result = $stmt->get_result();
            if ($row = $result->fetch_assoc()) {
                $stmt = $connect->prepare('UPDATE user SET password = ? WHERE uid = ?');
                $stmt->bind_param('si', $newPassword, $userID); 
                $newPassword = $_POST["new-password"];
                $stmt->execute();
                $_SESSION["passwordSuccess"] = 1;
                header("Location: confirm-password.php");
                exit();
            }
            else{
                $_SESSION["passwordFail"] = 1;
                header("Location: password-edit.php");
                exit();
            }
        ?>
    </body>
</html>