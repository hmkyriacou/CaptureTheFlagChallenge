<?php
include "config.php";
$con = new SQLite3($database_file);

if(isset($_COOKIE["username"])) {
    $username = SQLite3::escapeString($_COOKIE["username"]);
    $password = SQLite3::escapeString($_COOKIE["password"]);
    $query = "SELECT * FROM users WHERE name='$username' AND password='$password'";
    $result = $con->query($query);
    $row = $result->fetchArray(SQLITE3_ASSOC);
    if ($row) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Security Blog</title>
    <link rel="stylesheet" href="blog.css">
</head>
<body>
<div id="mainCard">

    <h1>My Security Blog</h1>

    <a href="blogPost1.php">
        <div class="blogPostPreview">
            <div class="paddedBox">
                <h2>Title here</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                <h3>Posted on 10/02/2021 by Noah Olson - 2 comments</h3>
            </div>
        </div>
    </a>

    <a href="blogPost2.php">
        <div class="blogPostPreview">
            <div class="paddedBox">
                <h2>Title here</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                <h3>Posted on 10/02/2021 by Noah Olson - 2 comments</h3>
            </div>
        </div>
    </a>

    <a href="blogPost3.php">
        <div class="blogPostPreview">
            <div class="paddedBox">
                <h2>Title here</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                <h3>Posted on 10/02/2021 by Noah Olson - 2 comments</h3>
            </div>
        </div>
    </a>
</div>

</body>
</html>
        <?php
    } else header("Location: index.php?error=1");
} else header("Location: index.php?error=3");
?>