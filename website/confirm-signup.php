<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("style-links.php"); ?>
        <title>Sign Up</title>
    </head>
    <body>
        <?php
            if(!isset($_SESSION["userID"]) || !isset($_SESSION["signupSuccess"])){
                echo "<script> location.replace(\"unauthorized.php\"); </script>";
            }
            else{
                unset($_SESSION["signupSuccess"]);
                echo "<div id=\"login\" class=\"post-block\">
                        <p class=\"center\" id=\"login-title\">Sign Up</p>
                        <p class=\"center\" id=\"alert\">You have successfully signed up. Welcome, " . $_SESSION["username"] . "!</p>
                        <p class=\"center\"><a href=\"top.php\" class=\"button\">Return to Top</a></p>
                    </div>";
            }
        ?>
    </body>
</html>