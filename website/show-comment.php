<?php
function showComment($parentID) {
    $user = "root";
    $password = "";
    $db = "sitename_db";
    $connect = new mysqli("localhost",$user,$password,$db) or die("Unable to connect");

    $statement = 'SELECT comment.cid, user.uname, comment.time, COUNT(commentvote.cid) AS likes, comment.content
                                    FROM comment JOIN user ON comment.uid = user.uid
                                    LEFT OUTER JOIN commentvote ON commentvote.cid = comment.cid
                                    WHERE comment.pid = ?
                                    AND parentid = ?
                                    GROUP BY comment.cid
                                    ORDER BY comment.time DESC';
    
    
    $postID = $_GET["pid"];
    if(isset($parentID)){
        $temp = $parentID;
        $stmt = $connect->prepare($statement);
        $stmt->bind_param('ii', $postID, $parentID); 
        
    }
    else{
        $statement = 'SELECT comment.cid, user.uname, comment.time, COUNT(commentvote.cid) AS likes, comment.content
                                    FROM comment JOIN user ON comment.uid = user.uid
                                    LEFT OUTER JOIN commentvote ON commentvote.cid = comment.cid
                                    WHERE comment.pid = ?
                                    AND parentid IS NULL
                                    GROUP BY comment.cid
                                    ORDER BY comment.time DESC';
        $stmt = $connect->prepare($statement);
        $stmt->bind_param('i', $postID); 
    }
    
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        echo "\n<div class=\"comment-block\">
            <h6>By " . $row["uname"] . " @ " . $row["time"] . "</h6>
            " . $row["content"] . "
            <div class=\"comment-stats\">";
                
        
        $likes = $row["likes"];
        if(isset($_SESSION["userID"])){
            $stmt2 = $connect->prepare('SELECT * FROM commentvote WHERE uid = ? AND cid = ?');
            $stmt2->bind_param('ii', $userID, $commentID);
            $userID = $_SESSION["userID"];
            $commentID = $row["cid"];
            $stmt2->execute();
            $result2 = $stmt2->get_result();
            if ($row2 = $result2->fetch_assoc()) {
                echo "<a class='post-button' id='like_c" . $commentID . "' style='color: #00B000;' onclick=\"unlikeComment(" . $commentID . "," . $likes . ");\">" . $likes . " Like(s)</a>";
            }
            else{
                echo "<a class='post-button' id='like_c" . $commentID . "' style='color: #000000;' onclick=\"likeComment(" . $commentID . "," . $likes . ");\">" . $likes . " Like(s)</a>";
            }
        }
        else{
            echo "<a class='post-button' href='login.php'>" . $likes . " Like(s)</a>";
        }
        echo "<a class='post-button' href='create-comment.php?parentid=" . $row["cid"] . "&pid=" . $_GET["pid"] . "'>Reply</a>";
        echo "\n</div>";
        $parentID = $row["cid"];
        showComment($parentID);
        echo "\n</div>";
    }
    if(isset($temp)){
        $parentID = $temp;
    }
}

showComment(null);
     
?>
<script src="likeComment.js"></script>