<?php
session_start();
if (!isset($_SESSION["username"])){
    header("Location:login.php");
}           
else{
    include "connect.php";
    $username = $_SESSION["username"];
    $query = $db->prepare("SELECT * FROM users WHERE username = ?");
    $query->execute(array($username));
    $control= $query->fetch(PDO::FETCH_ASSOC);
    $userid = $control['ID'];

    $ID = $_GET['ID'];
    $query = $db->prepare("SELECT * FROM films WHERE ID =?");
    $query->execute(array($ID));
    $bookfilm = $query->fetch(PDO::FETCH_ASSOC);
    $filmid = $bookfilm['ID'];
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
    <div>
        <h4>
            Welcome <?php echo $_SESSION['username']; ?>
        </h4>
    </div>
    
    <h3 class = "left" id = "Bookings">You are Booking : </h3>
    <br><br><br><br><br><br>
    

    <div class = "center" id = "Table-Size">
        <?php 
            echo "<table>";
            echo"<tr><td>";
            echo $bookfilm['name'];
            echo "</td><td>";
            echo $bookfilm['description'];
            echo "</td><td>";
            echo "<form action=\"booking2.php\"action = \"POST\">";
            echo "No. of Tickets:";
            echo "<select name=\"tickets\"id =\"tickets\">
            <option value =1>1</option>
            <option value =2>2</option>
            <option value =3>3</option>
            <option value =4>4</option>
            <option value =5>5</option>
            </select>";
            echo "<input type=\"hidden\" id=\"userid\" name=\"userid\" value=\"".$userid."\">";
            echo "<input type=\"hidden\" id=\"filmid\" name=\"filmid\" value=\"".$filmid."\">";
            echo "<br><br>";
            echo "<input type =\"submit\" value =\"submit\" name=\"submit\" >";
            echo "</form>";
            echo"</td></tr>";
            echo "</table>";
    
        ?>
        
    </div>
</body>
</html>