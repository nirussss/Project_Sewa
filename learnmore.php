<?php
include 'connect.php';  // Ensure this connects to your database if needed
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learn More - SEWA</title>
    <link rel="stylesheet" href="learnmore.css"> <!-- Link to the CSS for styling the page -->
</head>
<body>
    <nav>
        <div class="nav_bar">
            <div class="nav_logo"><a href="#">SEWA</a></div>
            <ul class="nav_links">
                <li class="link"><a href="home.php">HOME</a></li>
                <li class="link"><a href="about.php">ABOUT</a></li>
                <li class="link"><a href="donate.php">DONATE</a></li>
                <li class="link"><a href="viewrequest.php">REQUESTS</a></li>
                <li class="link"><a href="contact.php">CONTACT</a></li>
            </ul>
        </div>
    </nav>
    
    <div class="learn-more-container">
        <h1>Learn More About SEWA</h1>
        
        <section>
            <h2>Our Mission</h2>
            <p>SEWA (Sustainable and Equal Wardrobe Access) is a platform dedicated to providing individuals with an opportunity to donate used clothes to those in need. Our mission is to promote sustainability, reduce waste, and foster a sense of community by reusing and sharing resources.</p>
        </section>

        <section>
            <h2>How It Works</h2>
            <p>It's simple! As a donor, you can offer your gently used clothing by filling out our donation form. You can specify the kind of clothes, quantity, and your preferred season. SEWA will then connect your donation to individuals in need, ensuring that it reaches the right person at the right time.</p>
        </section>

        <section>
            <h2>Why Donate?</h2>
            <p>Your donation helps reduce waste and contributes to a sustainable lifestyle. By donating your clothes, you’re helping someone in need and making a positive impact on the environment. We believe that by sharing, we can build a stronger, more compassionate community.</p>
        </section>

        <section>
            <h2>Get Involved</h2>
            <p>There are many ways you can get involved with SEWA. Apart from donating clothes, you can also volunteer with us, spread the word about our platform, and inspire others to contribute to a sustainable future. Your involvement will make a big difference!</p>
        </section>
        
        <section>
            <h2>Contact Us</h2>
            <p>If you have any questions or want to know more about how you can contribute, feel free to reach out to us at <a href="mailto:info@sewa.org">info@sewa.org</a>.</p>
        </section>
        
    </div>

    <footer>
        <p>&copy; 2025 SEWA. All Rights Reserved.</p>
    </footer>

</body>
</html>
