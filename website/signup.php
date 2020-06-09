<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("style-links.php"); ?>
        <title>Site Name - Sign Up</title>
        <script>
            function validateSignup(){
                var username = document.forms["signup-form"].elements["username"].value;
                var password = String(document.getElementById("password").value);
                var rep = String(document.getElementById("password-check").value);
                var firstname = document.forms["signup-form"].elements["firstname"].value;
                var lastname = document.forms["signup-form"].elements["lastname"].value;
                var age = document.forms["signup-form"].elements["age"].value;
                var email = document.forms["signup-form"].elements["email"].value;
                var accept = document.forms["signup-form"].elements["accept"].checked;
                var isRepeated = (password === rep);
                var regex = /^[a-z\d\-_\s]+$/i;
                if(username == "" || password == "" || rep == "" || firstname == "" || lastname == "" || age == "" || email == "" || accept == false){
                    document.getElementById("alert").innerHTML = "You have to fill in every item.";
                    return false;
                }
                else if(username.indexOf(" ") == 0 || username.indexOf(" ") == username.length - 1){
                    document.getElementById("alert").innerHTML = "Your username must not contain any white spaces at the beginning or the end.";
                    return false;
                }
                else if(username.length > 20){
                    document.getElementById("alert").innerHTML = "Your username must be no more than 20 characters.";
                    return false;
                }
                else if(!regex.test(username)){
                    document.getElementById("alert").innerHTML = "Your username can only contain alphanumericals and \"-\", \"_\", \" \" .";
                    return false;
                }
                else if(password.length < 8 || password.length > 20){
                    document.getElementById("alert").innerHTML = "Your password must have 8 to 20 characters in length.";
                    return false;
                }
                else if(password.indexOf(" ") >= 0){
                    document.getElementById("alert").innerHTML = "Your password must not contain any white spaces.";
                    return false;
                }
                else if(!isRepeated){
                    document.getElementById("alert").innerHTML = "You must be able to repeat your password.";
                    return false;
                }
            }
        </script>
    </head>
    <body>
        <?php include("header.php"); ?>
        <?php 
            if(!isset($_SESSION["userID"])){
                echo "<div id=\"signup\" class=\"post-block\">
                        <p class=\"center\" id=\"login-title\">Sign Up</p>
                        <form name=\"signup-form\" action=\"validate-signup.php\" method=\"post\" onsubmit=\"return validateSignup()\">
                            <p class=\"center\"><label>Username: </label><input type=\"text\" name=\"username\" value=\"";
                                if(isset($_SESSION["signupFail"])){
                                    echo $_SESSION["usernameSignup"];
                                }
                            echo "\"><label>No more than 20 alphanumericals, whitespaces, dash and underlines; no whitespaces allowed at the beginning or the end of your name.</label></p>
                            <p class=\"center\"><label>Password: </label><input type=\"password\" name=\"password\" id=\"password\"><label>Between 8 to 20 characters, and no whitespaces allowed.</label></p>
                            <p class=\"center\"><label>Repeat your password: </label><input type=\"password\" name=\"password-check\" id=\"password-check\"></p>
                            <p class=\"center\"><label>Name: </label><input type=\"text\" name=\"firstname\" placeholder=\"First Name\" value=\"";
                                if(isset($_SESSION["signupFail"])){
                                    echo $_SESSION["firstnameSignup"];
                                }
                            echo "\"><input type=\"text\" name=\"lastname\" placeholder=\"Last Name\" value=\"";
                                if(isset($_SESSION["signupFail"])){
                                    echo $_SESSION["lastnameSignup"];
                                }
                            echo "\"></p>
                            <p class=\"center\"><label>Age: </label><input type=\"number\" name=\"age\" value=\"";
                                if(isset($_SESSION["signupFail"])){
                                    echo $_SESSION["ageSignup"];
                                }
                            echo "\"></p>
                            <p class=\"center\"><label>E-mail: </label><input type=\"email\" name=\"email\" value=\"";
                                if(isset($_SESSION["signupFail"])){
                                    echo $_SESSION["emailSignup"];
                                }
                            echo "\"></p>
                            <p class=\"center\"><label>I have read and accepted the <a href=\"userterms.html\" target=\"_blank\">terms of use</a>: </label><input type=\"checkbox\" name=\"accept\"></p>
                            <p class=\"center\"><input type=\"submit\" class=\"button\" value=\"Sign Up\"></p>
                        </form>
                        <p class=\"center\" id=\"alert\">";
                if(isset($_SESSION["signupFail"])){
                    echo "This username is already taken, please try a new one.";
                    unset($_SESSION["signupFail"]);
                    unset($_SESSION["usernameSignup"]);
                    unset($_SESSION["firstnameSignup"]);
                    unset($_SESSION["lastnameSignup"]);
                    unset($_SESSION["ageSignup"]);
                    unset($_SESSION["emailSignup"]);
                }
                echo "  </p>
                    </div>";
            }
            else{
                echo "<div id=\"login\" class=\"post-block\">
                        <p class=\"center\" id=\"login-title\">Sign Up</p>
                        <p class=\"center\" id=\"alert\">You are already logged in. <br>To sign up as another user, you must log out first:</p>
                        <p class=\"center\"><a href=\"logout.php\" class=\"button\">Log Out</a></p>
                    </div>";
            }
        ?>
    </body>
</html>