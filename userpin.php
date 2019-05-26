<?php
session_start();
require_once "conn.php";

$sql2 ="CREATE TABLE umthunzi_farmer(
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    pin INT,
    name VARCHAR(120),
    phone VARCHAR(255),
    performance VARCHAR(255))";

$conn->query($sql2);



$param_pin = $_POST['userPin'];
// $param_pin = 1111;
$sql = "SELECT * FROM umthunzi_farmer WHERE pin='$param_pin'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_row()){
        $_SESSION['name'] = $row[2];
        $name = array('name' => $_SESSION["name"]);
        echo json_encode($name);
    }
}
else{
    $name = array('name' => "your PIN is incorrect.");
        echo json_encode($name);
}

?>