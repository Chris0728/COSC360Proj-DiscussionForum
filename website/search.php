<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("style-links.php"); ?>
        <title>Search</title>
        <script>
            function validateSearch(){
                var searchType = document.forms["search-form"].elements["search-type"].value;
                var search = document.forms["search-form"].elements["search"].value;
                if(searchType == "" || search == ""){
                    document.getElementById("alert").innerHTML = "You have to fill in every item.";
                    return false;
                }
            }
        </script>
        <script> 
            $(function(){
                $("#includedContent").load("b.html"); 
            });
        </script> 
    </head>
    <body>
        <?php include("header.php");?>
        <main>
            <section class="post-block" id="about">
                <span class="post-context-static">
                    <h4 class="post-title">Search</h4>
                    <form action="" method="get" name="search-form" onsubmit="return validateSearch()">
                        <label>Type: </label>
                        <input type="radio" name="search-type" value="post" <?php if(isset($_GET["search-type"]) && $_GET["search-type"] == "post"){echo "checked";}?>><label>Post </label>
                        <input type="radio" name="search-type" value="category" <?php if(isset($_GET["search-type"]) && $_GET["search-type"] == "category"){echo "checked";}?>><label>Category </label>
                        <input type="text" name="search" maxlength="255" placeholder="Search" class="header-search black" value="<?php if(isset($_GET["search"])){echo $_GET["search"];}?>">
                        <input type="submit" class="search-button black" value="">
                    </form>
                    <p id="alert"></p>
                </span>
            </section>
            <?php
                if(isset($_GET["search-type"])){
                    $_SESSION["recordSearch"] = 1;
                    include("record-search.php");
                    echo "<section class=\"post-block\" id=\"about\">
                            <span class=\"post-context-static\">";
                    if($_GET["search-type"] == "post"){
                        echo "<div id=\"search-post\"><h4 class=\"post-title\">Search by Posts</h4><div>";
                        include("show-search.php");
                        echo "</div></div>";
                    }
                    if($_GET["search-type"] == "category"){
                        echo "<div id=\"search-category\"><h4 class=\"post-title\">Search by Category</h4><div>";
                        include("show-search.php");
                        echo "</div></div>";
                    }
                    echo "</span>
                        </section>";
                }
            ?>
        </main>
    </body>
</html>