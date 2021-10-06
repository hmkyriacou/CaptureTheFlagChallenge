<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="login.css">
</head>
<body>
<main>
  <div id="paddedBox">
    <h1>Login</h1>
<?php
if (isset($_GET["error"])) {
    switch ($_GET["error"]) {
        case 1:
            $errorMessage = "Wrong credentials!";
            break;
        case 2:
            $errorMessage = "Your answers were incorrect!";
            break;
    }
    ?>

<div class="alert alert-danger">
    <?=$errorMessage?>
</div>
    <?php
}
?>
    <form action="/verification.php" method="post">
        <div>
            <label for="usernameInput">Username:</label>
            <input type="text" id="usernameInput" name="username">
        </div>
        <div class="downTwelvePx">
            <label for="passwordInput">Password</label>
            <input type="password" id="passwordInput" name="password">
        </div>
        <div id="buttonBox">
            <input type="submit" id="loginBtn" class="button" value="Login" />
        </div>
    </form>
    <div id="buttonBox2">
      <a href="forgotPass.html"><button id="forgotPassBtn">Forgot Password?</button></a>
    </div>
    <h3 id="newlyCreated"></h3>
  </div>
</main>
</body>
</html>