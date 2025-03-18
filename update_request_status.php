<?php
include 'connect.php'; // Ensure this connects to the database.

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './vendor/autoload.php'; // Ensure this points to your PHPMailer installation

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Check if a POST request is received
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $request_id = htmlspecialchars($_POST['request_id']);
    $action = htmlspecialchars($_POST['action']);

    if ($action === 'approve') {
        // Fetch the Donee's email and details
        $query = "
            SELECT dp.Email 
            FROM request r 
            INNER JOIN donee_personal_info dp ON r.Donee_id = dp.Donee_id 
            WHERE r.Request_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $request_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $donee = $result->fetch_assoc();

        if ($donee) {
            $email = $donee['Email'];

            // Update the request status to "Approved"
            $update_query = "UPDATE request SET Status = 'Approved' WHERE Request_id = ?";
            $update_stmt = $conn->prepare($update_query);
            $update_stmt->bind_param("i", $request_id);
            $update_stmt->execute();

            if ($update_stmt->affected_rows > 0) {
                // Send the approval email
                $mail = new PHPMailer(true);

                try {
                    // SMTP settings
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'nirusanjhowa@gmail.com'; // Your Gmail address
                    $mail->Password = 'zvwe fltq lhno zezq';    // Your app password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;

                    // Sender and recipient
                    $mail->setFrom('nirusanjhowa@gmail.com', 'SEWA Admin'); // Sender's email
                    $mail->addAddress($email); // Recipient's email

                    // Email content
                    $mail->isHTML(true);
                    $mail->Subject = 'Request Approved';
                    $mail->Body = "
                        <p>Dear Donee,</p>
                        <p>Your request has been approved! Thank you for using SEWA.</p>
                        <p>We will contact you shortly for further details.</p>
                        <p>Regards,<br>SEWA Team</p>";

                    $mail->send();
                    echo "<script>alert('Request approved and email sent successfully.');</script>";
                } catch (Exception $e) {
                    echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            } else {
                echo "<script>alert('Failed to update request status.');</script>";
            }
        } else {
            echo "<script>alert('No donee found for this request.');</script>";
        }
    } elseif ($action === 'decline') {
        // Fetch the Donee's email and details for the declined request
        $query = "
            SELECT dp.Email 
            FROM request r 
            INNER JOIN donee_personal_info dp ON r.Donee_id = dp.Donee_id 
            WHERE r.Request_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $request_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $donee = $result->fetch_assoc();

        if ($donee) {
            $email = $donee['Email'];

            // Update the request status to "Declined"
            $update_query = "UPDATE request SET Status = 'Declined' WHERE Request_id = ?";
            $update_stmt = $conn->prepare($update_query);
            $update_stmt->bind_param("i", $request_id);
            $update_stmt->execute();

            if ($update_stmt->affected_rows > 0) {
                // Send the declined request email
                $mail = new PHPMailer(true);

                try {
                    // SMTP settings
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'nirusanjhowa@gmail.com'; // Your Gmail address
                    $mail->Password = 'zvwe fltq lhno zezq';    // Your app password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;

                    // Sender and recipient
                    $mail->setFrom('nirusanjhowa@gmail.com', 'SEWA Admin'); // Sender's email
                    $mail->addAddress($email); // Recipient's email

                    // Email content
                    $mail->isHTML(true);
                    $mail->Subject = 'Request Declined';
                    $mail->Body = "
                        <p>Dear Donee,</p>
                        <p>We regret to inform you that your request has been declined. Thank you for your understanding.</p>
                        <p>Regards,<br>SEWA Team</p>";

                    $mail->send();
                    echo "<script>alert('Request declined and email sent successfully.');</script>";
                } catch (Exception $e) {
                    echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            } else {
                echo "<script>alert('Failed to update request status.');</script>";
            }
        } else {
            echo "<script>alert('No donee found for this request.');</script>";
        }
    }

    header("Location: admin.php");
    exit();
}
?>
