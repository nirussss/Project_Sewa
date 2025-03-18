<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Request Form</title>
        <link rel="stylesheet" href="request.css">
    </head>
    <body> 

        <div class="request-form-container">
            <button class="close-button" onclick="goBack()">&#x2715;</button>
                <h1>Request Form</h1>
                <form action="request.php" method="post" id="request-form">
                    <!-- Personal Information -->
                    <fieldset>
                        <legend>Personal Information</legend>
                        <label for="name">Full Name:</label>
                        <input type="text" id="name" name="name" placeholder="Enter your full name" required>
                        
                        <label for="address">Address:</label>
                        <input type="text" id="address" name="address" placeholder="Enter your address" required>
                        
                        <label for="address">Drop off location:</label>
                        <input type="text" id="dropoff_address" name="dropoff_address" placeholder="Enter your dropoff address" required>
                        
                    <label for="phone">Phone:</label>
                    <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required pattern="\d{10}">
                    
                    <label for="email">Email:</label>
                    <input type="email" id="email-input" name="email" placeholder="Enter your email" required>

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
                                <input type="radio" id="other" name="gender" value="unisex">
                                <label for="other">Unisex</label>
                            </div>
                        </div>
                    </fieldset>
                    
                <!-- Kind of Clothes -->
                <fieldset>
                    <legend>Kind of Clothes You Want to Donate</legend>
                    <label for="clothes-type">Type of Clothes:</label>
                    <input type="text" id="clothes_type" name="clothes_type" placeholder="E.g., Shirts, Pants, Jackets" required>
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
                <button type="submit" name="submit">Request Donation</button>
            </form>
            <?php
        include 'connect.php';  // Ensure this connects to your database correctly
        if($conn){
        // echo"database connection successful";
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

        // Sanitize input data
        $name = htmlspecialchars($_POST['name']);
        $address = htmlspecialchars($_POST['address']);
        $dropoff_address = htmlspecialchars($_POST['dropoff_address']);
        $email = htmlspecialchars($_POST['email']);
        $phone = htmlspecialchars($_POST['phone']);
        $season = htmlspecialchars($_POST['season']);
        $gender = htmlspecialchars($_POST['gender']);
        $clothes_type = htmlspecialchars($_POST['clothes_type']);
        $age_group = htmlspecialchars($_POST['age_group']);
        $quantity = htmlspecialchars($_POST['quantity']);




        // Insert donee information
        $sql1 = "INSERT INTO donee_personal_info (Name, Address, Drop_off_address, Email,Phone) 
                    VALUES ('$name', '$address', '$dropoff_address',  '$email','$phone')";

        if (mysqli_query($conn, $sql1)) {
        $donee_id = mysqli_insert_id($conn);  // Get the last inserted donee_id

        // Insert request information linked to the donee
        $sql2 = "INSERT INTO Request (Donee_id, Cloth_type, Season, Quantity, Age_group, Gender) 
                        VALUES ('$donee_id', '$clothes_type', '$season', '$quantity', '$age_group', '$gender')";

        if (mysqli_query($conn, $sql2)) {
        echo "<p>Form submitted successfully!</p>";
        } else {
        echo "<p>Error inserting request data: " . mysqli_error($conn) . "</p>";
        }
        } else {
        echo "<p>Error inserting donee data: " . mysqli_error($conn) . "</p>";
        }

        // Close the connection
        mysqli_close($conn);
        }
        ?>



        </div>

<script src="requestvalidation.js"></script>
<script>
        function goBack() {
            window.history.back(); // Go back to the previous page
        }
    </script>  
</body>
</html>

