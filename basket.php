<?php
session_start();
if(!isset($_SESSION['username'])) {
    header("location:index.php");
}

if(isset($_POST['empty'])) {
    include 'connect.php';
    $sql = "DELETE FROM basket";
    if(mysqli_query($conn, $sql)) {
        header("Location:basket.php");
    } else {
        echo 'Query Error'.mysqli_error($conn);
}

}

if(isset($_POST['update'])) {
    include 'connect.php';
    $Quantity = $_POST['quantity'];
    $ID = $_POST['ID'];
    $sql = "UPDATE basket SET quantity = '$Quantity' WHERE ID = '$ID'";
    if(mysqli_query($conn, $sql)) {
        header("Location:basket.php");
    } else {
        echo 'Query Error'.mysqli_error($conn);
}

}

if(isset($_POST['delete'])) {
    include 'connect.php';
    $ID = $_POST['ID'];
    $sql = "DELETE FROM basket WHERE ID = :ID";
    $stmt = $db->prepare($sql);
    $stmt->execute(['ID' => $ID]);

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
        <a class = "active"href = "basket.php">Basket</a>
        <a href="admin.php">Admin</a>
        </div>
        <div class="nav-right">
        <a href="content.php">Log in</a>
        <a href="register.php">Register</a>
        <a href = "logout.php"> Logout</a>
        </div>
      
    </nav>



<div>
    <div>
        <div id = "basket">
        <?php include 'connect.php';
            
            echo "<table>";
            echo "<tr><td>";
            echo "Product Name";
            echo "</td><td>";
            echo "Quantity";
            echo "</td><td>";
            echo "Update Quantity";
            echo "</td><td>";
            echo "Delete Item";
            echo "</td></tr>";
            $query = $db->query("SELECT * FROM basket");
            while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $query2 = $db->prepare("SELECT * FROM food  WHERE ID=?");
                $query2->execute(array($row['foodid']));
                $food=$query2->fetch(PDO::FETCH_ASSOC);

                $query3 = $db->prepare("SELECT * FROM drink  WHERE ID=?");
                $query3->execute(array($row['drinkid']));
                $drink=$query3->fetch(PDO::FETCH_ASSOC);

                echo "<tr><td>";
                if($row['foodid'] >= 1){
                    echo $food['name'];
                }
                else if($row['drinkid'] >= 1) {
                    echo $drink['name'];
                }
                echo "</td><td>";
                echo "<form action=\"basket.php\" method=\"POST\">";
                echo "<br><select name=\"quantity\" id=\"quantity\">
                <option value=1";
                if ($row['quantity'] == 1) {
                    echo " selected";
                }
                echo ">1</option>
                <option value=2";
                if ($row['quantity'] == 2) {
                    echo " selected";
                }
                echo ">2</option>
                <option value=3";
                if ($row['quantity'] == 3) {
                    echo " selected";
                }
                echo ">3</option>
                <option value=4";
                if ($row['quantity'] == 4) {
                    echo " selected";
                }
                echo ">4</option>
                <option value=5";
                if ($row['quantity'] == 5) {
                    echo " selected";
                }
                echo ">5</option>
            </select>";
                echo "</td><td>";
                echo "<input type=\"hidden\" name=\"ID\" value=\"".$row['ID']."\">";
                echo "<input type=\"submit\" name=\"update\" value=\"Update\">";
                echo "</form>";
                echo "</td><td>";
                echo "<br><form action=\"basket.php\" method=\"POST\">";
                echo "<input type=\"hidden\" name=\"ID\" value=\"".$row['ID']."\">";
                echo "<input type=\"submit\" name=\"delete\" value=\"Delete\">";
                echo "</form>";
            }
            echo "</table>";
            echo "<form action=\"basket.php\" method=\"POST\">";
            echo "<input type=\"submit\" name=\"empty\" value=\"Empty\">";
            echo "</form>";

            ?>

            <a href="FoodandDrink.php">Add new food.</a><br>
            <a href="films.php">View Films</a>

            
            
        </div>
    </div>
</div>
</body>
</html>