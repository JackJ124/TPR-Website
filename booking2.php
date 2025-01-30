<?php

session_start();

if (!isset($_SESSION["username"])){
    header("Location:login.php");
}                         
else{
    include "connect.php";

    if(isset($_GET["submit"])){
        $filmid = $_GET['filmid'];
        $userid = $_GET['userid'];
        $tickets = $_GET['tickets'];
        echo $filmid."<br>"; 
        echo $userid."<br>";
        echo $tickets."<br>";

        $sql = "INSERT into bookings (filmid,userid,tickets) VALUE ('$filmid','$userid','$tickets')";

        if(mysqli_query($conn, $sql)){
            echo "Booking Success<br>";
            $query = $db->prepare("SELECT * FROM films WHERE ID=?");
            $query->execute(array($filmid));
            $bookfilm = $query->fetch(PDO::FETCH_ASSOC);
            $filmname = $bookfilm['name'];
            echo "You have booked ".$tickets." tickets for ".$filmname."<br>";
            $cost = $tickets *4.99;
            echo "The cost is £".$cost;
        } else{
            echo "Query Error".mysqli_error($conn);
        }
    }
    else{
        header("location:films.php");
    }
}
?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Project Room</title>
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
        <a href="content.php">Log in</a>
        <a href="register.php">Register</a>
        <a href = "logout.php"> Logout</a>
        </div>
      
    </nav>


    <div><h4>
        Hello <?php echo $_SESSION["username"]; ?>
    </h4></div>


</body>
</html>