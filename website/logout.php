<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("style-links.php"); ?>
        <title>Requesting log out</title>
    </head>
    <body>
        <p>Logging out...</p>
        <?php
            unset($_SESSION["userID"]);
            unset($_SESSION["username"]);
            header("Location: top.php");
        ?>
    </body>
</html>