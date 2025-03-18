<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>

    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link rel="stylesheet" type="text/css" href="contact.css">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>
<div class="nav_bar">
    <div class="nav_logo">
        <a href="#">
            <img src="sewaLogo.jpg" alt="SEWA Logo" class="circle-logo">
        </a>
    </div>
    <div class="hamburger" onclick="toggleMenu()">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <ul class="nav_links">
        <li class="link"><a href="home.php" class="nav_item">HOME</a></li>
        <li class="link"><a href="about.php" class="nav_item">ABOUT</a></li>
        <li class="link"><a href="contact.php" class="nav_item">CONTACT</a></li>
        <li class="btn_dropdown">
            <button class="btn btn_primary">
                <span class="blink_text">LOG IN</span>
            </button>
            <ul class="sublink">
                <li><a href="admin_login.php">As Admin</a></li>
                <li><a href="login.php">As User</a></li>
            </ul>
        </li>
        <li><button class="btn btn_secondary" onclick="window.location.href='signup.php'">REGISTER</button></li>
    </ul>
</div>
    <section class="contact">
        <div class="content">
            <h2>Contact Us</h2>
            <p>YOU CAN CONTACT US EASILY.</p>
        </div>
        <div class="container">
            <div class="contactInfo">
                <div class="box">
                    <div class="icon"><box-icon name='current-location'></box-icon></div>
                    <div class="text">
                        <h3>Address</h3>
                        <p>Nagadesh,<br>Madhyapur Thimi-7, Bhaktapur</p>
                    </div>
                </div>
                <div class="box">
                    <div class="icon"><box-icon type='solid' name='phone-call'></box-icon></div>
                    <div class="text">
                        <h3>Phone</h3>
                        <p>9803598013<br>9813584178</p>
                    </div>
                </div>
                <div class="box">
                    <div class="icon"><box-icon name='envelope' type='solid'></box-icon></div>
                    <div class="text">
                        <h3>Email</h3>
                        <p>sewanepal1@gmail.com</p>
                    </div>
                </div>
            </div>

            <div class="contactForm">
                <form method="POST" action="contact.php" id="contact-form">
                    <h2>Feedbacks</h2>
                    <br>
                    <div class="inputBox">
                        <input type="text" name="full-name" id="name">
                        <span>Full Name</span>
                    </div>
                    <div class="inputBox">
                        <input type="email" name="email" id="email">
                        <span>Email</span>
                    </div>
                    <div class="inputBox">
                        <textarea name="message" id="message"></textarea>
                        <span>Type Your Message..</span>
                    </div>
                    <div class="inputBox">
                        <button type="submit" name="submit" style="background-color: green; font-size: 1rem; width: 6rem; height:2.5rem; 
                        margin-left: 40%;
                        margin-top:5%;
                        color:aliceblue">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <footer class="footer">
        <div class="footer_content">
            <p>Follow us:
                <a href="#" class="social_link" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social_link" title="Twitter"><i class="fab fa-twitter"></i></a>
                <a href="#" class="social_link" title="Instagram"><i class="fab fa-instagram"></i></a>
            </p>
            <p>&copy; 2024 Sewa by Niru and Rupesh.</p>

        </div>
    </footer>

<!-- JavaScript for the Navigation -->
<script>
        // function toggleMenu() {
        //     const navLinks = document.querySelector('.nav_links');
        //     navLinks.classList.toggle('show');
        // }

        function toggleMenu() {
    const navLinks = document.querySelector('.nav_links');
    const hamburger = document.querySelector('.hamburger');
    navLinks.classList.toggle('active'); // Toggles the visibility of the navigation links
    hamburger.classList.toggle('active'); // Toggles the hamburger menu's active state
}




        // Get all navigation links
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
    </script>

    <script src="main.js"></script>
    <?php
    include 'connect.php';
    if ($conn) {
        // echo "connected";
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        // Sanitize form input data
        $fullname = htmlspecialchars($_POST['full-name']);
        $email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']);

        // Check if all fields are filled
        if ($fullname && $email && $message) {
            // echo "data taken into variables";
            // Insert data into the database
            $sql = "INSERT INTO contact_info (fullname, email, message) VALUES ('$fullname', '$email', '$message')";

            if (mysqli_query($conn, $sql)) {
                echo "<p>Thank you for contacting us!</p>";
            } else {
                echo "<p>Error: " . mysqli_error($conn) . "</p>";  // Show error if query fails
            }
        } else {
            echo "<p>Please fill out all fields.</p>";
        }
    }

    mysqli_close($conn); // Close database connection
    ?>

    <script src="contactvalidation.js"></script>
</body>
</html>