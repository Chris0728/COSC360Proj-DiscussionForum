<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("style-links.php"); ?>
        <title>Log In</title>
    </head>
    <body>
        <p>Waiting for log in verification...</p>
        <?php
            if(!isset($_POST["username-login"])){
                echo "<script> location.replace(\"unauthorized.php\"); </script>";
            }
            $user = "root";
            $password = "";
            $db = "sitename_db";
            $connect = new mysqli("localhost",$user,$password,$db) or die("Unable to connect");
            $stmt = $connect->prepare('SELECT * FROM user WHERE uname = ? AND password = ?');
            $stmt->bind_param('ss', $username, $password); 
            
            $username = $_POST["username-login"];
            $password = $_POST["password-login"];
            $stmt->execute();
            $result = $stmt->get_result();
            if ($row = $result->fetch_assoc()) {
                $_SESSION["userID"] = $row["uid"];
                $_SESSION["username"] = $username;
                header("Location: top.php");
                exit();
            }
            else{
                $_SESSION["loginFail"] = 1;
                header("Location: login.php");
                exit();
            }
        ?>
    </body>
</html>