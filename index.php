<?php session_start();
include "connect.php";
if(isset($_POST['login'])) {
    if($_POST["username"] == "" or $_POST["password"] =="") {
      echo("Your username and password is required") ;
    }
    else{
        $username = strip_tags(trim($_POST['username']));
        $password = strip_tags(trim($_POST['password']));
        $hash = MD5($password);
        $query = $db->prepare("SELECT * FROM users WHERE Username = ?");
        $query->execute(array($username));
        $control = $query->fetch(PDO::FETCH_ASSOC);
        if($control>0 && ($hash == $control["Password"])) {
            session_start();
            $_SESSION["username"] = $username;
            header("Location:content.php");
    }
        else   {
            echo "<center><h1>Incorrect User or Pass</h1></center>";
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
<div class = "Sign-In-Background">

    <div>
        <a id = "Sign-In-Logo"><img href = "TPR Logo" src = "TPR Logo 2.png" height = "125px" ></a>
    </div>
        
    <h1>The Projection Room</h1>
    
    
    

    <h3>Sign in</h3>
    <div>
        <form method = "POST" action = "index.php">
            <p>
                <label>Username</label>
                <input name = "username" type= "text">
            </p>
            <p>
                <label>Password</label>
                <input name = "password" type= "password">
            </p>
            <button type = "submit" name = "login">Login</button>
        </form>
        <br>
        <br>
        <h5>Don't Have an Account?</h5>
        <button><a id = "register" href = "register.php"> Register Here</a></button><br>
    </div>
</div> 
    
</body>
</html>