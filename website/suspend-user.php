<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("style-links.php"); ?>
        <title>User Suspended</title>
    </head>
    <body>
        <?php
            if(!isset($_SESSION["userSuspend"])){
                echo "<script> location.replace(\"unauthorized.php\"); </script>";
            }
            unset($_SESSION["userSuspend"]);
        ?>
        <div id="login" class="post-block">
            <p class="center" id="login-title">User Suspended</p>
            <p class="center" id="alert">This account has been temporarily suspended.<br>For more information, please e-mail a staff using the given address:<br>sitename.help@gmail.com</p>
            <p class="center"><a href="top.php" class="button">Return to top</a></p>
        </div>
    </body>
</html>