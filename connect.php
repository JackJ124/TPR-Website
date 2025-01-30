<?php

$conn = mysqli_connect("localhost" ,"adminJack","password","cinema");

//prepared data objects
try {
    $db = new PDO("mysql:host=localhost;dbname=cinema;charset=utf8","adminJack", "password");

} catch (PDOException $e){
        echo $e->getMessage();
}
?>