<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="admin_login.css">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</head>
<body>
<div class="wrapper">
        <h1>Admin Login</h1>
        <p id="error-message"></p>
<form id="admin-login-form" method="post" action="admin_login.php">
            <!-- Admin ID -->
            <!-- <div>
                <label for="admin-id-input">
                    <box-icon name='id-card'></box-icon>
                </label>
                <input type="text" name="admin_id" id="admin-id-input" placeholder="Admin ID" required>
            </div> -->
            <!-- Name -->
            <!-- <div>
                <label for="name-input">
                    <box-icon name='user'></box-icon>
                </label>
                <input type="text" name="name" id="name-input" placeholder="Name" required>
            </div> -->
            <!-- Email -->
            <div>
                <label for="email-input">
                    <box-icon name='envelope'></box-icon>
                </label>
                <input type="email" name="email" id="email-input" placeholder="Email" required>
            </div>
            <!-- Password -->
            <div>
                <label for="password-input">
                    <box-icon type='solid' name='lock'></box-icon>
                </label>
                <input type="password" name="password" id="password-input" placeholder="Password" required>
            </div>
            <!-- Submit Button -->
            <button type="submit">Login</button>
        </form>
        <p>
    </div>
    <?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Connect to the database
    include 'connect.php';

    // Query to check admin login
    $query = "SELECT * FROM admin WHERE Email='$email' AND Password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Login successful!')</script>";
        // Redirect to admin dashboard
        header('Location: admin.php');
    } else {
        echo "<script>alert('Invalid credentials!')</script>";
    }
}
?>

</body>
</html>
