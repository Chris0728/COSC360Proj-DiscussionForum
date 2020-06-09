<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("style-links.php"); ?>
        <title>Change Password</title>
        <script>
            function validatePassword(){
                var oldPassword = document.forms["password-form"].elements["old-password"].value;
                var newPassword = document.forms["password-form"].elements["new-password"].value;
                var newPasswordRepeat = document.forms["password-form"].elements["new-password-check"].value;
                var isRepeated = (newPassword === newPasswordRepeat);
                if(oldPassword == "" || newPassword == "" || newPasswordRepeat == ""){
                    document.getElementById("alert").innerHTML = "You have to fill in every item.";
                    return false;
                }
                else if(newPassword.length < 8 || newPassword.length > 20){
                    document.getElementById("alert").innerHTML = "Your password must have 8 to 20 characters in length.";
                    return false;
                }
                else if(newPassword.indexOf(" ") >= 0){
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
        <?php include("header.php"); 
            if(!isset($_SESSION["userID"])){
                echo "<script> location.replace(\"unauthorized.php\"); </script>";
            }
        ?>
        <div id="login" class="post-block">
            <form action="validate-password.php" method="post" name="password-form" onsubmit="return validatePassword()">
                <p class="center" id="login-title">Change Password</p>
                <p class="center"><label>Old password: </label><input type="password" name="old-password"></p>
                <p class="center"><label>New password: </label><input type="password" name="new-password"><label>Between 8 to 20 characters, and no whitespaces allowed.</label></p>
                <p class="center"><label>Repeat your new password: </label><input type="password" name="new-password-check"></p>
                <p class="center"><input type="submit" class="button" value="Confirm"></p>
                <p class="center" id="alert">
                <?php
                    if(isset($_SESSION["passwordFail"])){
                        echo "Your old password is incorrect, please try again.";
                        unset($_SESSION["passwordFail"]);
                    }
                ?>
                </p>
            </form>
        </div>
    </body>
</html>