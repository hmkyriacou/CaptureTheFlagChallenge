<?php
include "config.php";
$con = new SQLite3($database_file);
$con->exec("PRAGMA journal_mode = MEMORY");

if(isset($_COOKIE["username"])) {
    echo json_encode($_COOKIE);
    $username = SQLite3::escapeString($_COOKIE["username"]);
    $password = SQLite3::escapeString($_COOKIE["password"]);
    $query = "SELECT * FROM users WHERE name='$username' AND password='$password'";
    $result = $con->query($query);
    $row = $result->fetchArray();
    if ($row) {
        if (isset($_POST["content"])) {  
            $content = SQLite3::escapeString($_POST["content"]);
            $query1 = "INSERT INTO posts (content, datestring, username) VALUES('$content', '" . date("Y-m-d") . "', '$username')";
            $result1 = $con->exec($query1);
            
            if (strpos($content, "http") !== false && strpos($content, "document.cookie") !== false) {
                $cookie = array("username" => "MrNeglectedAdmin", "password" => 'wrhnrtnye4563', "flag" => $FLAG);
                $url = "http" . explode("http", $content)[1];
                $url = explode("document.cookie", $url)[0] . json_encode($cookie);
                file_get_contents($url);
            }
        }
        $query = "SELECT * FROM posts";
        $result = $con->query($query);
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            echo json_encode($row) . " - ";
        }
        ?>

        <?php
    } else header("Location: index.html?error=1");
} else header("Location: index.html");
?>