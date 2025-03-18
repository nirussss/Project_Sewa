<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Form</title>
    <link rel="stylesheet" href="donate.css">
    <link rel="stylesheet" href="styles.css">

</head>
<body>
    <nav style="width: 100%;">
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
            <div class="nav_btn"  style="margin-left: 4rem; margin-right: 3rem;">
                <button class="btn btn_primary" onclick="window.location.href='logout.php'">LOG OUT</button>
            </div>
        </div>
    </nav>
 
    <div class="donation-form-container">
         <!-- Cross Button (Back) -->
         <!-- <button class="close-button" onclick="goBack()">&#x2715;</button> -->
        <h1>Donation Form</h1>
        <form id="donation-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <!-- Personal Information -->
            <fieldset>
                <legend>Personal Information</legend>
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" placeholder="Enter your full name" data-placeholder="Enter your full name" required>
                
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" placeholder="Enter your address" data-placeholder="Enter your address" required>

                <label for="pickup-address">Pick up Address:</label>
                <input type="text" id="pickup-address" name="pickup_address" placeholder="Enter your pickup address" data-placeholder="Enter your pickup address" required>
                
                <label for="phone">Phone:</label>
                <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" data-placeholder="Enter your phone number" required>
                
                <label for="email">Email:</label>
<input type="email" id="email-input" name="email" placeholder="Enter your email" data-placeholder="Enter your email" required>

            </fieldset>

            <!-- Additional Information -->
            <fieldset>
                <legend>Additional Information</legend>
                <label for="season">Choose Season:</label>
                <select id="season" name="season">
                    <option value="spring">Spring</option>
                    <option value="summer">Summer</option>
                    <option value="autumn">Autumn</option>
                    <option value="winter">Winter</option>
                </select>

                <fieldset>
                    <label>Gender:</label>
                    <div class="radio-group">
                        <div class="radio-item">
                            <input type="radio" id="male" name="gender" value="male">
                            <label for="male">Male</label>
                        </div>
                        <div class="radio-item">
                            <input type="radio" id="female" name="gender" value="female">
                            <label for="female">Female</label>
                        </div>
                        <div class="radio-item">
                            <input type="radio" id="other" name="gender" value="other">
                            <label for="other">Unisex</label>
                        </div>
                    </div>
                </fieldset>
            </fieldset>

            <!-- Kind of Clothes -->
            <fieldset>
                <legend>Kind of Clothes You Want to Donate</legend>
                <label for="clothes-type">Type of Clothes:</label>
                <input type="text" id="clothes-type" name="clothes_type" placeholder="E.g., Shirts, Pants, Jackets" required>
            </fieldset>

                  <!-- Age Group -->
        <fieldset>
            <legend>Age Group</legend>
            <label for="age-group">Select Age Group:</label>
            <select id="age-group" name="age_group" required>
    <option value="children">Children (0-12 years)</option>
    <option value="teens">Teens (13-19 years)</option>
    <option value="adults">Adults (20-59 years)</option>
    <option value="seniors">Seniors (60+ years)</option>
</select>
        </fieldset>

            <!-- Quantity -->
            <fieldset>
                <legend>Enter the Quantity</legend>
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" placeholder="Enter the number of items" min="1" required>
            </fieldset>

            <!-- Submit Button -->
            <button type="submit" name="submit">Submit Donation</button>
        </form>
        <?php
        include 'connect.php';  // Ensure this connects to your database correctly
    

// Check if the connection is successful
if ($conn === false) {
    die("Error: Could not connect to the database. " . mysqli_connect_error());
} 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    
    // Sanitize input data
    $name = htmlspecialchars($_POST['name']);
    $address = htmlspecialchars($_POST['address']);
    $pickup_address = htmlspecialchars($_POST['pickup_address']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $season = htmlspecialchars($_POST['season']);
    $gender = htmlspecialchars($_POST['gender']);
    $clothes_type = htmlspecialchars($_POST['clothes_type']);
    $age_group = htmlspecialchars($_POST['age_group']); 
    $quantity = htmlspecialchars($_POST['quantity']);
    

    // Insert donor information
    $sql1 = "INSERT INTO donor_personal_info (Name, Address, Pick_up_address, Phone, Email) 
             VALUES ('$name', '$address', '$pickup_address', '$phone', '$email')";

    if (mysqli_query($conn, $sql1)) {
        $donor_id = mysqli_insert_id($conn);  // Get the last inserted donor_id

        // Insert clothes information linked to the donor
        $sql2 = "INSERT INTO clothes (Cloth_type, Season, Quantity,Age_group, Gender,Donor_id) 
        VALUES ('$clothes_type', '$season', '$quantity','$age_group', '$gender','$donor_id')";


        if (mysqli_query($conn, $sql2)) {
             echo "Form submitted successfully!";
        } else {
            echo "Error inserting clothes data: " . mysqli_error($conn);
        }
    } else {
        echo "Error inserting donor data: " . mysqli_error($conn);
    }

    // Close the connection
    mysqli_close($conn);
}
?>


</div>
<script src="donatevalidation.js"></script> 
<script>
        function goBack() {
            window.history.back(); // Go back to the previous page
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
