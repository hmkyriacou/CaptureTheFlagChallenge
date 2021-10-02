<?php
include "config.php";
$con = new SQLite3($database_file);
$con->exec("PRAGMA journal_mode = MEMORY");

$debug = $_POST["debug"];
if ( $_POST["answer"] == "") {
    $username = SQLite3::escapeString($_POST["username"]);
    $password = SQLite3::escapeString($_POST["password"]);
    $query = "SELECT * FROM users WHERE name='$username' AND password='$password'";
    $result = $con->query($query);

    $row = $result->fetchArray();
    if ($row) {
        echo "<h1>Logged in!</h1>";
        echo "<p>Your flag is: $FLAG</p>";
    } else {
        echo "<h1>Login failed.</h1>";
    }
} else {
    $username = SQLite3::escapeString($_POST["username"]);
    $password = SQLite3::escapeString($_POST["password"]);
    $answer = SQLite3::escapeString($_POST["answer"]);
    $query = "SELECT * FROM users WHERE name='$username' AND answer='$answer'";
    $result = $con->query($query);

    $row = $result->fetchArray(SQLITE3_ASSOC);
    if ($row) {
        /*$query1 = "UPDATE users SET password = '$password' WHERE name='$username'";
        $result1 = $con->exec($query1);
        var_dump($result1);
        echo $con->lastErrorMsg();*/
        echo "<h1>You answer correctly! Your password is " . $row["password"] . "</h1>";
    } else {
        echo "<h1>The answer was incorrect.</h1>";
    }
}

/*if (intval($debug)) {
    echo "<pre>";
    echo "username: ", htmlspecialchars($username), "\n";
    echo "password: ", htmlspecialchars($password), "\n";
    echo "SQL query: ", htmlspecialchars($query), "\n";
    echo "</pre>";
}*/
?>