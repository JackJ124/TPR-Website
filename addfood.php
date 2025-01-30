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
        header("Location:FoodandDrink.php");
   }

    $Name = $Description = $Price = "";
    $errors = array('name'=>'','description'=>'','price'=>'');
    $errorflag=0;

    if(isset($_POST['submit'])){

        if(empty($_POST['Name'])){
            $errors['name'] = "Name is empty.<br>";
            $errorflag= 1;
        }
        if(empty($_POST['Description'])){
            $errors['description'] = "Description is empty.<br>";
            $errorflag= 1;
        }
        if(empty($_POST['Price'])){
            $errors['price'] = "Price is empty.<br>";
            $errorflag= 1;
        }


            if($errorflag == 1){
                echo "";
                

        } else{
            $Name = mysqli_real_escape_string($conn,$_POST['Name']);
            $Description = mysqli_real_escape_string($conn,$_POST['Description']);
            $Price = mysqli_real_escape_string($conn,$_POST['Price']);
            $sql = "INSERT into food (name, description, price) VALUES ('$Name', '$Description', '$Price')";

            if(mysqli_query($conn, $sql)){
                header("Location:admin.php");
        }else{
            echo"Query Error".mysqli_error($conn);
        }
    }
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
        <h3>Welcome <?php echo $_SESSION['username']; ?> <br> 
        Add a New Food!<br>
        <a id="ddd" href = "logout.php"> Logout Here</a><br></h3>
    </div>

    <div>
        <form action = "addfood.php" method = "POST">
            <label>Food Name :</label>
            <input type="text" name = "Name" value = "<?php echo htmlspecialchars($Name); ?>"><br>
            <?php echo $errors['name']; ?> <br>
            <label>Description :</label>
            <input type="text" name = "Description" value = "<?php echo htmlspecialchars($Description); ?>"><br>
            <?php echo $errors['description']; ?> <br>
            <label>Price :</label>
            <input type="text" name = "Price" value = "<?php echo htmlspecialchars($Price); ?>"><br>
            <?php echo $errors['price']; ?> <br>
            <input type = "submit" value = "submit" name = "submit">
        </form>

    </div>
</body>
</html>

