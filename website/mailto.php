
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("style-links.php"); ?>
        <title>Password Recovery</title>
    </head>
    <body>
        <?php
            if(!isset($_POST["recovery-mail"])){
                header("Location: unauthorized.php");
                exit();
            }
            $subject = "Site Name: Password Recovery";
            $mail_from="sitename.recovery@gmail.com";

            $user = "root";
            $password = "";
            $db = "sitename_db";
            $connect = new mysqli("localhost",$user,$password,$db) or die("Unable to connect");

            $stmt = $connect->prepare("SELECT password FROM user WHERE email = ?");
            $stmt->bind_param("s", $email);
            $email = $_POST["recovery-mail"];
            $stmt->execute();
            $result = $stmt->get_result();

            echo "<div id='login' class='post-block'><p class=\"center\" id=\"login-title\">Password Recovery</p>";
            if($row = $result->fetch_assoc()){
                $message = "Your password is: " .$row["password"]. "\nIt is recommended to change your password after a successful recovery.\n\nSite Name";
                $send_contact = mail($email,$subject,$message);
        
        
                // Check, if message sent to your email
                if($send_contact){
                    echo "<p class=\"center\">The recovery e-mail has been successfully sent. Please check your e-mail now.</p>
                        <p class=\"center\"><a href=\"login.php\" class=\"button\">Log In Now</a></p>
                        <p class=\"center\">Haven't received any e-mail yet?</p>";
                }
                else {
                    echo "<p class=\"center\">The e-mail has failed to send.</p>
                        <p class=\"center\">Please try again.</p>";
                }
                echo "<form name=\"resend-recovery-form\" action=\"mailto.php\" method=\"post\">
                            <input type=\"hidden\" name=\"recovery-mail\" value=\"" . $email . "\">
                            <p class=\"center\"><input type=\"submit\" class=\"button\" value=\"Resend Mail\"></p>
                        </form>";
                if(!$send_contact){
                    echo "<p class=\"center\"><a href=\"login.php\" class=\"button\">Go Back</a></p>";
                }
            }
            else{
                echo "<p class=\"center\">We cannot find a user with your e-mail.</p>
                    <p class=\"center\">Please make sure that the e-mail you filled in is correct.</p>
                    <p class=\"center\">Try Again?</p>
                    <p class=\"center\"><a href='recovery.php' class='button'>Retry</a></p>";
            }
            echo "</div>";
        ?>
    </body>
</html>
