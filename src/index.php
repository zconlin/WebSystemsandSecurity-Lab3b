<?php 
  error_reporting(-1);
  session_start();

  if (!isset($_SESSION['logged_in'])) {
    header("Location: views/login.php");
  }  

  // echo var_dump($_SESSION["id"], $_SESSION["username"], $_SESSION["logged_in"], $_SESSION["user_id"]);

  $mysql_servername = getenv("MYSQL_SERVERNAME");
  $mysql_user = getenv("MYSQL_USER");
  $mysql_password = getenv("MYSQL_PASSWORD");
  $mysql_database = getenv("MYSQL_DATABASE");
  
  // Create connection
  $conn = new mysqli($mysql_servername, $mysql_user, $mysql_password, $mysql_database);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Add an appropriate title in this tag -->
  <title>Lab 1</title>

  <!-- Links to stylesheets -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
  <link rel="icon" type="image/x-icon" href="favicon.ico">
</head>

<body>
  <!-- Navigation bar -->
  <nav>
    <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ">Visit byu.edu!</a>
  </nav>
  
  <p>
    <form action="actions/logout_action.php">
    <input class="create-button" type="submit" value="Logout"><br></form>
  </p>

  <!-- <h1 font-family: Sofia, sans-serif>To Do List</h1> -->
  <h1>To Do List</h1>


  <!-- Checkboxes -->
  <form><input type="checkbox" class="toggle-switch" id="cb-sort" name="cb-sort"/><label for="cb-sort">Sort by date</label></form>
  <form><input type="checkbox" class="toggle-switch" id="ft-sort" name="ft-sort"/><label for="ft-sort">Filter completed tasks</label></form>

  <!-- List of tasks -->
  <ul class="tasklist" id="taskList">
    <?php 
    $stmt = $conn->prepare("SELECT `id`, `text`, `date`, `done` FROM task WHERE user_id = ?");
    $stmt->bind_param("i", $_SESSION["id"]);
    $stmt->execute();
    $stmt->bind_result($task_id, $out_text, $out_date, $out_done);
    while ($stmt->fetch()) {
      $date=date_create($out_date);
      echo '
      <li class="task" id=' . $task_id . '>
        <form name="checkbox" action="/actions/update_action.php" method="post" style="display: inline;">
          <button type="submit" class="material-icon"><script> ' . ($out_done == 1) . ' ? (\'check_box\') : (\'check_box_outline_blank\') </script></button>
          <input type="hidden" class="checkbox-icon" name="taskID" value=' . $task_id . '}>
        </form>  
        <span class="task-description set-width ${' . $out_done . ' ? \'checked\' : \'\'}">' . $out_text . '</span>
        <span class="task-date">' . date_format($date, "m/d/Y") . '</span>
        <form name="checkbox" action="/actions/delete_action.php" method="post" style="display: inline;">
          <button type="submit" class="task-delete material-icon">delete</button><br>
          <input type="hidden" class="checkbox-icon"name="taskID" value=' . $task_id . '}>
          </form>
      </li>';
     }
     $stmt->close();
     ?>

</ul>
  <!-- Input Form -->
  <form class="form-create-task" action="/actions/create_action.php" method="post">
    <input type="text" id="text" name="text" required><br>
    <input type="date" id="date" name="date" required><br>
    <input class="create-button" type="submit" value="Create Task" required><br>
    <!-- <input class="create-button" type="submit" value="Create Task" onclick="localStorage.removeItem('area');area.value=''" required><br> -->
  </form>

</script>
  <!-- Links to scripts -->
</body>

</html>