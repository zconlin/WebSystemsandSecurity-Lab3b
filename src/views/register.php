<?php
session_start();

echo $_SESSION["passwordError"];
unset($_SESSION["passwordError"]);
echo $_SESSION["usernameError"];
unset($_SESSION["usernameError"]);
?>

<head>
    <title>Login</title>  

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
</head>
<h2 font-family: Sofia, sans-serif>Register New User</h2>
<form method="post" action="/actions/register_action.php">
    Username:
    <input type="text" name = "usernameRegister" required><br>
    Password:
    <input type="password" name = "passwordRegister" required><br>
    Confirm Password:
    <input type="password" name = "passwordConfirm" required><br>
    <input type="hidden" name="form_submitted" value="1" />
    <input class="create-button" type="submit" value="Submit">
</form>
<form action="login.php" method="post">
    <button class="create-button" name = "login">I already have an account</button>
</form>
