<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("style-links.php"); ?>
        <title>Create Post</title>
        <script>
            function validateCreatePost(){
                var title = document.forms["post-form"].elements["title"].value;
                var content = document.forms["post-form"].elements["content"].value;
                var category = document.forms["post-form"].elements["category"].value;
                if(title == "" || content == "" || category == ""){
                    document.getElementById("alert").innerHTML = "You have to fill in every required item.";
                    return false;
                }
                else if(content.length < 5){
                    document.getElementById("alert").innerHTML = "Your content must have at least 5 characters.";
                    return false;
                }
            }
        </script>
    </head>
    <body>
        <?php include("header.php"); ?>
        <?php 
            if(!isset($_SESSION["userID"])){
                echo "<script> location.replace(\"unauthorized.php\"); </script>";
            }
        ?>
        <div id="profile" class="post-block">
            <form action="validate-post.php" method="post" name="post-form" enctype="multipart/form-data" id="create-post" onsubmit="return validateCreatePost()">
                <p class="center" id="login-title">Create Post</p>
                <p class="center">Title: <input type="text" name="title"></p>
                <p class="center">Image (Optional): <input type='file' name="img" accept='image/*'></p>
                <p class="center">Content (At least 5 characters): <textarea rows = "5" cols = "60" name = "content"></textarea></p>
                <p class="center">Category: <select name="category" form="create-post">
                    <?php
                        $user = "root";
                        $password = "";
                        $db = "sitename_db";
                        $connect = new mysqli("localhost",$user,$password,$db) or die("Unable to connect");
                        $stmt = $connect->prepare('SELECT * FROM category');
                        $stmt->execute();
                        $result = $stmt->get_result();
                        while($row = $result->fetch_assoc()){
                            echo "<option value='" . $row["caid"] . "'>" . $row["name"] . "</option>";
                        }
                    ?>
                    </select>
                </p>
                <p class="center"><input type="submit" class="button" value="Confirm"></p>
            </form>
            <p class="center" id="alert"></p>
        </div>
    </body>
</html>