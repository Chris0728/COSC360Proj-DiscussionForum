<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("style-links.php"); ?>
        <title>Clear Search History</title>
    </head>
    <body>
        <?php include("header.php"); ?>
        <?php
            if(!isset($_SESSION["userID"])){
                echo "<script> location.replace(\"unauthorized.php\"); </script>";
            }
        ?>
        <div id="login" class="post-block">
            <p class="center" id="login-title">Clear Search History</p>
            <p class="center" id="alert">This action will clear all of your search history. Are you sure?</p>
            <form action="confirm-remove-search.php" method="post" name="remove-search-form">
                <input type="hidden" name="remove-search" value="1">
                <p class="center"><input type="submit" value="Clear Search History" class="button"></p>
            </form>
            <p class="center"><a href="profile.php" class="button">Go Back</a></p>
        </div>
    </body>
</html>