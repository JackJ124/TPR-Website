<?php
session_start();
include "connect.php";
if (!isset($_SESSION["username"])){
    header("Location:login.php");
}  





// Initialize variables to hold form data and error messages
$name = $email = $phone = $type = $brief = $datetime = "";
$error_message = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    //$userid = $_SESSION['userid'];
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $type = $_POST['type'] ?? '';
    $brief = $_POST['brief'] ?? '';
    $datetime = $_POST['datetime'] ?? '';

    // Validate required fields
    if (empty($name) || empty($email) || empty($phone) || empty($type) || empty($brief) || empty($datetime)) {
        $error_message = "Please fill in all required fields.";
    } else {
        // Prepare and bind
        $stmt = $connection->prepare("INSERT INTO bookings ( name, email, phone, type,brief, datetime) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss",  $name , $email, $phone, $type, $brief, $datetime);

        // Execute the statement
        if ($stmt->execute()) {
            echo "<p id = 'Booking-success-message'>Booking successful!</p>";
            
            $name = $email = $phone = $type = $brief = $datetime = "";
        } else {
            $error_message = "Error: " . $stmt->error;
        }

        // Close connections
        $stmt->close();
        $connection->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rolsa Technologies</title>
    <link rel="stylesheet" href="stylesheet.css">
    <script src="searchfeature.js" defer></script>

</head>
<body>

    <nav>
        <a href = "homepage.php">Home</a>
        <a href = "aboutpage.php">About</a>
        <a href = "productspage.php">Products</a>
        <a href = "CFpage.php">Carbon Footprint</a>
        <a id = "active" href = "Bookingpage.php">Bookings</a>
        <a  id = "searchIcon"><img src = "Images\Search Icon.png" alt = "Search Icon"></a>
        <a href = "Accountspage.php"><img src = "Images\Account Icon.png" alt = "Account Icon"></a>
    </nav>

    <img id = "Logo" src = "Images\Logo.png" alt = "Rolsa Technologies Logo">

    <div id="searchContainer" class="hidden">
        <input type="text" id="searchInput" placeholder="Search for anything...">
        <button class = "hidden"id="closeSearch">✖</button> 
    </div>


<div class = "Booking-container">
        <h1>Book an Appointment</h1>
        <form action="Bookingpage.php" method="POST">
        <input type="hidden" name="userid" value="<?php echo $userid; ?>"> 
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" required>
        </div>
        <div>
            <label for="type">Appointment Type:</label>
            <select id="type" name="type" required>
                <option value="Consultation">Consultation</option>
                <option value="Installation">Installation</option>
            </select>
        </div>
        <div>
            <label for="brief">Brief of appointment:</label>
            <input type="text" id="brief" name="brief" required>
        </div>
        <div>
            <label for="datetime">Booking Date and Time:</label>
            <input type="datetime-local" id="datetime" name="datetime" required>
        </div>
        <button type="submit">Book Appointment</button>
    </form>
</div>



<footer>
        <div>
            <h3></h3>
            <p></p>
        </div>
        <div>
            <h3>About Us</h3>
            <p><a id = "footer-link" href ="aboutpage.php">Our Services</a> <br> 
            <a id = "footer-link" href="aboutpage.php" >Who We are</a> <br> 
            <a id = "footer-link" href="aboutpage.php" >What We Do</a> <br></p>
        </div>
        <div>
            <h3>Bookings</h3>
            <p><a  id = "footer-link" href = "Bookingpage.php">Consultations</a><br>
            <a  id = "footer-link" href = "Bookingpage.php">Instalations</a> <br></p>
        </div>
        <div>
            <h3>Socials</h3>
            <p><a id = "footer-link" href = "">Insagram</a><br>
            <a id = "footer-link" href = "">Facebook</a><br>
            <a id = "footer-link" href = "">Twitter</a>
            </p>
        </div>
    </footer>






    <!--<div class = "hidden"id="itemList">
        <div class="item">Apple</div>
        <div class="item">Banana</div>
        <div class="item">Cherry</div>
        <div class="item">Date</div>
        <div class="item">Elderberry</div>
        <div class="item">Fig</div>
        <div class="item">Grape</div>
    </div>-->
    
</body>
</html>