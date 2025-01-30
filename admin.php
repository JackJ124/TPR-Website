<?php
session_start();

if (!isset($_SESSION["username"])){
    header("Location:index.php");
}                         
else{
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
        <h4>Welcome <?php echo $_SESSION['username']; ?>, <br> 
         to the Admin page!<br></h4>
    </div>

    <div class = "center" id = "Table-Size">
        <h2 id = "title">Films</h2>
        <?php include 'connect.php';
        $query = $db ->query('SELECT * FROM films');
        echo "<table>";

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr><td>";
            echo $row['name'];
            echo "</td><td>";
            echo $row['description'];
            echo "</td><td>";
            echo "<a href = \"delete.php?ID=".$row['ID']."\">Delete<a/>";
            echo "</td><td>";
            echo "<a href = \"update.php?ID=".$row['ID']."\">Update<a/>";
            echo "</td></tr>";
        }

        echo "</table>";
        ?>
        <br>
        <a id = "ddd" href = "add.php">Add new film</a>
        <a  id = "ddd" href = "view_bookings.php">View Bookings</a>

        <hr>
    </div>
    
    <div>
        <div id = "food">
            <h2 id = "title">Food</h2>
            <?php include 'connect.php';
            $query = $db ->query('SELECT * FROM food');
            echo "<table>";

            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr><td>";
                echo $row['name'];
                echo "</td><td>";
                echo $row['description'];
                echo "</td><td>";
                echo $row['price'];
                echo "</td><td>";
                echo "<a href = \"deletefood.php?ID=".$row['ID']."\">Delete<a/>";
                echo "</td><td>";
                echo "<a href = \"updatefood.php?ID=".$row['ID']."\">Update<a/>";
                echo "</td></tr>";
            }
            echo "</table>";

            ?>
            <a href = "addfood.php">Add new Food</a>

        </div>
            
        <div id="drink">
            <h2 id = "title">Drink</h2>
            <?php include 'connect.php';
            $query = $db ->query('SELECT * FROM drink');
            echo "<table>";

            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr><td>";
                echo $row['name'];
                echo "</td><td>";
                echo $row['description'];
                echo "</td><td>";
                echo $row['price'];
                echo "</td><td>";
                echo "<a href = \"deletedrink.php?ID=".$row['ID']."\">Delete<a/>";
                echo "</td><td>";
                echo "<a href = \"updatedrink.php?ID=".$row['ID']."\">Update<a/>";
                echo "</td></tr>";
            }
            echo "</table>";

            ?>
            <a href = "adddrink.php">Add new Drink</a>
            <br>
        </div>
        
    </div>
    <a  id = "ddd" href = "view_basket.php">View Basket</a>
    


</body>
</html>