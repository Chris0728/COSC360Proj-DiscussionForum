<?php
    if(!isset($_GET["search"])){
        echo "<script> location.replace(\"unauthorized.php\"); </script>";
    }
    $user = "root";
    $password = "";
    $db = "sitename_db";
    $connect = new mysqli("localhost",$user,$password,$db) or die("Unable to connect");

    if((isset($_GET["search-type"]) && $_GET["search-type"] == "post") || isset($_GET["searchPost"])){
        $stmt = $connect->prepare('SELECT post.pid, user.uname, post.title, post.time, COUNT(postvote.pid) AS likes, category.name
                                    FROM post JOIN user ON post.uid = user.uid
                                    JOIN category ON category.caid = post.caid
                                    LEFT OUTER JOIN postvote ON postvote.pid = post.pid
                                    WHERE post.title LIKE ?
                                    GROUP BY post.pid
                                    ORDER BY time DESC
                                    LIMIT 5 OFFSET ?');
        $stmt->bind_param('si', $search, $offset); 
            
        $search = '%' . $_GET["search"] . '%';
        if(!isset($_GET["searchPost"])){
            $offset = 0;
        }
        else{
            $offset = $_GET["searchPost"];
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $temp = 5;
        while ($row = $result->fetch_assoc()) {
            echo "<a class='post-link' href='post.php?pid=" . $row["pid"] . "'>
                    <span class='post-context'>
                        " . $row["title"] . " by " . $row["uname"] . " @ " . $row["time"] . ". " . $row["likes"] . " "; if($row["likes"]==1){echo "like";}else{echo "likes";} echo ". Category: " . $row["name"] . ".
                    </span>
                </a>";
            $temp --;
        }
        if($temp == 0){
            $offset += 5;
            echo "<button type='button' class='button' onclick=\"
                $('#search-post').append($('<div>').load('show-search.php?search=" . $_GET["search"] . "&searchPost=" . $offset . "'));
                this.style.display = 'none';\"> Show More</button>";
        }
        else{
            if($temp == 5 && $offset == 0){
                echo "<span class='post-context-static'><p>No results, please try another keyword or search by category.</p></span>";
            }
            else{
                echo "<span class='post-context-static'><p>There are no more results.</p></span>";
            }
        }
    }
    elseif((isset($_GET["search-type"]) && $_GET["search-type"] == "category") || isset($_GET["searchCategory"])){
        $stmt = $connect->prepare('SELECT post.pid, user.uname, post.title, post.time, COUNT(postvote.pid) AS likes, category.name
                                    FROM post JOIN user ON post.uid = user.uid
                                    JOIN category ON category.caid = post.caid
                                    LEFT OUTER JOIN postvote ON postvote.pid = post.pid
                                    WHERE category.name LIKE ?
                                    GROUP BY post.pid
                                    ORDER BY time DESC
                                    LIMIT 5 OFFSET ?');
        $stmt->bind_param('si', $search, $offset); 
            
        $search = '%' . $_GET["search"] . '%';
        if(!isset($_GET["searchCategory"])){
            $offset = 0;
        }
        else{
            $offset = $_GET["searchCategory"];
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $temp = 5;
        while ($row = $result->fetch_assoc()) {
            echo "<a class='post-link' href='post.php?pid=" . $row["pid"] . "'>
                    <span class='post-context'>
                        " . $row["title"] . " by " . $row["uname"] . " @ " . $row["time"] . ". " . $row["likes"] . " "; if($row["likes"]==1){echo "like";}else{echo "likes";} echo ". Category: " . $row["name"] . ".
                    </span>
                </a>";
            $temp --;
        }
        if($temp == 0){
            $offset += 5;
            echo "<button type='button' class='button' onclick=\"
                $('#search-category').append($('<div>').load('show-search.php?search=" . $_GET["search"] . "&searchCategory=" . $offset . "'));
                this.style.display = 'none';\"> Show More</button>";
        }
        else{
            if($temp == 5 && $offset == 0){
                echo "<span class='post-context-static'><p>No results, please try another keyword or search by category.</p></span>";
            }
            else{
                echo "<span class='post-context-static'><p>There are no more results.</p></span>";
            }
        }
    }
    else{
        echo "<script> location.replace(\"unauthorized.php\"); </script>";
    }
?>