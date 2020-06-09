<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("style-links.php"); ?>
        <title>Edit Profile</title>
    </head>
    <body>
        <?php include("header.php"); ?>
        <div id="profile" class="post-block">
            <form action="validate-profile.php" method="post" name="profile-form" enctype="multipart/form-data">
                <?php
                    if(!isset($_SESSION["userID"])){
                        echo "<script> location.replace(\"unauthorized.php\"); </script>";
                    }
                    $user = "root";
                    $password = "";
                    $db = "sitename_db";
                    $connect = new mysqli("localhost",$user,$password,$db) or die("Unable to connect");
                    $stmt = $connect->prepare('SELECT * FROM user WHERE uid = ?');
                    $stmt->bind_param('i', $userID); 
            
                    $userID = $_SESSION["userID"];
                    $stmt->execute();
                    $result = $stmt->get_result();
                    echo "<p class=\"center\">Current image:</p>";
                    if ($row = $result->fetch_assoc()) {
                        if(strlen($row["icon"]) == 0) {
                            echo "<img src=\"resource\\placeholder.jpg\" alt=\"profile\" class=\"icon-placeholder\">";
                        }
                        else{
                            echo "<img src=\"data:image/jpeg;base64," . $row["icon"] . "\" alt=\"profile\" class=\"icon\">";
                        }
                        echo "<p class=\"center\"><input type='file' name=\"icon\" accept='image/*'></p>
                                <p class=\"center\" id=\"login-title\">" . $row["uname"] . "</p>
                                <p class=\"center\"><textarea rows = \"5\" cols = \"60\" name = \"description\">" . $row["description"] . "</textarea></p>
                                <p class=\"center\">Name: <input type=\"text\" name=\"firstname\" value=\"" . $row["firstname"] . "\"><input type=\"text\" name=\"lastname\" value=\"" . $row["lastname"] . "\"></p>
                                <p class=\"center\">Age: <input type=\"number\" name=\"age\" value=\"" . $row["age"] . "\"></p>
                                <p class=\"center\">E-mail: <input type=\"email\" name=\"email\" value=\"" . $row["email"] . "\"></p>
                                <p class=\"center\"><input type=\"submit\" class=\"button\" value=\"Confirm\"></p>";
                    }
                    else{
                        $_SESSION["userUnknown"] = 1;
                        header("Location: unknown-user.php");
                        exit();
                    }
                ?>
            </form>
        </div>
    </body>
</html>