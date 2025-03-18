<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="about.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="whySewa.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">

</head>

<body>
    <?php
    session_start();
    $is_logged_in = isset($_SESSION['logingarekochha']); // Replace with your actual session variable for login.
    ?>

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
    <div class="image">	
		<h3 class="deed">Donation indicates Appreciation. <br> Nobody has ever turned out to<br> be poor by giving.</h3>
	</div>

    <div class="body">
		<div class="containers">
			<div class="about">
				<h1>About Us</h1>
			</div>
			<div class="contents">
				<div class="article">
					<h2>Why Sewa?</h2>
					<p>
                    Sewa is a cloth donation website designed to facilitate the donation of gently used clothing to those in need.
                    People can request help for clothes through this platform.
		 			</p>
		 			<p>
		 			This website also plays a vital role in developing a sense of volunteering and promoting good deeds. The core aim of “Sewa” is to simplify the donation process, making it accessible to anyone with the desire to help.  
		 			</p>
		 			<p>
		 			This platform helps donors who want to donate clothing items but face challenges due to busy schedules and a lack of convenient and trustworthy donation channels. “Sewa” encourages more individuals to participate in charitable acts, amplifying the collective impact on society.
		 			</p>
		 			<a href="" class="button">Read More</a>
				</div>
				<div class="image-section">
					<img src="plant.jpg">
				</div>
			</div>

			<br>

			<div class="content2">
				<div class="article2">
					<h2>Mission</h2>
					<p>Our mission is to save and transform lives, inspire people to live with meaning and purpose, and help build a better world.</p>
				</div>

				<div class="article2">
					<h2>Vision</h2>
					<p> 
						Every person has the opportunity to achieve his/her fullest potential and participate in and contribute to all aspects of life.  
					</p>
				</div>
				
			</div>
			<br>

			<div class="content1">
				<div class="image-section1">
					<img src="discussion.jpeg">
				</div>
				<div class="article1">
					<h2>Our Goals</h2>
					<ul>
						<li>"Making donation an easy process."</li>
						<li>"Expanding fund raising activities for the orphanages."</li>
						<li>"Helping people to take a step in creation of change."</li>
						<li>"Spreading wisdom of "Big chances are caused by small help."</li>
					</ul>
				</div>
		    </div>
			<br>
		</div>
	</div>

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
</body>

</html>