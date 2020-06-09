<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("style-links.php"); ?>
        <title>Site Name</title>
    </head>
    <body>
        <?php include("header.php"); ?>
        <main>
            <div id="left-column">
                <?php include("recommendation-block.php"); ?>
                <?php include("top-posts-block.php"); ?>
                <?php include("about-block.html"); ?>
            </div>
            
                        <?php 
                            $user = "root";
                            $password = "";
                            $db = "sitename_db";
                            $connect = new mysqli("localhost",$user,$password,$db) or die("Unable to connect");
                            $stmt = $connect->prepare('SELECT post.pid, user.uname, post.title, post.time, COUNT(postvote.pid) AS likes, category.name, post.content, post.img
                                                        FROM post JOIN user ON post.uid = user.uid
                                                        JOIN category ON category.caid = post.caid
                                                        LEFT OUTER JOIN postvote ON postvote.pid = post.pid
                                                        WHERE post.pid = ?
                                                        GROUP BY post.pid');
                            $stmt->bind_param('i', $postID); 
                            $postID = $_GET["pid"];
                            $stmt->execute();
                            $result = $stmt->get_result();
                            while ($row = $result->fetch_assoc()) {
                                echo "<div id=\"right-column\"><div id='hidden'></div><section class=\"post-block\"><span class=\"post-context-static\"><h4 class='post-title'>" . $row["title"] . "</h4>
                                                <h6 class='text-muted'>By " . $row["uname"] . " @ " . $row["time"] . ".</h6><h6 class='text-muted'>Category: " . $row["name"] . ".</h6>" . $row["content"] . "<br>";
                                if(!empty($row["img"])){
                                    echo "<img src='data:image/jpeg;base64," . $row["img"] . "'/>";
                                }
        
                                echo "</span>
                                <div class='post-stats'>";
                                $likes = $row["likes"];
                                if(isset($_SESSION["userID"])){
                                    $stmt2 = $connect->prepare('SELECT * FROM postvote WHERE uid = ? AND pid = ?');
                                    $stmt2->bind_param('ii', $userID, $postID);
                                    $userID = $_SESSION["userID"];
                                    $postID = $row["pid"];
                                    $stmt2->execute();
                                    $result2 = $stmt2->get_result();
                                    if ($row2 = $result2->fetch_assoc()) {
                                        echo "<a class='post-button' id='like" . $postID . "' style='color: #00B000;' onclick=\"unlikePost(" . $postID . "," . $likes . ");\">" . $likes . " Like(s)</a>";
                                    }
                                    else{
                                        echo "<a class='post-button' id='like" . $postID . "' style='color: #000000;' onclick=\"likePost(" . $postID . "," . $likes . ");\">" . $likes . " Like(s)</a>";
                                    }
                                }
                                else{
                                    echo "<a class='post-button' href='login.php'>" . $likes . " Like(s)</a>";
                                }
                                echo "<a class='post-button' href='create-comment.php?pid=" . $postID . "'>Create Comment</a>
                                </div>
                                </section>";
                            }
                        ?>
                    
                <section class="post-block">
                    <span class="post-context-static">
                        <h4 class="post-title" id>Comments</h4>
                        <?php include("show-comment.php"); ?>
                    </span>
                </section>
            
        </main>
    </body>
    <script src="likePost.js"></script>
</html>