<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("style-links.php"); ?>
        <title>Change Password</title>
    </head>
    <body>
        <?php
            if(!isset($_SESSION["userID"]) || !isset($_SESSION["passwordSuccess"])){
                echo "<script> location.replace(\"unauthorized.php\"); </script>";
            }
            else{
                unset($_SESSION["passwordSuccess"]);
                echo "<div id=\"login\" class=\"post-block\">
                        <p class=\"center\" id=\"login-title\">Change Password</p>
                        <p class=\"center\" id=\"alert\">You have successfully changed your password.</p>
                        <p class=\"center\"><a href=\"top.php\" class=\"button\">Return to Top</a></p>
                    </div>";
            }
        ?>
    </body>
</html>