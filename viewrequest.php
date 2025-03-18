<?php
include 'connect.php';  

// Check if the connection is successful
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// SQL query to fetch only approved requests
$sql = "SELECT 
            donee_personal_info.Name AS FullName, 
            donee_personal_info.Address AS Address, 
            donee_personal_info.Drop_off_address AS DropOffLocation, 
            donee_personal_info.Email AS Email, 
            donee_personal_info.Phone AS Phone, 
            Request.Cloth_type AS ClothType, 
            Request.Season AS Season, 
            Request.Quantity AS Quantity, 
            Request.Gender AS Gender
        FROM donee_personal_info
        INNER JOIN Request ON donee_personal_info.Donee_id = Request.Donee_id 
        WHERE Request.status = 'approved'";  // Corrected the quotes around 'approved'

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Approved Requests</title>
    <link rel="stylesheet" href="viewrequest.css"> 
    <link rel="stylesheet" href="styles.css"> 

</head>
<body>

    <nav>
        <div class="nav_bar">
            <!-- <div class="nav_logo"><a href="#">SEWA</a></div> -->
            <div class="nav_logo">
                <a href="#">
                    <img src="sewaLogo.jpg" alt="SEWA Logo" class="circle-logo">
                </a>
            </div>
            <!-- Hamburger Icon -->
            <!-- <div class="hamburger" id="hamburger">&#9776;</div> -->
             <div class="hamburger" onclick="toggleMenu()">
                <div></div>
                <div></div>
                <div></div>
            </div>
            <ul class="nav_links" id="nav-links" style="font-size: 1.3rem;">
                <li class="link"><a href="home.php">Home</a></li>
                <li class="link"><a href="about.php">About</a></li> 
                <li id="donut" class="link"><a href="donate.php">Donate</a></li>
                <li class="link"><a href="viewrequest.php">View Requests</a></li>
                <li class="link"><a href="request.php">Request form</a></li>
                <li class="link"><a href="contact.php">Contact</a></li>
            </ul>
            <div class="nav_btn"  style="margin-top: 2rem; margin-left: 4rem; margin-right: 3rem;">
                <button class="btn btn_primary" onclick="window.location.href='logout.php'">LOG OUT</button>
            </div>
        </div>
    </nav>

    
    <div class="view-requests-container">
        <!-- <button class="close-button" onclick="goBack()">&#x2715;</button>  -->
        <div class="bg-img">
          <h3 class="deeds" style="color:#f6f326; margin-top:10rem; font-size:2rem;"> Your generosity plants seeds of hope that can grow into forests of change.</h3>
    </div>
    <h1>View Requests</h1>
                
        <?php if (mysqli_num_rows($result) > 0): ?>
            <table border="1">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Address</th>
                        <th>Drop Off Location</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Cloth Type</th>
                        <th>Season</th>
                        <th>Quantity</th>
                        <th>Gender</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['FullName']) ?></td>
                            <td><?= htmlspecialchars($row['Address']) ?></td>
                            <td><?= htmlspecialchars($row['DropOffLocation']) ?></td>
                            <td><a href="mailto:<?= htmlspecialchars($row['Email']) ?>"><?= htmlspecialchars($row['Email']) ?></a></td>
                            <td><?= htmlspecialchars($row['Phone']) ?></td>
                            <td><?= htmlspecialchars($row['ClothType']) ?></td>
                            <td><?= htmlspecialchars($row['Season']) ?></td>
                            <td><?= htmlspecialchars($row['Quantity']) ?></td>
                            <td><?= htmlspecialchars($row['Gender']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No approved requests found.</p>
        <?php endif; ?>

        <?php mysqli_close($conn); ?> 
    </div>

    <script>
        function goBack() {
            window.history.back();
        }

    </script>

    <script>
         function toggleMenu() {
            const navLinks = document.querySelector('.nav_links');
            const hamburger = document.querySelector('.hamburger');
            navLinks.classList.toggle('active'); // Toggles the visibility of the navigation links
            hamburger.classList.toggle('active'); // Toggles the hamburger menu's active state
        }

         const navItems = document.querySelectorAll('.nav_item');

        // Add a click event listener to each link
        navItems.forEach(item => {
            item.addEventListener('click', function() {
                // Remove the active class from all links
                navItems.forEach(link => link.classList.remove('active'));

                // Add the active class to the clicked link
                this.classList.add('active');
            });
        });

    /// JavaScript for hamburger menu toggle
    const hamburger = document.getElementById("hamburger");
    const navLinks = document.getElementById("nav-links");

    // Toggle visibility of nav links on hamburger click
    hamburger.addEventListener("click", () => {
        navLinks.classList.toggle("active"); // Toggle 'active' class to show/hide the links
    });

    // Prevent the default link behavior for "REQUESTS" and toggle submenu on hover
    const requestsLink = document.getElementById("requests-link");
    const submenu = requestsLink ? requestsLink.nextElementSibling : null; // Submenu will be the next sibling

    // Show submenu when hovering over the "REQUESTS" link
    if (requestsLink && submenu) {
        requestsLink.addEventListener("mouseover", function () {
            submenu.style.display = "block"; // Display submenu
        });

        // Hide submenu when mouse leaves the "REQUESTS" link or submenu
        requestsLink.addEventListener("mouseout", function () {
            submenu.style.display = "none"; // Hide submenu
        });

        // Ensure the submenu hides if the mouse leaves the submenu as well
        submenu.addEventListener("mouseover", function () {
            submenu.style.display = "block"; // Keep submenu visible when mouse is over it
        });

        submenu.addEventListener("mouseout", function () {
            submenu.style.display = "none"; // Hide submenu when mouse leaves
        });
    }
    </script>
</body>
</html>
