<?php
include "config.php";
$con = new SQLite3($database_file);

if(isset($_POST["username"])) {
    $username = SQLite3::escapeString($_POST["username"]);
    $password = SQLite3::escapeString($_POST["password"]);
    $query = "SELECT * FROM users WHERE name='$username' AND password='$password'";
    $result = $con->query($query);
    $row = $result->fetchArray(SQLITE3_ASSOC);
    if ($row) {
        setcookie("username", $username, time() + (86400 * 30), "/");
        setcookie("password", $password, time() + (86400 * 30), "/");
        setcookie("picture", $row["picture"], time() + (86400 * 30), "/");
        setcookie("flag", $username == "hubert423" ? "NotTheFlagYouWant" : $FLAG, time() + (86400 * 30), "/");
        header("Location: blogHome.php");
    } else header("Location: index.php?error=1");
} else header("Location: index.php?error=1");
?>