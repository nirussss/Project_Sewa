<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin.css">   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body>
    <style>
        .stat-item a {
            display: block; /* Makes the entire block clickable */
            text-decoration: none;
            color: inherit;
            padding: 10px;
            border-radius: 4px;
        }

        .stat-item a:hover {
            background-color: #f0f0f0; /* Adds a subtle background change on hover */
            color: #007BFF; /* Optional: Change text color on hover */
        }

        .nav_logo {
        flex: 1;
        }

        .circle-logo {
        width: 100px; /* Ensure equal height and width for a perfect circle */
        border-radius: 50%; /* Makes the image circular */
        object-fit: cover; /* Ensures the image fits within the circle without distortion */
        border: 2px solid #000; /* Optional: Adds a border around the circle */
        }

        .nav_logo a {
        font-size:1rem;
        font-weight: 700;
        color: #c6def5;
        /* margin-right: 5rem; */
        }

        .nav_logo img {
        width: 100px;
        border-radius: 50%;
        object-fit: cover;
        }
    </style>

    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="nav_logo">
                <a href="#">
                    <img src="sewaLogo.jpg" alt="SEWA Logo" class="circle-logo">
                </a>
            </div>
            <h2>Welcome, Admin</h2>
            <nav>
                <ul>
                    <li><a href="#overview"><i class="fas fa-chart-line"></i> Overview</a></li>
                    <li><a href="#donations"><i class="fas fa-hand-holding-heart"></i> Manage Donations</a></li>
                    <li><a href="#requests"><i class="fas fa-tasks"></i> Manage Requests</a></li>
                    <li><a href="#approved-requests"><i class="fas fa-check-circle"></i> Approved Requests</a></li>
                    <li><a href="#users"><i class="fas fa-users"></i> User Management</a></li>
                    <li><a href="#reports"><i class="fas fa-file-alt"></i> Reports</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
        <?php
        include 'connect.php';  // Include database connection

        // Query to count total donations
        $sql_total_donations = "SELECT COUNT(*) AS total_donations FROM Clothes";
        $result_total_donations = $conn->query($sql_total_donations);

        if ($result_total_donations && $row = $result_total_donations->fetch_assoc()) {
            $total_donations = $row['total_donations'];
        } else {
            $total_donations = 0; // Default to 0 if the query fails
        }

        $sql_total_requests = "SELECT COUNT(*) AS total_requests FROM Request";
        $result_total_requests = $conn->query($sql_total_requests);

        if ($result_total_requests && $row = $result_total_requests->fetch_assoc()) {
            $total_requests = $row['total_requests'];
        } else {
            $total_requests = 0; // Default to 0 if the query fails
        }
        

// Query to count pending requests
$sql_pending_requests = "SELECT COUNT(*) AS pending_requests FROM Request WHERE Status = 'Pending'";
$result_pending_requests = $conn->query($sql_pending_requests);

if ($result_pending_requests && $row = $result_pending_requests->fetch_assoc()) {
    $pending_requests = $row['pending_requests'];
} else {
    $pending_requests = 0; // Default to 0 if the query fails
}


// Query to count approved requests
$sql_approved_requests = "SELECT COUNT(*) AS approved_requests FROM Request WHERE Status = 'Approved'";
$result_approved_requests = $conn->query($sql_approved_requests);

if ($result_approved_requests && $row = $result_approved_requests->fetch_assoc()) {
    $approved_requests = $row['approved_requests'];
} else {
    $approved_requests = 0; // Default to 0 if the query fails
}
?>


            <!-- Overview Section -->
            <section id="overview" class="section">
                <h1>Overview</h1>
                <div class="stats">
                    <div class="stat-item">
                        <h2>Total Donations</h2>
                        <p><i class="fas fa-hand-holding-heart"></i> <?php echo $total_donations; ?></p>
                    </div>
                    <div class="stat-item">
                        <h2>Total Requests</h2>
                        <p><i class="fas fa-tasks"></i> <?php echo $total_requests; ?></p>
                    </div>
                    <div class="stat-item">
                        <h2>Pending Requests</h2>
                        <p><i class="fas fa-hourglass-half"></i> <?php echo $pending_requests; ?></p>
                    </div>
                    <div class="stat-item">
                        <h2>Approved Requests</h2>
                        <p><i class="fas fa-check-circle"></i> <?php echo $approved_requests; ?></p>
                    </div>
                </div>
            </section>

            <?php
            include 'connect.php';
            $sql = "SELECT c.Cloth_id, c.Cloth_type, c.Season, c.Quantity, c.Gender, c.Donor_id, 
            d.Name AS Donor_name, d.Address AS Donor_address, d.Phone AS Donor_phone, d.Email AS Donor_email
     FROM Clothes c
     JOIN Donor_personal_info d ON c.Donor_id = d.Donor_id";
            $result = $conn->query($sql);
            ?>

            <!-- Manage Donations Section -->
            <section id="donations" class="section">
                <h1>Manage Donations</h1>
                <table>
                    <thead>
                        <tr>
                            <th>Donor Name</th>
                            <th>Donor Address</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Cloth Type</th>
                            <th>Season</th>
                            <th>Quantity</th>
                            <th>Gender</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Check if there are results
                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>" . htmlspecialchars($row['Donor_name']) . "</td>
                                        <td>" . htmlspecialchars($row['Donor_address']) . "</td>
                                        <td>" . htmlspecialchars($row['Donor_phone']) . "</td>
                                        <td>" . htmlspecialchars($row['Donor_email']) . "</td>
                                        <td>" . htmlspecialchars($row['Cloth_type']) . "</td>
                                        <td>" . htmlspecialchars($row['Season']) . "</td>
                                        <td>" . htmlspecialchars($row['Quantity']) . "</td>
                                        <td>" . htmlspecialchars($row['Gender']) . "</td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='8'>No donations found</td></tr>";
                        }
                        ?>
                    </tbody>    
                </table>
            </section>

            <?php
            $sql = "SELECT r.Request_id, r.Cloth_type, r.Season, r.Quantity, r.Gender, r.Donee_id, 
            d.Name AS Donee_name, d.Address AS Donee_address, d.Email AS Donee_email, d.Phone AS Donee_phone, r.Status
   FROM Request r
   JOIN donee_personal_info d ON r.Donee_id = d.Donee_id
   WHERE r.Status = 'Pending'";  // Only fetch requests with status 'Pending'

            $result = $conn->query($sql);
            ?>

            <!-- Manage Requests Section -->
            <!-- Manage Requests Section -->
<section id="requests" class="section">
    <h1>Manage Requests</h1>
    <table>
        <thead>
            <tr>
                <th>Donee Name</th>
                <th>Donee Address</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Cloth Type</th>
                <th>Season</th>
                <th>Quantity</th>
                <th>Gender</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Check if there are results
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['Donee_name']) . "</td>
                            <td>" . htmlspecialchars($row['Donee_address']) . "</td>
                            <td>" . htmlspecialchars($row['Donee_phone']) . "</td>
                            <td>" . htmlspecialchars($row['Donee_email']) . "</td>
                            <td>" . htmlspecialchars($row['Cloth_type']) . "</td>
                            <td>" . htmlspecialchars($row['Season']) . "</td>
                            <td>" . htmlspecialchars($row['Quantity']) . "</td>
                            <td>" . htmlspecialchars($row['Gender']) . "</td>
                            <td>Pending</td>
                            <td>
                                <div class='action-buttons'>
                                    <!-- Approve button -->
                                    <form action='update_request_status.php' method='POST' class='inline-form'>
                                        <input type='hidden' name='request_id' value='" . htmlspecialchars($row['Request_id']) . "'>
                                        <button type='submit' name='action' value='approve' class='btn btn-approve'>Approve</button>
                                    </form>
                                    <!-- Decline button -->
                                    <form action='update_request_status.php' method='POST' class='inline-form' onsubmit='return confirmDecline()'>
                                        <input type='hidden' name='request_id' value='" . htmlspecialchars($row['Request_id']) . "'>
                                        <button type='submit' name='action' value='decline' class='btn btn-decline'>Decline</button>
                                    </form>
                                </div>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='10'>No requests found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</section>

<script>
    // Confirm before declining a request
    function confirmDecline() {
        return confirm("Are you sure you want to decline and delete this request?");
    }
</script>

            </section>

            <!-- Approved requests section -->
            <section id="approved-requests" class="section">
                <h1>Approved Requests</h1>
                <table>
                    <thead>
                        <tr>
                            <th>Donee Name</th>
                            <th>Donee Address</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Cloth Type</th>
                            <th>Season</th>
                            <th>Quantity</th>
                            <th>Gender</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Fetch approved requests
                        $sql = "SELECT r.Request_id, r.Cloth_type, r.Season, r.Quantity, r.Gender, 
                                       d.Name AS Donee_name, d.Address AS Donee_address, d.Phone AS Donee_phone, d.Email AS Donee_email
                                FROM Request r
                                JOIN donee_personal_info d ON r.Donee_id = d.Donee_id
                                WHERE r.Status = 'Approved'";  // Only approved requests
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>" . htmlspecialchars($row['Donee_name']) . "</td>
                                        <td>" . htmlspecialchars($row['Donee_address']) . "</td>
                                        <td>" . htmlspecialchars($row['Donee_phone']) . "</td>
                                        <td>" . htmlspecialchars($row['Donee_email']) . "</td>
                                        <td>" . htmlspecialchars($row['Cloth_type']) . "</td>
                                        <td>" . htmlspecialchars($row['Season']) . "</td>
                                        <td>" . htmlspecialchars($row['Quantity']) . "</td>
                                        <td>" . htmlspecialchars($row['Gender']) . "</td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='8'>No approved requests found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </section>

 <!-- User Management Section -->
            <?php
            $sql = "SELECT name, email, status FROM registerinfo";
           $result = $conn->query($sql);
          ?>


           
<section id="users" class="section">
        <h1>User Management</h1>
        <table>
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Check if there are results
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td>";
                        if ($row['status'] == 'active') {
                            // Disable button for active users
                            echo "<form action='disable_user.php' method='GET' onsubmit=\"return confirm('Are you sure you want to disable this user?')\">
                                    <input type='hidden' name='email' value='" . htmlspecialchars($row['email']) . "'>
                                    <button type='submit'>Disable</button>
                                  </form>";
                        } else {
                            // Enable button for disabled users
                            echo "<form action='enable_user.php' method='GET' onsubmit=\"return confirm('Are you sure you want to enable this user?')\">
                                    <input type='hidden' name='email' value='" . htmlspecialchars($row['email']) . "'>
                                    <button type='submit'>Enable</button>
                                  </form>";
                        }
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No users found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </section>

            <!-- Reports Section -->
            <?php
include 'connect.php';  // Include database connection

// Query to get the donation count per user
$sql_donations_log = "
    SELECT d.Name AS Donor_name, d.Email AS Donor_email, COUNT(c.Cloth_id) AS Donation_count
    FROM Donor_personal_info d
    LEFT JOIN Clothes c ON d.Donor_id = c.Donor_id
    GROUP BY d.Donor_id
    ORDER BY Donation_count DESC"; // You can order by donation count or any other criteria

$result_donations_log = $conn->query($sql_donations_log);

// Arrays to store the donor names and donation counts
$donor_names = [];
$donation_counts = [];

if ($result_donations_log->num_rows > 0) {
    // Populate the arrays with data
    while ($row = $result_donations_log->fetch_assoc()) {
        $donor_names[] = htmlspecialchars($row['Donor_name']);
        $donation_counts[] = htmlspecialchars($row['Donation_count']);
    }
}
?>
<?php
include 'connect.php';  // Include database connection

// Query to fetch the total donations count for each donor
$sql = "
    SELECT d.Name, COUNT(c.Cloth_id) AS donation_count
    FROM Donor_personal_info d
    LEFT JOIN Clothes c ON d.Donor_id = c.Donor_id
    GROUP BY d.Name
    ORDER BY donation_count DESC";  // Optionally order by donation count

$result = $conn->query($sql);

// Arrays to store donor names and donation counts
$donor_names = [];
$donation_counts = [];

if ($result->num_rows > 0) {
    // Populate the arrays with data
    while ($row = $result->fetch_assoc()) {
        $donor_names[] = htmlspecialchars($row['Name']);
        $donation_counts[] = (int)$row['donation_count'];  // Ensuring donation_count is treated as an integer
    }
}
?>

<section id="reports" class="section">
    <h1>Reports</h1>
    <p>Generate and view detailed reports on donations, requests, and user activity.</p>

    <!-- Donation Count Chart -->
    <canvas id="donationChart" width="200" height="100"></canvas>
    <script>
        // Data for the chart
        const donorNames = <?php echo json_encode($donor_names); ?>;
        const donationCounts = <?php echo json_encode($donation_counts); ?>;

        // Create the chart
        const ctx = document.getElementById('donationChart').getContext('2d');
        const donationChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: donorNames,
                datasets: [{
                    label: 'Number of Donations',
                    data: donationCounts,
                    backgroundColor: 'rgba(37, 127, 224, 0.2)',  // Bar color
                    borderColor: 'rgb(83, 151, 240)',  // Border color
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,  // Start the Y-axis from 0
                        stepSize: 1.0,  // Set each step to increase by 1
                        grid: {
                            color: 'rgba(200, 200, 200, 0.2)',  // Lighter grid lines
                        }
                    },
                    x: {
                        grid: {
                            color: 'rgba(200, 200, 200, 0.2)'  // Lighter grid lines
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        backgroundColor: '#2c3e50',
                        titleColor: '#ffffff',
                        bodyColor: '#ffffff',
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + ' donations';
                            }
                        }
                    },
                    legend: {
                        labels: {
                            font: {
                                size: 14
                            }
                        }
                    }
                }
            }
        });
    </script>
</section>



        </main>
    </div>
</body>
</html>
