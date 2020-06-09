<?php
    if(isset($_GET["showPost"])){session_start();}
    $user = "root";
    $password = "";
    $db = "sitename_db";
    $connect = new mysqli("localhost",$user,$password,$db) or die("Unable to connect");

    
    $stmt = $connect->prepare('SELECT post.pid, user.uname, post.title, post.time, COUNT(postvote.pid) AS likes, category.name, post.content, post.img
                                    FROM post JOIN user ON post.uid = user.uid
                                    JOIN category ON category.caid = post.caid
                                    LEFT OUTER JOIN postvote ON postvote.pid = post.pid
                                    GROUP BY post.pid
                                    ORDER BY post.time DESC
                                    LIMIT 5 OFFSET ?');
    $stmt->bind_param('i', $offset); 
            
    if(!isset($_GET["showPost"])){
        $offset = 0;
    }
    else{
        $offset = $_GET["showPost"];
    }
    $stmt->execute();
    $result = $stmt->get_result();
    $temp = 5;
    while ($row = $result->fetch_assoc()) {
        echo "<div id='hidden'></div><section class='post-block' id='post" . $row["pid"] . "'>
                <a class='post-link' href='post.php?pid=" . $row["pid"] . "'>
                    <span class='post-context'>
                        <h4 class='post-title'>" . $row["title"] . "</h4>
                            <h6 class='text-muted'>By " . $row["uname"] . " @ " . $row["time"] . ".</h6><h6 class='text-muted'>Category: " . $row["name"] . ".</h6>" . $row["content"] . "<br>";
                                if(!empty($row["img"])){
                                    echo "<img src='data:image/jpeg;base64," . $row["img"] . "'/>";
                                }
        
        echo "</span></a>
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
        echo "<a class='post-button' href='post.php?pid=" . $row["pid"] . "'>Comments</a>
                    </div>
                </section>";
        $temp --;
    }
    if($temp == 0){
        $offset += 5;
        echo "<button type='button' class='button' onclick=\"
            $('#right-column').append($('<div>').load('show-post.php?showPost=" . $offset . "'));
            this.style.display = 'none';\"> Show More</button>";
    }
    else{
        echo "<span class='post-context-static'><p>There are no more posts.</p></span>";
    } 
?>
<script src="likePost.js"></script>