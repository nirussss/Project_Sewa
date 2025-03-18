<?php
include 'connect.php'; 

if (isset($_GET['email'])) {
    $email = htmlspecialchars($_GET['email']);

   
    $sql = "UPDATE registerinfo SET status = 'active' WHERE email = ?";

    // Prepare and execute the query
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        echo "User enabled successfully.";
        header("Location: admin.php");
        exit();
    } else {
        echo "Error enabling user: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "No email specified.";
}

$conn->close();
?>
