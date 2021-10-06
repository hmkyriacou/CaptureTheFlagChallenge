<?php
include "config.php";
    $con = new SQLite3($database_file);
    if (isset($_POST["username"])) {
        $username = SQLite3::escapeString($_POST["username"]);
        $answer1 = SQLite3::escapeString($_POST["answer1"]);
        $answer2 = SQLite3::escapeString($_POST["answer2"]);
        $query = "SELECT * FROM users WHERE name='$username' AND answer1='$answer1' AND answer2='$answer2'";
        $result = $con->query($query);
        
        $row = $result->fetchArray(SQLITE3_ASSOC);
        if ($row) {
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Temporary Password</title>
        <link rel="stylesheet" href="login.css">
    </head>
    <body>
    <main>
        <div id="paddedBox">
            <h3>Temporary Password:</h3>
            <div id="tempPassBox"><h3><?=$row["password"]?></h3></div>
            <div id="buttonBox">
                <a href="index.php"><button id="back">Back to Login</button></a>
            </div>
        </div>
    </main>

    </body>
</html>
<?php
        } else header("Location: index.php?error=2");
    } else header("Location: index.php?error=2");
?>