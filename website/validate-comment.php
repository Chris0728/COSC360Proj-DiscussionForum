<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("style-links.php"); ?>
        <title>Create Comment</title>
    </head>
    <body>
        <p>Uploading...</p>
        <?php
            if(!isset($_SESSION["userID"]) || !isset($_POST["comment"])){
                echo "<script> location.replace(\"unauthorized.php\"); </script>";
            }
            $user = "root";
            $password = "";
            $db = "sitename_db";
            $connect = new mysqli("localhost",$user,$password,$db) or die("Unable to connect");
            if(isset($_POST["parentid"])){
                $parentid = $_POST["parentid"];
                $statement = 'INSERT INTO comment(content, pid, parentid, uid) VALUES (?, ?, ?, ?)';
                $stmt = $connect->prepare($statement);
                $stmt->bind_param('siii', $content, $pid, $parentid, $userID);
            }
            else{
                $statement = 'INSERT INTO comment(content, pid, uid) VALUES (?, ?, ?)';
                $stmt = $connect->prepare($statement);
                $stmt->bind_param('sii', $content, $pid, $userID); 
            }
            $content = $_POST["content"];
            $pid = $_POST["pid"];
            $userID = $_SESSION["userID"];
            $stmt->execute();
            header("Location: post.php?pid=" . $pid);
            exit();
        ?>
    </body>
</html>