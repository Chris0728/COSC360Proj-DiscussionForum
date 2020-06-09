<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("style-links.php"); ?>
        <title>Create Comment</title>
        <script>
            function validateCreateComment(){
                var content = document.forms["comment-form"].elements["content"].value;
                if(content == ""){
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
                echo "<script> location.replace(\"login.php\"); </script>";
            }
        ?>
        <div id="profile" class="post-block">
            <form action="validate-comment.php" method="post" name="comment-form" id="create-comment" onsubmit="return validateCreateComment()">
                <p class="center" id="login-title">Create Comment</p>
                <?php if(isset($_GET["parentid"])){echo "<input type='hidden' name='parentid' value='" . $_GET["parentid"] . "'>";}?>
                <input type="hidden" name='pid' value='<?php echo $_GET["pid"];?>'>
                <input type="hidden" name='comment' value=''>
                <p class="center">Content (At least 5 characters): <textarea rows = "5" cols = "60" name = "content"></textarea></p>
                <p class="center"><input type="submit" class="button" value="Confirm"></p>
            </form>
            <p class="center" id="alert"></p>
        </div>
    </body>
</html>