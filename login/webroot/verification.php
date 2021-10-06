<?php
include "config.php";
$con = new SQLite3($database_file);

if(isset($_POST["username"])) {
    $username = SQLite3::escapeString($_POST["username"]);
    $password = SQLite3::escapeString($_POST["password"]);
    $query = "SELECT * FROM users WHERE name='$username' AND password='$password'";
    $result = $con->query($query);
    $row = $result->fetchArray();
    if ($row) {
        ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <title>Forgot Password?</title>
                <link rel="stylesheet" href="login.css">
            </head>
            <body>
            <main>
                <div id="paddedBox">
                    <h1>Congratulations you got the flag!</h1>
                    <h2>Your flag is: <?=$FLAG?></h2>
                    <p>Don't forget to use the credentials you got in the next challenge!</p>
                </div>
            </main>

            </body>
            </html>
        <?php
        } else header("Location: index.php?error=1");
    } else header("Location: index.php?error=1");
?>