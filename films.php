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
        <a class = "active" href="films.php">Films</a>
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

    <!--<div>
        <h4>Welcome <?php echo $_SESSION['username']; ?> <br> 
        Login Success!<br>
        <a href = "logout.php"> Logout Here</a><br></h4>
    </div>-->

    <div>
        <h2 id = "title">Films</h2>
    </div>

    <div class = "center" id = "Table-Size">
        <?php include 'connect.php';
        $query = $db ->query('SELECT * FROM films');
        echo "<table class = \"FilmsTable\">";

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr><td>";
            echo $row['name'];
            echo "</td><td>";
            echo $row['description'];
            echo "</td><td>";
            echo "<a href=\"booking.php?ID=".$row['ID']."\">Book Here</a>";
            echo"</td></tr>";
        }

        echo "</table>";
        ?>

        <a href=" admin.php">Admin Page</a>
    </div>



</body>
</html>