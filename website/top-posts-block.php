<section class="post-block" id="top-posts">
    <span class="post-context-static">
        <h4 class="post-title">Today's top posts</h4>
        <?php 
            $user = "root";
            $password = "";
            $db = "sitename_db";
            $connect = new mysqli("localhost",$user,$password,$db) or die("Unable to connect");
            $stmt = $connect->prepare('SELECT post.pid, user.uname, post.title, post.time, COUNT(postvote.pid) AS likes, category.name, post.content, post.img
                                                        FROM post JOIN user ON post.uid = user.uid
                                                        JOIN category ON category.caid = post.caid
                                                        LEFT OUTER JOIN postvote ON postvote.pid = post.pid
                                                        WHERE post.time > DATE_SUB(NOW(), INTERVAL 24 HOUR)
                                                        GROUP BY post.pid
                                                        HAVING likes >= 2
                                                        LIMIT 5');
                            $stmt->execute();
                            $result = $stmt->get_result();
                            while ($row = $result->fetch_assoc()) {
                                echo "<a class='post-link' href='post.php?pid=" . $row["pid"] . "'>
                                        <span class='post-context'>
                                        " . $row["title"] . " by " . $row["uname"] . " @ " . $row["time"] . ". " . $row["likes"] . " "; if($row["likes"]==1){echo "like";}else{echo "likes";} echo ". Category: " . $row["name"] . ".
                                        </span>
                                    </a>";
                            }
        ?>
    </span>
</section>