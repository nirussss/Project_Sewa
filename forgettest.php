<?php
include 'connect.php'; // Ensure this file connects to the database.


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './vendor/autoload.php';
  

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = htmlspecialchars($_POST['email']);
    
    // Check if email exists in the database
    $sql = "SELECT * FROM registerinfo WHERE email='$email'";
    $run = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($run);

    if ($result) {
        // Generate a random reset token
        $token = bin2hex(random_bytes(16));
        $reset_link = "http://localhost/Sewa/resetpw.php?token=".$token;

        // Store the token in the database
        $update_sql = "UPDATE registerinfo SET reset_token='$token' WHERE email='$email'";
        mysqli_query($conn, $update_sql);

        // Send email with reset link
        
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();                                // Use SMTP
            $mail->Host       = 'smtp.gmail.com';           // Set the SMTP server
            $mail->SMTPAuth   = true;                       // Enable SMTP authentication
            $mail->Username   = 'nirusanjhowa@gmail.com';     // Your Gmail address
            $mail->Password   = 'zvwe fltq lhno zezq';        // Your App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
            $mail->Port       = 587;                        // SMTP port for TLS
        
            // Email content
            $mail->setFrom('your-email@gmail.com', 'nireu'); // Sender info
            $mail->addAddress($email, 'Recipient Name'); // Recipient email
            $mail->isHTML(true);                            // Set email format to HTML
            $mail->Subject = 'Password Reset Request';
            $mail->Body    = "Click $reset_link to reset your password.";
            // $mail->AltBody = 'Click the following link to reset your password: http://example.com/reset_password.php?token=unique_token';
        
            $mail->send();
            echo "<script>alert('Password reset link has been sent to your email.')</script>";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        }
    } else {
        // echo "No account found with this email address.";
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</head>
<body>
    <div class="wrapper">
        <h1>Forgot Password</h1>
        
        <form id="form" method="post" action="forgettest.php">
            <div>
                <label for="email-input">
                    <span>@</span>
                </label>
                <input type="email" name="email" id="email-input" placeholder="Enter your email" required>
            </div>
            <button type="submit">Send Reset Link</button>
        </form>
            <!-- Display message below the form -->
        <?php if (!empty($message)): ?>
            <p id="error-message"><?php echo $message; ?></p>
        <?php endif; ?>

        <p>
            <a href="login.php">Back to Login</a>
        </p>
    </div>
</body>
</html>