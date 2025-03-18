<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Signup</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</head>
<body>
  
  <div class="wrapper">
    <h1>Signup</h1>
    <p id="error-message">
    <?php
    include 'connect.php'; // Ensure this file connects to the database correctly.
    
    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
      $name = htmlspecialchars($_POST['name']);
      $email = htmlspecialchars($_POST['email']);
      $password = htmlspecialchars($_POST['password']);
      $confirmpassword = htmlspecialchars($_POST['confirm-password']);

      if ($password !== $confirmpassword) {
          echo "Passwords do not match.";
      } else {
          // Insert user data into the database
          $sql = "INSERT INTO registerinfo (name, email, password) VALUES ('$name', '$email', '$password')";
          
          if (mysqli_query($conn, $sql)) {
              echo "Signup successful!";
          } else {
              echo "Error inserting data: " . mysqli_error($conn);
          }
      }
    }
    ?>
    </p>
    <form id="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <div>
        <label for="firstname-input">
          <box-icon name='user' type='solid'></box-icon>
        </label>
        <input type="text" name="name" id="firstname-input" placeholder="Name" required>
      </div>
      <div>
        <label for="email-input">
          <span>@</span>
        </label>
        <input type="email" name="email" id="email-input" placeholder="Email" required>
      </div>
      <div>
        <label for="password-input">
          <box-icon type='solid' name='lock'></box-icon>
        </label>
        <input type="password" name="password" id="password-input" placeholder="Password" required>
      </div>
      <div>
        <label for="confirm-password-input">
          <box-icon type='solid' name='lock'></box-icon>
        </label>
        <input type="password" name="confirm-password" id="confirm-password-input" placeholder="Confirm Password" required>
      </div>
      <button type="submit" name="submit">Signup</button>
    </form>
    <p>Already have an Account? <a href="login.php">login</a></p>
  </div>

  <script src="validation.js"></script>
</body>
</html>
