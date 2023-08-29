<?php

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
  // The user is already logged in, redirect to the home page
  header('Location: home.php');
}

// Create the login form
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
</head>
<body>

<form action="login.php" method="post">
<input type="text" name="username" placeholder="Username">
<input type="password" name="password" placeholder="Password">
<input type="submit" value="Login">
</form>

</body>
</html>

<?php

// If the user submitted the form, check the username and password
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Get the username and password from the form
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Check if the username and password are valid
  $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  $result = mysqli_query($conn, $sql);

  // If the query returns a row, the user is logged in
  if (mysqli_num_rows($result) == 1) {
    // Get the user id from the database
    $row = mysqli_fetch_assoc($result);
    $user_id = $row['id'];

    // Set the session variables
    $_SESSION['user_id'] = $user_id;
    $_SESSION['username'] = $username;

    // Redirect the user to the home page
    header('Location: /home-page/index.html');
  } else {
    // The username and password are not valid
    echo '<p>Invalid username or password</p>';
  }
}

?>
