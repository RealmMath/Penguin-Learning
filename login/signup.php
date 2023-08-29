<?php

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
  // The user is already logged in, redirect to the home page
  header('Location: home-page/index.html');
}

// Create the signup form
?>

<!DOCTYPE html>
<html>
<head>
<title>Sign Up</title>
</head>
<body>

<form action="signup.php" method="post">
<input type="text" name="username" placeholder="Username">
<input type="email" name="email" placeholder="Email">
<input type="password" name="password" placeholder="Password">
<input type="password" name="confirm_password" placeholder="Confirm Password">
<input type="submit" value="Sign Up">
</form>

</body>
</html>

<?php

// If the user submitted the form, create a new user
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Get the username, email, and password from the form
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  // Validate the form data
  if (empty($username)) {
    echo '<p>Please enter a username</p>';
  } else if (empty($email)) {
    echo '<p>Please enter an email address</p>';
  } else if (empty($password)) {
    echo '<p>Please enter a password</p>';
  } else if ($password != $confirm_password) {
    echo '<p>The passwords do not match</p>';
  } else {
    // The form data is valid, create a new user
    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
    mysqli_query($conn, $sql);

    // Redirect the user to the login page
    header('Location: login.php');
  }
}

?>
