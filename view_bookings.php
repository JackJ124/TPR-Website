<?php
session_start();

if (!isset($_SESSION["username"])){
    header("Location:index.php");
} else{
    include "connect.php";
    $username = $_SESSION['username'];
    $query = $db->prepare('SELECT * FROM users WHERE Username=?');
    $query->execute(array($username));
    $control = $query->fetch(PDO::FETCH_ASSOC);
    if ($control['Admin'] != 1){
         header("Location:films.php");
    }
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
        <a class = "active" href="admin.php">Admin</a>
        </div>
        <div class="nav-right">
        <a href="content.php">Log in</a>
        <a href="register.php">Register</a>
        <a href = "logout.php"> Logout</a>
        </div>
      
    </nav>

    <div>
        <h4>Welcome <?php echo $_SESSION['username']; ?> <br> 
        Login Success!<br>
        <a href = "logout.php"> Logout Here</a><br></h4>
    </div>

    <div>
        <?php include 'connect.php';

        echo "<table>";
        echo "<tr><td>";
        echo "Bookings ID";
        echo "</td><td>";
        echo "Film Name";
        echo "</td><td>";
        echo "User Name";
        echo "</td><td>";
        echo "Tickets ID";
        echo "</td></tr>";

        
        $query = $db ->query("SELECT * FROM bookings");

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {

            $query2 = $db -> prepare("SELECT * FROM users WHERE ID = ? ");
            $query2->execute(array($row['userid']));
            $user = $query2->fetch(PDO::FETCH_ASSOC);

            $query3 = $db -> prepare("SELECT * FROM films  WHERE ID = ?");
            $query3->execute(array($row['filmid']));
            $film = $query3->fetch(PDO::FETCH_ASSOC);
            //echo "<tr><td>";
            //echo $row['ID'];
            //echo "</td><td>";
            //echo $row['name'];
            //echo "</td><td>";
            //echo $row['Username'];
            //echo "</td><td>";
            //echo $row['tickets'];
            //echo "</td></tr>";

            echo "<tr><td>";
            echo $row['ID'];
            echo "</td><td>";
            echo $film['name'];
            echo "</td><td>";
            echo $user['Username'];
            echo "</td><td>";
            echo $row['tickets'];
            echo "</td></tr>";
            
        }

        echo "</table>";
        ?>

        <a href=" admin.php">Admin Page</a>
    </div>

</body>
</html>