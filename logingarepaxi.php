<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="home.css">
    <script src="https://unpkg.com/scrollreveal"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://unpkg.com/scrollreveal"></script>
    <title>HOME PAGE</title>
</head>
<body>
<?php
session_start();

if (!isset($_SESSION['logingarekochha']) || !$_SESSION['logingarekochha']) {
    header('Location: home.php'); // Redirect to login page if not logged in
    exit;
}
?>

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

    <div class="bgimg">
        <h3 class="deed" style="color:blueviolet; margin-bottom:10rem;"> A good deed should not need a reason.</h3>
    </div>

    <div class="container1">
        <div class="text">
            <h1 align="center">" No act of kindness, <br> no matter how small, <br> is never wasted "</h1>
            <hr>
        </div>
        <div class="image">
            <img src="Donating-to-Charity.jpg" style="max-width: 100% ; margin-top: 5rem; ">
        </div>

    </div>

    <header class="header">
        <div class="header_container">
            <div class="header_image">
                <img src="Sewa.png" alt="header">
            </div>
            <div class="header_content">
                <h1>"Your Old Clothes, Their New Beginnings"</h1>
                <p>Instead of letting your clothes gather dust, let them create change. Every donation spreads warmth, hope, and the promise of a better tomorrow. Clean out your closet today, and give your clothes a chance to make a meaningful difference in your community.</p>
            </div>
        </div>
    </header>

    <div class="main">

      <h2 style="font-family: cursive; text-align: center;text-shadow: 0px 1px #000; font-size : 2.5rem; color: #7d8b96">Some famous philanthropists:</h2><br><br>
      <div class="row">
        <div class="column">
          <div class="card">
            <img src="ratanTata.jpg" alt="Jane" style="width:100%;height: 400px;">
            <div class="container2">
              <h2>Late Ratan Tata</h2>
              <p>Late Ratan Tata, former chairman of Tata Group, was known for his philanthropy, focusing on healthcare, education, and rural development. Through Tata Trusts, he supported cancer care, scholarships, and disaster relief, leaving a legacy of social impact and ethical leadership.</p>

            </div>
          </div>
        </div>

        <div class="column">
          <div class="card">
            <img src="hemani.jpg" alt="Mike" style="width:100%;height: 400px;">
            <div class="container2">
              <h2>Hemani Shah</h2>
              <p>Under the able leadership of Her Royal Highness Former Crown Princess Himani Rajya Laxmi Devi Shah, Himani trust was established. It works towards uplifting the quality of life in important sectors such as sustainable livelihood.....</p>

            </div>
          </div>
        </div>

        <div class="column">
          <div class="card">
            <img src="bill.jpg" alt="John" style="width:100%;height: 400px; box-shadow:0px 8px 10px #888888;">
            <div class="container2">
              <h2>Bill Gates</h2>
              <p>Gates is a noted philanthropist and has pledged a significant amount of money to research and charitable causes during the coronavirus pandemic. He has given more than $50 billion to charity since 1994...</p>

            </div>
          </div>
        </div>
      </div>
    </div>

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

    <script src="main.js"></script>

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
