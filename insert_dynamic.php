<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_register";
$firstname = filter_var($_POST['fname']);
$lastname = filter_var($_POST['lname']);
$email = filter_var($_POST['email']);
$pass = $_POST['pass']; 

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, pass) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $firstname, $lastname, $email, $pass);

$pass = password_hash($pass, PASSWORD_DEFAULT); 

// Execute
if ($stmt->execute()) {
    echo "New user created successfully";
} else {
    echo "Error creating user: " . $stmt->error;
}
$stmt->close();
$conn->close();
?>