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
            <div id="right-column">
                <?php include("show-post.php"); ?>
            </div>
        </main>
    </body>
</html>