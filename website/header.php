<header>
    <a href="top.php"><h2 id="header-name">Site Name</h2></a>
    <div id="header-dropdown">
        <button id="dropdown-button">Options
            <svg class="bi bi-caret-down-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 01.753 1.659l-4.796 5.48a1 1 0 01-1.506 0z"/>
            </svg>
        </button>
        <div id="dropdown-content"><?php
                if(!isset($_SESSION["userID"])){
                    echo "<a href=\"login.php\">Log In</a>
                            <a href=\"signup.php\">Sign Up</a>";
                }
                else{
                    if(isset($_SESSION["state"])){
                        echo "<a href=\"admin.php\">Admin Page</a>";
                    }
                    echo "<a href=\"create-post.php\">Create Post</a>
                            <a href=\"profile.php\">Profile</a>
                            <a href=\"logout.php\">Log Out</a>";
                }
            ?><a href="search.php">Search</a>
            <a href="recommendation.php">Recommendation</a>
            <a href="top-posts.php">Top Posts</a>
            <a href="about.php">About</a>
        </div>
    </div>
    <form id="header-form" action="search.php" method="get">
        <input type="text" name="search" maxlength="255" placeholder="Search" class="header-search white">
        <input type="hidden" name="search-type" value="post">
        <input type="submit" class="search-button white" value="">
    </form>
    <?php
        if(!isset($_SESSION["userID"])){
            echo "<div id=\"header-buttons\">
                    <a class=\"button\" href=\"login.php\">Log In</a>
                    <a class=\"button\" href=\"signup.php\">Sign Up</a>  
                </div>";
        }
        else{
            echo "  <div id=\"logged-message\">Logged in as:<br>" . $_SESSION["username"] . "</div>
                    <div id=\"logged-buttons\">
                        <a class=\"button\" href=\"create-post.php\">Create Post</a>
                        <a class=\"button\" href=\"profile.php\">Profile</a>
                        <a class=\"button\" href=\"logout.php\">Log Out</a>
                    </div>";
        }
    ?>
</header>
