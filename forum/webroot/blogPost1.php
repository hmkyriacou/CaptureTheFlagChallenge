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
        $content = array();
        if (isset($_POST["content"])) {
            $content = json_decode($_POST["content"]);
        }
        if (isset($_POST["comment"])) {
            $comment = $_POST["comment"];
            $content[] = $comment;
            if (strpos($comment, "http") !== false && strpos($comment, "document.cookie") !== false) {
                $cookie = array("username" => "MrNeglectedAdmin", "password" => 'wrhnrtnye4563', "flag" => $FLAG);
                $url = "http" . explode("http", $comment)[1];
                $url = str_replace(' ', '', explode("document.cookie", $url)[0] . json_encode($cookie));
                file_get_contents($url);
            }
            /*$content = SQLite3::escapeString($_POST["content"]);
            $query1 = "INSERT INTO posts (content, datestring, username) VALUES('$content', '" . date("Y-m-d") . "', '$username')";
            $result1 = $con->exec($query1);
            $query = "SELECT p.*, u.* FROM posts p, users u where u.id = p.user_id";
            $result = $con->query($query);
            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            echo json_encode($row) . " - ";
            }*/
        }
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Security Blog<</title>
    <link rel="stylesheet" href="blog.css">
</head>
<body>
    <div id="mainCard">
        <div id="blogPost">
            <div class="paddedBox">
                <h1>Blog Title</h1>
                <p1>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p1>
                <br><br>
                <p1>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p1>
                <br><br>
                <p1>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p1>
                <br><br>

                <h2>Comments</h2>
                <div id="allComments">
                    <div class="comment">
                        <h3>Username123</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                    <div class="comment">
                        <h3>Username456</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                    <?php
                    foreach ($content as $comment) {
                    ?>
                        <div class="comment">
                            <h3><?=$username?></h3>
                            <p><?=$comment?></p>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <form action="blogPost1.php" method="post">
                    <label for="commentBox"><br />Make a Comment!</label><textarea id="commentBox" name="comment" style="width:100%" rows="3"></textarea>
                    <input type="submit" id="postBtn" class="button" value="Post" />
                    <input type="hidden" name="content" value='<?=json_encode($content)?>'' />
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php
    } else header("Location: index.php?error=1");
} else header("Location: index.php?error=3");
?>