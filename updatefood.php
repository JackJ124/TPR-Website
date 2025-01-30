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
   $Name = $Description = $Price = "";
   $errors = array('Name'=>'','Description'=>'','Price'=>'');
   $errorflag = 0;

   if((!isset($_GET['ID'])) && (!isset($_POST['ID'])) ){
    header("location:admin.php");
   }
   else if (isset($_GET['ID'])) {
    $ID = $_GET['ID'];
    $query = $db->prepare("SELECT * FROM food WHERE ID=?");
    $query->execute(array($ID));
    $control = $query->fetch(PDO::FETCH_ASSOC);
    $Name = $control['name'];
    $Description = $control['description'];
    $Price=$control['price'];
   }

   if(isset($_POST['submit'])){

        $ID = $_POST['ID'];

        if(empty($_POST['Name'])){
            $errors['Name'] = "Name is empty.<br>";
            $errorflag = 1;
        }
        if(empty($_POST['Description'])){
            $errors['Description'] = "Description is empty.<br>";
            $errorflag = 1;
        }
        if(empty($_POST['Price'])){
            $errors['Price'] = "Price is empty.<br>";
            $errorflag = 1;
        }


        if($errorflag == 1){
            echo "Errors in Form";

        }
        else{
            $Name = mysqli_real_escape_string($conn,$_POST['Name']);
            $Description = mysqli_real_escape_string($conn,$_POST['Description']);
            $Price = mysqli_real_escape_string($conn,$_POST['Price']);
            $sql = "UPDATE food SET Name = '$Name', Description = '$Description', Price = '$Price' WHERE ID = '$ID'";

    if(mysqli_query($conn, $sql)) {
                header("Location:admin.php");
            }else{
                echo "Query Error".mysqli_error($conn);
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
        <h4>Welcome <?php echo $_SESSION['username']; ?> <br> 
        Update Record Here<br>
        <a href = "logout.php"> Logout Here</a><br></h4>
    </div>

    <div>
        <form action = "updatefood.php" method = "POST" >
            <input type = "hidden" name = "ID" value = "<?php echo $ID; ?>">
            <label>Food Name:</label>
            <input type="text" name = "Name" value = "<?php echo htmlspecialchars($Name);?>"><br>
            <div><?php echo $errors['Name']; ?></div>
            <label>Food Description:</label>
            <input class = "CCPPDisplayTD" type="text" name = "Description" value = "<?php echo htmlspecialchars($Description);?>"><br>
            <div><?php echo $errors['Name']; ?></div>
            <label>Price:</label>
            <input class = "CCPPDisplayTD" type="text" name = "Price" value = "<?php echo htmlspecialchars($Price);?>"><br>
            <div><?php echo $errors['Name']; ?></div>
            <input type = "submit" name = "submit" value = "submit">
        </form>
    </div>

</body>
</html>