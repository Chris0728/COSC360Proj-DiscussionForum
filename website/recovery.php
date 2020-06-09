<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("style-links.php"); ?>
        <title>Password Recovery</title>
    </head>
    <body>
        <?php include("header.php"); ?>
        <?php
            if(isset($_SESSION["userID"])){
                echo "<script> location.replace(\"unauthorized.php\"); </script>";
            }
        ?>
        <div id="login" class="post-block">
            <p class="center" id="login-title">Password Recovery</p>
            <form name="recovery-form" method="post" action="mailto.php">
                <p class="center"><label>Please enter your e-mail: </label><input name="recovery-mail" type="email"></p>
                <p class="center"><input type="submit" class="button" value="Send Recovery Mail"></p>
            </form>
            <p class="center"><a href="login.php" class="button">Go Back</a></p>
            <p class="center" id="alert"></p>
        </div>
    </body>
</html>