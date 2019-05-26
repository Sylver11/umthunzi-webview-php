<?php
session_start();
require_once "conn.php";
$sql ="CREATE TABLE vegetables(
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    pin INT,
    name VARCHAR(120),
    vegetable VARCHAR(255),
    quantity VARCHAR(255),
    date VARCHAR(60))";
//passing the query to the established connection 
$conn->query($sql);
// if(empty(trim($_POST["val"]))){
//     $username_err = "Please enter something you need to do.";
//     echo $username_err;
// } else {
    $date= date('d/m/Y');
    $quality = trim($_POST["quality"]);
    $quantity= trim($_POST["quantity"]);
    // $name = $_SESSION["name"];
    // $pin = $_SESSION["pin"];
    $pin = 1111;
    $name = "Justus Voigt";
    $sql2 ="INSERT INTO vegetables (pin , name, vegetable, quantity, date) VALUES (?,?,?,?,?)";
    $stmt = $conn->prepare($sql2);
    $stmt->bind_param("issss", $param_pin, $param_name, $param_vegetable, $param_quantity, $param_date);
    $param_quantity=$quantity;
    $param_date=$date;
    $param_vegetable=$quality;
    $param_name = $name;
    $param_pin= $pin;
    $stmt->execute();
// }   
?>