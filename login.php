<html lang="en"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <!-- <script src="loginvalidation.js"></script> -->
   
  </head>
  <body>

    <div class="wrapper">
      <h1>Login</h1>
      <p id="error-message"></p>
      <?php
include 'connect.php'; // Ensure this file connects to the database correctly.

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize user inputs
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    
    // Updated SQL query with status check
    $sql = "SELECT * FROM registerinfo WHERE email='$email' AND status='active'";
    $run = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($run);
    
    if ($result) {
        if ($result['password'] === $password) { // Compare passwords (consider hashing for security)
            $_SESSION['logingarekochha'] = true;
            echo "Login successful!";
            header('Location: logingarepaxi.php');
            exit();
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "Account not found or disabled.";
    }
}
?>

      <form id="form" method="post" action="login.php">
        <div>
          <label for="email-input">
            <span>@</span>
          </label>
          <input type="email" name="email" id="email-input" placeholder="Email">
        </div>
        <div>
          <label for="password-input">
            <box-icon type='solid' name='lock'></box-icon>
          </label>
          <input type="password" name="password" id="password-input" placeholder="Password">
        </div>
        <button type="submit">Login<a href="logingarepaxi.php"></button>
      </form>
      <p>
        <a href="forgettest.php">Forgot Password?</a>
    </p>
      <p>New here? <a href="signup.php">Create an Account</a></p>
    </div>
     <php
     ?>
  
  </body></html>