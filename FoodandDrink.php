<?php
session_start();

if (!isset($_SESSION["username"])){
    header("Location:index.php");
}       
if(isset($_POST['submit'])) {
    include 'connect.php';
    $foodid = mysqli_real_escape_string($conn, $_POST['foodid']);
    $drinkid = mysqli_real_escape_string($conn, $_POST['drinkid']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $sql = "INSERT into basket (foodid ,drinkid, quantity) VALUES ('$foodid','$drinkid' ,'$quantity')";

     //enter the data
     if(mysqli_query($conn, $sql)) {
        header("Location:FoodandDrink.php");
    } else {
        echo 'Query Error'.mysqli_error($conn);
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
        <a class = "active" href = "FoodandDrink.php">Food and Drink</a>
        <a href = "basket.php">Basket</a>
        <a href="admin.php">Admin</a>
        </div>
        <div class="nav-right">
        <a href="content.php">Log in</a>
        <a href="register.php">Register</a>
        <a href = "logout.php"> Logout</a>
        </div>
      
    </nav>
    <div>
        <div id = "food">
            <h2 id="title">Food</h2>
            <?php include 'connect.php';
            $query = $db ->query('SELECT * FROM food');
            echo '<table class="foodtable" >';

            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr><td>";
                echo $row['name'];
                echo "</td><td>";
                echo $row['description'];
                echo "</td><td>";
                echo $row['price'];
                echo "</td><td>";
                echo "<form action=\"FoodandDrink.php\" method=\"POST\">";
                echo "Select Quantity:<br>"; 
                echo "<select name=\"quantity\" id=\"quantity\">
                <option value=1>1</option>
                <option value=2>2</option>
                <option value=3>3</option>
                <option value=4>4</option>
                <option value=5>5</option>
                </select>";
                echo "<input type=\"hidden\" name=\"foodid\" value=\"".$row['ID']."\">";
                echo "</td><td>";
                echo "<input type=\"submit\" value=\"Add\" name=\"submit\">";
                echo "</form>";
            // echo "<a href=\"basket.php".$row['ID']."\">Add</a>";
                echo"</td></tr>";


            }
            echo "</table>";
            ?>
        </div>

        <div id = "drink">
            <h2 id = "title">Drink</h2>
            <?php include 'connect.php';
            $query = $db ->query('SELECT * FROM drink');
            echo "<table class = 'styled-table'>";

            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr><td>";
                echo $row['name'];
                echo "</td><td>";
                echo $row['description'];
                echo "</td><td>";
                echo $row['price'];
                echo "</td><td>";
                echo "<form action=\"FoodandDrink.php\" method=\"POST\">";
                echo "Select Quantity:<br>"; 
                echo "<select name=\"quantity\" id=\"quantity\">
                <option value=1>1</option>
                <option value=2>2</option>
                <option value=3>3</option>
                <option value=4>4</option>
                <option value=5>5</option>
                </select>";
                echo "<input type=\"hidden\" name=\"drinkid\" value=\"".$row['ID']."\">";
                echo "</td><td>";
                //echo "<a href=\"basket.php".$row['ID']."\">Add</a>";
                echo "<input type=\"submit\" value=\"Add\" name=\"submit\">";
                echo "</form>";
                echo"</td></tr>";

                
                //echo "<a href=\"booking.php?ID=".$row['ID']."\">Book Here</a>";
            }
            echo "</table>";
            ?>
            
            
        </div>
        
    </div>
   
</body>
</html>