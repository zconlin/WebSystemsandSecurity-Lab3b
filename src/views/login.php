<?php
   ob_start();
   session_start();
   echo $_SESSION["usernameLoginError"];
   unset($_SESSION["usernameLoginError"]);
   echo $_SESSION["passwordLoginError"];
   unset($_SESSION["passwordLoginError"]);
?>

<html lang = "en">
   
   <head>
      <title>Login</title>  

      <link rel="stylesheet" href="../css/style.css">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
      <link rel="icon" type="image/x-icon" href="favicon.ico">
   </head>
   <body>
      <h2>Enter Username and Password</h2>       
      <div>
      <form action="/actions/login_action.php" method="post">
         <input type="text" name="usernameLogin" placeholder="username" required autofocus></br>
         <input type="password" name="password" placeholder="password" required></br>
         <button class="create-button" name="login">Login</button>
      </form>
      <form action="register.php" method="post">
         <button class="create-button" name = "register">Register</button>
      </form>
         <!-- Click here to <a href = "../actions/login_action.php" title = "Login"> login. -->
         <!-- Click here to <a href = "../actions/logout_action.php" title = "Logout"> logout. -->
      </div>      
   </body>
</html>
