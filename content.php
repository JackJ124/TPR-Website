<?php
session_start();

if (!isset($_SESSION["username"])){
    header("Location:index.php");
}                           
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Projection Room</title>
    <link rel = "stylesheet" href = "stylesheet.css"> 

</head>
<body>

<nav>
        <div class = "nav-left">
        <a href="films.php">Films</a>
        <a href = "FoodandDrink.php">Food and Drink</a>
        <a href = "basket.php">Basket</a>
        <a href="admin.php">Admin</a>
        </div>
        <div class="nav-right">
        <a class = "active" href="content.php">Log in</a>
        <a href="register.php">Register</a>
        <a href = "logout.php"> Logout</a>
        </div>
      
    </nav>

    <div>
        <center><h2>Welcome <?php echo $_SESSION["username"]; ?> <br>
        Login Success!<br>
        </h2></center>
        
        <h3>Welcome to The Projection Room!<br> Have Fun </h3>
        

    </div>
</body>
</html>

