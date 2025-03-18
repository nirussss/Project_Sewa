<?php
include 'connect.php'; // Include your database connection

if (isset($_GET['email'])) {
    $email = $_GET['email'];

    // Update the user's status to 'disabled'
    $sql = "UPDATE registerinfo SET status = 'disabled' WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        
        header('Location: admin.php'); 
        exit();
    } else {
        echo "Error disabling user: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
