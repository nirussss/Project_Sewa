<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="milako.css">
    <script src="https://unpkg.com/scrollreveal"></script>
    <title>HOME PAGE</title>
</head>
<body>
    <?php
    session_start();

    // Check if session is active
    if (isset($_SESSION['logingarekochha'])) {
        $session_status = true;
    } else {
        $session_status = false;
    }

    if ($session_status) {
        session_unset();
        session_destroy();
    }
    ?>

    <div class="nav_bar">
        <div class="nav_logo"><a href="#">SEWA</a></div>
        <div class="hamburger" onclick="toggleMenu()">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
        <ul class="nav_links">
            <li class="link"><a href="home.php">HOME</a></li>
            <li class="link"><a href="about.php">ABOUT</a></li>
            <li class="link"><a href="contact.php">CONTACT</a></li>
        </ul>
        <div class="nav_btn">
            <div class="btn_dropdown">
                <button class="btn btn_primary">LOGIN</button>
                <ul class="sublink">
                    <li><a href="admin_login.php">As Admin</a></li>
                    <li><a href="login.php">As User</a></li>
                </ul>
            </div>
            <button class="btn btn_secondary" onclick="window.location.href='signup.php'">REGISTER</button>
        </div>
    </div>

    <header class="header">
        <div class="header_container">
            <div class="header_content">
                <h1>Your Old Clothes, Their New Beginnings</h1>
                <p>Instead of letting your clothes gather dust, let them create change. Every donation spreads warmth, hope, and the promise of a better tomorrow. Clean out your closet today, and give your clothes a chance to make a meaningful difference in your community.</p>
            </div>
            <div class="header_image">
                <img src="Sewa.png" alt="header">
            </div>
        </div>
    </header>

    <footer class="footer">
        <div class="footer_content">
            <p>&copy; 2024 Sewa by Niru and Rupesh.</p>
            <p>Follow us: 
                <a href="#">Facebook</a> | 
                <a href="#">Twitter</a> | 
                <a href="#">Instagram</a>
            </p>
        </div>
    </footer>

    <!-- JavaScript for the Navigation -->
    <script>
        function toggleMenu() {
            const navLinks = document.querySelector('.nav_links');
            navLinks.classList.toggle('show');
        }
    </script>
</body>
</html>
