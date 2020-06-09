<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("style-links.php"); ?>
        <title>Site Name</title>
        <script>
            function validateAdminSearchUsername(){
                var temp = document.forms["admin-search-username-form"].elements["search-username"].value;
                if(temp == ""){
                    document.getElementsByClassName("alert-search")[0].innerHTML = "You have to fill in the username box.";
                    return false;
                }
            }
            function validateAdminSearchEmail(){
                var temp = document.forms["admin-search-email-form"].elements["search-email"].value;
                if(temp == ""){
                    document.getElementsByClassName("alert-search")[0].innerHTML = "You have to fill in the email box.";
                    return false;
                }
            }
            function validateAdminSearchTitle(){
                var temp = document.forms["admin-search-title-form"].elements["search-title"].value;
                if(temp == ""){
                    document.getElementsByClassName("alert-search")[0].innerHTML = "You have to fill in the post title box.";
                    return false;
                }
            }
            function validateAdminSuspend(){
                var temp = document.forms["admin-suspend-form"].elements["suspend-id"].value;
                if(temp == ""){
                    document.getElementsByClassName("alert-search")[1].innerHTML = "You have to fill in the user ID box.";
                    return false;
                }
            }
            function validateAdminRemoveComment(){
                var temp = document.forms["admin-remove-comment-form"].elements["remove-cid"].value;
                if(temp == ""){
                    document.getElementsByClassName("alert-search")[2].innerHTML = "You have to fill in the comment ID box.";
                    return false;
                }
            }
            function validateAdminRemovePost(){
                var temp = document.forms["admin-remove-post-form"].elements["remove-pid"].value;
                if(temp == ""){
                    document.getElementsByClassName("alert-search")[2].innerHTML = "You have to fill in the post ID box.";
                    return false;
                }
            }
        </script>
    </head>
    <body>
        <?php include("header.php"); 
            if(!isset($_SESSION["userID"]) || !isset($_SESSION["state"]) || $_SESSION["state"] != 1){
                echo "<script> location.replace(\"unauthorized.php\"); </script>";
            }
        ?>
        <main>
            <div class="post-block">
                <h4 class="post-title">Admin Page</h4>
            </div>
            <div class="post-block">
                <p class="center" id="login-title">Search Users</p>
                <p>Instruction: Fill in the input field of your choice and click the respective "Search" button on the right. Only one type of search can be done each time.</p>
                <form action="" method="post" name="admin-search-username-form" onsubmit="return validateAdminSearchUsername()">
                Search User by username: <input type="text" name="search-username">
                <input type="submit" value="Search" class="button">
                </form>
            
                <form action="" method="post" name="admin-search-email-form" onsubmit="return validateAdminSearchEmail()">
                Search User by email: <input type="text" name="search-email">
                <input type="submit" value="Search" class="button">
                </form>
            
                <form action="" method="post" name="admin-search-title-form" onsubmit="return validateAdminSearchTitle()">
                Search User by post title: <input type="text" name="search-title">
                <input type="submit" value="Search" class="button">
                </form>
                <p>* An empty state means its value is 0.</p>
                <p class="alert-search"></p>
                
                <?php
                    $user = "root";
                    $password = "";
                    $db = "sitename_db";
                    $connect = new mysqli("localhost",$user,$password,$db) or die("Unable to connect");
            
                    if(isset($_POST["search-username"])){
                        $stmt = $connect->prepare('SELECT * FROM user WHERE uname LIKE ?');
                        $stmt->bind_param('s', $username); 
            
                        $username = "%" . $_POST["search-username"] . "%";
                        $stmt->execute();
                        $result = $stmt->get_result();
                        echo "<table border=\"1\"><tr><th>uid</th><th>uname</th><th>firstname</th><th>lastname</th><th>age</th><th>email</th><th>description</th><th>icon</th><th>state</th></tr>";
                        while($row = $result->fetch_row()) {
                            echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[3] . "</td><td>" . $row[4] . "</td><td>" . $row[5] . "</td><td>" . $row[6] . "</td><td>" . $row[7] . "</td><td>";
                            if(strlen($row[8]) != 0) {
                                echo "<img src=\"data:image/jpeg;base64," .$row[8] . "\" alt=\"profile\" class=\"icon-tiny\">";
                            }
                            echo "</td><td>" . $row[9] . "</td></tr>";
                        }
                        echo "</table>";
                    }
                    elseif(isset($_POST["search-email"])){
                        $stmt = $connect->prepare('SELECT * FROM user WHERE email LIKE ?');
                        $stmt->bind_param('s', $email); 
            
                        $email = "%" . $_POST["search-email"] . "%";
                        $stmt->execute();
                        $result = $stmt->get_result();
                        echo "<table border=\"1\"><tr><th>uid</th><th>uname</th><th>firstname</th><th>lastname</th><th>age</th><th>email</th><th>description</th><th>icon</th><th>state</th></tr>";
                        while($row = $result->fetch_row()) {
                            echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[3] . "</td><td>" . $row[4] . "</td><td>" . $row[5] . "</td><td>" . $row[6] . "</td><td>" . $row[7] . "</td><td>";
                            if(strlen($row[8]) != 0) {
                                echo "<img src=\"data:image/jpeg;base64," .$row[8] . "\" alt=\"profile\" class=\"icon-tiny\">";
                            }
                            echo "</td><td>" . $row[9] . "</td></tr>";
                        }
                        echo "</table>";
                    }
                    elseif(isset($_POST["search-title"])){
                        $stmt = $connect->prepare('SELECT user.*, post.title FROM user JOIN post ON user.uid = post.uid WHERE post.title LIKE ?');
                        $stmt->bind_param('s', $title); 
            
                        $title = "%" . $_POST["search-title"] . "%";
                        $stmt->execute();
                        $result = $stmt->get_result();
                        echo "<table border=\"1\"><tr><th>uid</th><th>uname</th><th>firstname</th><th>lastname</th><th>age</th><th>email</th><th>description</th><th>icon</th><th>state</th><th>post.title</th></tr>";
                        while($row = $result->fetch_row()) {
                            echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[3] . "</td><td>" . $row[4] . "</td><td>" . $row[5] . "</td><td>" . $row[6] . "</td><td>" . $row[7] . "</td><td>";
                            if(strlen($row[8]) != 0) {
                                echo "<img src=\"data:image/jpeg;base64," .$row[8] . "\" alt=\"profile\" class=\"icon-tiny\">";
                            }
                            echo "</td><td>" . $row[9] . "</td><td>" . $row[10] . "</td></tr>";
                        }
                        echo "</table>";
                    }
                ?>
            </div>
            <div class="post-block">
                <p class="center" id="login-title">Suspend User</p>
                <p>Instruction: Fill in the ID of the user in question.</p>
                <form action="" method="post" name="admin-suspend-form" onsubmit="return validateAdminSuspend()">
                <input type="text" name="suspend-id">
                <input type="submit" value="Suspend" class="button">
                </form>
                <p class="alert-search"></p>
                <?php
                    if(isset($_POST["suspend-id"])){
                        $user = "root";
                        $password = "";
                        $db = "sitename_db";
                        $connect = new mysqli("localhost",$user,$password,$db) or die("Unable to connect");
            
                        $stmt = $connect->prepare('UPDATE user SET state = -1 WHERE uid = ?');
                        $stmt->bind_param('i', $suspendID); 
            
                        $suspendID = $_POST["suspend-id"];
                        $stmt->execute();
                        echo "<p>Success. Affected rows: " . $connect->affected_rows . "</p>";
                    }
                ?>
            </div>
            <div class="post-block">
                <p class="center" id="login-title">Remove Posts/Comments</p>
                <p>Instruction: Fill in the input field of your choice and click the respective "Remove" button on the right. Only one type of removal can be done each time.</p>
                <form action="" method="post" name="admin-remove-comment-form" onsubmit="return validateAdminRemoveComment()">
                Remove comment: <input type="text" name="remove-cid">
                <input type="submit" value="Remove" class="button">
                </form>
            
                <form action="" method="post" name="admin-remove-post-form" onsubmit="return validateAdminRemovePost()">
                Remove post: <input type="text" name="remove-pid">
                <input type="submit" value="Remove" class="button">
                </form>
                <p class="warning">Warning: This action is not reversible, so think twice before removing, and make you are deleting the right one.</p>
                <p class="alert-search"></p>
                <?php
                    if(isset($_POST["remove-cid"])){
                        $user = "root";
                        $password = "";
                        $db = "sitename_db";
                        $connect = new mysqli("localhost",$user,$password,$db) or die("Unable to connect");
            
                        $stmt = $connect->prepare('DELETE FROM comment WHERE cid = ?');
                        $stmt->bind_param('i', $deleteCID); 
            
                        $deleteCID = $_POST["remove-cid"];
                        $stmt->execute();
                        echo "<p>Success. " . $connect->affected_rows . " row(s) updated.</p>";
                    }
                    elseif(isset($_POST["remove-pid"])){
                        $user = "root";
                        $password = "";
                        $db = "sitename_db";
                        $connect = new mysqli("localhost",$user,$password,$db) or die("Unable to connect");
            
                        $stmt = $connect->prepare('DELETE FROM post WHERE pid = ?');
                        $stmt->bind_param('i', $deletePID); 
            
                        $deletePID = $_POST["remove-pid"];
                        $stmt->execute();
                        echo "<p>Success. " . $connect->affected_rows . " row(s) deleted.</p>";
                    }
                ?>
            </div>
        </main>
    </body>
</html>