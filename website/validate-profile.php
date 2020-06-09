<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("style-links.php"); ?>
        <title>Edit Profile</title>
    </head>
    <body>
        <p>Updating profile...</p>
        <?php
            if(!isset($_SESSION["userID"]) || !isset($_POST["description"])){
                echo "<script> location.replace(\"unauthorized.php\"); </script>";
            }
            $statement = 'UPDATE user SET description = ?, firstname = ?, lastname = ?, age = ?, email = ? WHERE uid = ?';
            $stmt = $connect->prepare($statement);
            $stmt->bind_param('sssisi', $description, $firstname, $lastname, $age, $email, $userID); 
            $description = $_POST["description"];
            $firstname = $_POST["firstname"];
            $lastname = $_POST["lastname"];
            $age = $_POST["age"];
            $email = $_POST["email"];
            $userID = $_SESSION["userID"];
            $stmt->execute();
        
            if(strlen($_FILES['icon']['tmp_name']) != 0){
                $icon = $_FILES['icon']['tmp_name'];
                $icon_encoded = base64_encode(file_get_contents(addslashes($icon)));
                $stmt = $connect->query("UPDATE user SET icon = '$icon_encoded' WHERE uid = " . $userID);
            }
        
            header("Location: profile.php");
            exit();
        ?>
    </body>
</html>