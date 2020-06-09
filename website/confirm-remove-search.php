<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("style-links.php"); ?>
        <title>Clear Search History</title>
    </head>
    <body>
        <?php
            if(!isset($_SESSION["userID"]) || !isset($_POST["remove-search"])){
                echo "<script> location.replace(\"unauthorized.php\"); </script>";
            }
            $user = "root";
            $password = "";
            $db = "sitename_db";
            $connect = new mysqli("localhost",$user,$password,$db) or die("Unable to connect");
            $stmt = $connect->prepare('DELETE FROM search WHERE uid = ?');
            $stmt->bind_param('i', $userID); 
            
            $userID = $_SESSION["userID"];
            $stmt->execute();
        ?>
        <div id="login" class="post-block">
            <p class="center" id="login-title">Clear Search History</p>
            <p class="center" id="alert">All search history cleared.</p>
            <p class="center"><a href="profile.php" class="button">Go Back</a></p>
        </div>
    </body>
</html>