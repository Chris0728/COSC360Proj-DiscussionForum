<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("style-links.php"); ?>
        <title>Site Name - Login</title>
        <script>
            function validateLogin(){
                var username = document.forms["login-form"].elements["username-login"].value;
                var password = document.forms["login-form"].elements["password-login"].value;
                if(username == "" || password == ""){
                    document.getElementById("alert").innerHTML = "You have to fill in every item.";
                    return false;
                }
            }
        </script>
    </head>
    <body>
        <?php include("header.php"); ?>
        <?php 
            if(!isset($_SESSION["userID"])){
                echo "<div id=\"login\" class=\"post-block\">
                        <p class=\"center\" id=\"login-title\">Log In</p>
                        <form action=\"validate-login.php\" method=\"post\" name=\"login-form\" onsubmit=\"return validateLogin()\">
                            <p class=\"center\"><label>Username: </label><input type=\"text\" name=\"username-login\"></p>
                            <p class=\"center\"><label>Password: </label><input type=\"password\" name=\"password-login\"></p>
                            <p class=\"center\"><input type=\"submit\" class=\"button\" value=\"Log in\"></p>
                        </form>
                        <p class=\"center\" id=\"alert\">";
                        
                if(isset($_SESSION["loginFail"])){
                    echo "Your username or password is incorrect.";
                    unset($_SESSION["loginFail"]);
                }
                echo "  </p>
                        <p class=\"center\">Forgot your password?</p>
                        <p class=\"center\"><a href=\"recovery.php\" class=\"button\">Recover Password</a></p>
                    </div>";
            }
            else{
                echo "<div id=\"login\" class=\"post-block\">
                        <p class=\"center\" id=\"login-title\">Log In</p>
                        <p class=\"center\" id=\"alert\">You are already logged in. <br>To log in as another user, you must log out first:</p>
                        <p class=\"center\"><a href=\"logout.php\" class=\"button\">Log Out</a></p>
                    </div>";
            }
        ?>
    </body>
</html>