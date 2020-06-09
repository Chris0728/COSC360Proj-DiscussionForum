<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("style-links.php"); ?>
        <title>Unknown User</title>
    </head>
    <body>
        <?php
            if(!isset($_SESSION["userUnknown"])){
                echo "<script> location.replace(\"unauthorized.php\"); </script>";
            }
            unset($_SESSION["userUnknown"]);
            unset($_SESSION["userID"]);
            unset($_SESSION["username"]);
        ?>
        <div id="login" class="post-block">
            <p class="center" id="login-title">Unknown User</p>
            <p class="center" id="alert">This user does not exist.</p>
            <p class="center"><a href="top.php" class="button">Return to top</a></p>
        </div>
    </body>
</html>