<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("style-links.php"); ?>
        <title>Profile</title>
    </head>
    <body>
        <?php include("header.php"); ?>
        <div id="profile" class="post-block">
            <?php
                if(!isset($_SESSION["userID"])){
                    echo "<script> location.replace(\"unauthorized.php\"); </script>";
                }
                $user = "root";
                $password = "";
                $db = "sitename_db";
                $connect = new mysqli("localhost",$user,$password,$db) or die("Unable to connect");
                $stmt = $connect->prepare('SELECT time FROM post WHERE uid = ? ORDER BY time DESC LIMIT 1');
                $stmt->bind_param('i', $userID); 
            
                $userID = $_SESSION["userID"];
                $stmt->execute();
                $result = $stmt->get_result();
                if($row = $result->fetch_assoc()){
                    $lastPost = $row["time"];
                }
            
                $stmt = $connect->prepare('SELECT time FROM comment WHERE uid = ? ORDER BY time DESC LIMIT 1');
                $stmt->bind_param('i', $userID); 
            
                $userID = $_SESSION["userID"];
                $stmt->execute();
                $result = $stmt->get_result();
                if($row = $result->fetch_assoc()){
                    $lastComment = $row["time"];
                }
                
                $stmt = $connect->prepare('SELECT * FROM user WHERE uid = ?');
                $stmt->bind_param('i', $userID); 
            
                $userID = $_SESSION["userID"];
                $stmt->execute();
                $result = $stmt->get_result();
                if ($row = $result->fetch_assoc()) {
                    if(strlen($row["icon"]) == 0) {
                        echo "<img src=\"resource\\placeholder.jpg\" alt=\"profile\" class=\"icon-placeholder\">";
                    }
                    else{
                        echo "<img src=\"data:image/jpeg;base64," .$row["icon"] . "\" alt=\"profile\" class=\"icon\">";
                    }
                    echo "<p class=\"center\" id=\"login-title\">" . $row["uname"] . "</p>";
                    if(isset($lastPost)){
                        echo "<p class=\"center italics\">Last posted at: " . $lastPost . "</p>";
                    }
                    else{
                        echo "<p class=\"center italics\">Currently no posts created.</p>";
                    }
                    if(isset($lastComment)){
                        echo "<p class=\"center italics\">Last commented at: " . $lastComment . "</p>";
                    }
                    else{
                        echo "<p class=\"center italics\">Currently no comments created.</p>";
                    }
                    if(strlen($row["description"]) == 0){
                        echo "<p class=\"center italics\">No description.</p>";
                    }
                    else{
                        echo "<p class=\"center\">" . $row["description"] . "</p>";
                    }
                    echo "<p class=\"center\">Name: " . $row["firstname"] . " " . $row["lastname"] . "</p>
                            <p class=\"center\">Age: " . $row["age"] . "</p>
                            <p class=\"center\">E-mail: " . $row["email"] . "</p>";
                }
                else{
                    $_SESSION["userUnknown"] = 1;
                    header("Location: unknown-user.php");
                    exit();
                }
            ?>
            <p class="center"><a href="profile-edit.php" class="button">Edit Profile</a></p>
            <p class="center"><a href="remove-search.php" class="button">Clear Search History</a></p>
            <p class="center"><a href="password-edit.php" class="button">Change Password</a></p>
        </div>
    </body>
</html>