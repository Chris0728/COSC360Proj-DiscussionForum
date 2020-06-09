<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("style-links.php"); ?>
        <title>Sign up</title>
    </head>
    <body>
        <p>Signing up...</p>
        <?php
            if(!isset($_POST["username"])){
                echo "<script> location.replace(\"unauthorized.php\"); </script>";
            }
            $user = "root";
            $password = "";
            $db = "sitename_db";
            $connect = new mysqli("localhost",$user,$password,$db) or die("Unable to connect");
            $stmt = $connect->prepare('SELECT * FROM user WHERE uname = ?');
            $stmt->bind_param('s', $username); 
            
            $username = $_POST["username"];
            $stmt->execute();
            $result = $stmt->get_result();
            if ($row = $result->fetch_assoc()) {
                $_SESSION["signupFail"] = 1;
                $_SESSION["usernameSignup"] = $_POST["username"];
                $_SESSION["firstnameSignup"] = $_POST["firstname"];
                $_SESSION["lastnameSignup"] = $_POST["lastname"];
                $_SESSION["ageSignup"] = $_POST["age"];
                $_SESSION["emailSignup"] = $_POST["email"];
                header("Location: signup.php");
                exit();
            }
            else{
                $stmt = $connect->prepare('INSERT INTO user(uname, password, firstname, lastname, age, email) VALUES (?, ?, ?, ?, ?, ?)');
                $stmt->bind_param('ssssis', $username, $password, $firstname, $lastname, $age, $email);
                
                $username = $_POST["username"];
                $password = $_POST["password"];
                $firstname = $_POST["firstname"];
                $lastname = $_POST["lastname"];
                $age = $_POST["age"];
                $email = $_POST["email"];
                $stmt->execute();
                $_SESSION["userID"] = $connect->insert_id;
                $_SESSION["username"] = $username;
                $_SESSION["signupSuccess"] = 1;
                header("Location: confirm-signup.php");
                exit();
            }
        ?>
    </body>
</html>