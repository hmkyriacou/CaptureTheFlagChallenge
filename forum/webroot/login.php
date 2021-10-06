<?php
include "config.php";
$con = new SQLite3($database_file);
$con->exec("PRAGMA journal_mode = MEMORY");

$debug = $_POST["debug"];
$username = SQLite3::escapeString($_POST["username"]);
$password = SQLite3::escapeString($_POST["password"]);
$query = "SELECT * FROM users WHERE name='$username' AND password='$password'";
$result = $con->query($query);

$row = $result->fetchArray(SQLITE3_ASSOC);
if ($row) {
    setcookie("username", $username, time() + (86400 * 30), "/");
    setcookie("password", $password, time() + (86400 * 30), "/");
    setcookie("image", $row, time() + (86400 * 30), "/");
    setcookie("flag", $username == "ndoe" ? "NotTheFlagYouWant" : $FLAG, time() + (86400 * 30), "/");
    header("Location: forum.php");
} else {
    echo "<h1>Login failed.</h1>";
}

if (intval($debug)) {
    echo "<pre>";
    echo "username: ", htmlspecialchars($username), "\n";
    echo "password: ", htmlspecialchars($password), "\n";
    echo "SQL query: ", htmlspecialchars($query), "\n";
    echo "</pre>";
}
?>