<?php
include 'connect.php'; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $request_id = intval($_POST['request_id']);
    
    // Update the request status in the database
    $sql = "UPDATE Request SET status = 'Approved' WHERE Request_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $request_id);
    if ($stmt->execute()) {
        // Count the approved requests
        $count_sql = "SELECT COUNT(*) AS approved_count FROM Request WHERE status = 'Approved'";
        $count_result = $conn->query($count_sql);
        if ($count_result && $row = $count_result->fetch_assoc()) {
            echo json_encode(['success' => true, 'approved_count' => $row['approved_count']]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to fetch approved count']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to approve request']);
    }
}
?>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('button.approve-btn').forEach(button => {
            button.addEventListener('click', (event) => {
                const requestId = button.dataset.requestId; // Get request ID from the button
                const approvedCountElement = document.querySelector('#approved-count'); // Target the approved count

                // Send AJAX request to approve the request
                fetch('approve_request.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `request_id=${requestId}`,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update the approved count
                        approvedCountElement.textContent = data.approved_count;
                        // Optionally, disable the button after approval
                        button.disabled = true;
                        button.textContent = 'Approved';
                    } else {
                        alert(data.message || 'An error occurred');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });
        });
    });
</script>

