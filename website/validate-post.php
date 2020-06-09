<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("style-links.php"); ?>
        <title>Create Post</title>
    </head>
    <body>
        <p>Uploading...</p>
        <?php
            if(!isset($_SESSION["userID"]) || !isset($_POST["title"])){
                echo "<script> location.replace(\"unauthorized.php\"); </script>";
            }
            $user = "root";
            $password = "";
            $db = "sitename_db";
            $connect = new mysqli("localhost",$user,$password,$db) or die("Unable to connect");
            $statement = 'INSERT INTO post(title, content, caid, uid) VALUES (?, ?, ?, ?)';
            $stmt = $connect->prepare($statement);
            $stmt->bind_param('ssii', $title, $content, $caid, $userID); 
            $title = $_POST["title"];
            $content = $_POST["content"];
            $caid = $_POST["category"];
            $userID = $_SESSION["userID"];
            $stmt->execute();
            $lastID = $connect->insert_id;
            if(strlen($_FILES['img']['tmp_name']) != 0){
                $img = $_FILES['img']['tmp_name'];
                $img_encoded = base64_encode(file_get_contents(addslashes($img)));
                $stmt = $connect->query("UPDATE post SET img = '$img_encoded' WHERE pid = " . $lastID);
            }
            header("Location: post.php?pid=" . $lastID);
            exit();
        ?>
    </body>
</html>