<section class="post-block" id="recommendation">
    <span class="post-context-static">
        <h4 class="post-title">Recommendations</h4>
        <?php 
            if(!isset($_SESSION["userID"])){
                echo "<span class='post-context-static'>You need to log in to get recommendations.</span>";
            }
            else{
                $user = "root";
                $password = "";
                $db = "sitename_db";
                $connect = new mysqli("localhost",$user,$password,$db) or die("Unable to connect");
                $stmt = $connect->prepare("SELECT post.pid, user.uname, post.title, post.time, COUNT(postvote.pid) AS likes, category.name
                                    FROM post JOIN user ON post.uid = user.uid
                                    JOIN category ON category.caid = post.caid
                                    LEFT OUTER JOIN postvote ON postvote.pid = post.pid
                                    WHERE post.title LIKE concat('%', (SELECT term FROM search WHERE type = 'post' AND uid = " . $_SESSION["userID"] . " ORDER BY RAND() LIMIT 1), '%')
                                    GROUP BY post.pid
                                    ORDER BY time DESC
                                    LIMIT 3");
                $stmt->execute();
                $result = $stmt->get_result();
                $hasRecommendation = false;
                echo "<span class='post-context-static small-title'>By title search record:</span>";
                while ($row = $result->fetch_assoc()) {
                    $hasRecommendation = true;
                    echo "<a class='post-link' href='post.php?pid=" . $row["pid"] . "'>
                            <span class='post-context'>
                            " . $row["title"] . " by " . $row["uname"] . " @ " . $row["time"] . ". " . $row["likes"] . " "; if($row["likes"]==1){echo "like";}else{echo "likes";} echo ". Category: " . $row["name"] . ".
                            </span>
                        </a>";
                }
                if(!$hasRecommendation){
                    echo "<span class='post-context-static'>There are no recommendations yet, try searching something!</span>";
                }
                $stmt2 = $connect->prepare("SELECT post.pid, user.uname, post.title, post.time, COUNT(postvote.pid) AS likes, category.name
                                    FROM post JOIN user ON post.uid = user.uid
                                    JOIN category ON category.caid = post.caid
                                    LEFT OUTER JOIN postvote ON postvote.pid = post.pid
                                    WHERE category.name LIKE concat('%', (SELECT term FROM search WHERE type = 'category' AND uid = " . $_SESSION["userID"] . " ORDER BY RAND() LIMIT 1), '%')
                                    GROUP BY post.pid
                                    ORDER BY time DESC
                                    LIMIT 3");
                $stmt2->execute();
                $result2 = $stmt2->get_result();
                $hasRecommendation = false;
                echo "<span class='post-context-static small-title'>By category search record:</span>";
                while ($row2 = $result2->fetch_assoc()) {
                    $hasRecommendation = true;
                    echo "<a class='post-link' href='post.php?pid=" . $row2["pid"] . "'>
                            <span class='post-context'>
                            " . $row2["title"] . " by " . $row2["uname"] . " @ " . $row2["time"] . ". " . $row2["likes"] . " "; if($row2["likes"]==1){echo "like";}else{echo "likes";} echo ". Category: " . $row2["name"] . ".
                            </span>
                        </a>";
                }
                if(!$hasRecommendation){
                    echo "<span class='post-context-static'>There are no recommendations yet, try searching something!</span>";
                }
            }
            
        ?>
    </span>
</section>