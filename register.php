
<?php 
session_start();

if(isset($_SESSION["username"])){
    header("Location:content.php");
}
include("connect.php");
$usename = $password = $email = "";
$admin = 0;
$errors = array("usename"=>"","password"=>"","email"=>"");

if(isset($_POST["submit"])){
    //echo htmlspecialchars($_POST["usename"]);
    //echo htmlspecialchars($_POST["password"]);
    //echo htmlspecialchars($_POST["email"]);

    if (empty($_POST["email"])){
        $errors["email"] = "Email is empty.<br>";
    }else{
        $email = $_POST["email"];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors["email"] = "Email is invalid.<br>";
        }
    }
    if (empty($_POST["usename"])){
        $errors["usename"] = "Usename is empty.<br>";
    }
    if (empty($_POST["password"])){
        $errors["password"] = "Password is empty.<br>";
    }
    if(array_filter($errors)){
        echo "ERRORS in FORM";
    }else{
        $usename = mysqli_real_escape_string( $conn , $_POST["usename"]);
        $password = mysqli_real_escape_string( $conn , $_POST["password"]);
        $hashed_password = MD5($password);
        $email = mysqli_real_escape_string( $conn , $_POST["email"]);

        $sql = "INSERT INTO users (Username , Password , Email , Admin) VALUES ('$usename','$hashed_password','$email','$admin')";
        //put in database
        if(mysqli_query($conn, $sql)){
            session_start();
            $_SESSION["username"] = $usename;
            header("Location:films.php");
        }else{
            echo "Error".mysqli_error( $conn );
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

<div class = "Register-background">

    <div>
        <a id = "Register-Logo"><img href = "TPR Logo" src = "TPR Logo 2.png" height = "125px" ></a>
    </div>
    
        
    <h1>The Projection Room</h1>

    <h2>Register Here</h2>
    <div>
        <form method = "POST" action = "register.php">
            <p>
                <label>Username:</label>
                <input name = "usename" type= "text">
            </p>
            <p>
                <label>Password:</label>
                <input name = "password" type= "password">
            </p>
            <p>
                <label>Email:</label>
                <input name = "email" type= "text">
            </p>
            <p>
            <input name = "submit" type= "submit" value = "Submit">
            </p>
            
        </form>
        <br>
        <h5>Already have an account?</h5>
        <button><a id = "register" href = "index.php"> Log in</a></button><br>

    </div>
</div>