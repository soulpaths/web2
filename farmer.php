<?php
session_start();
require_once 'database_connect.php';

if(isset($_POST['profile-submit'])){
    $username = $_POST['username'];
    $profile = $_POST['profile'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $area = $_POST['area'];

    $sql = "INSERT INTO farmer (username, profile, phone, address, area) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiss", $username, $profile, $phone, $address, $area);

    if($stmt->execute()){
        $_SESSION['success'] = "Farmer profile saved successfully!";
        header('location: index.php');
    }else{
        $_SESSION['error'] = "Error in saving farmer profile";
        header('location: index.php');
    }
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmer Registration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="text-center">Farmer Registration</h2>
        <form action="farmer.php" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="profile">Profile:</label>
                <textarea class="form-control" id="profile" name="profile" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="area">Area:</label>
                <input type="text" class="form-control" id="area" name="area" required>
            </div>
            <input type="submit" class="btn btn-primary" name="profile-submit" value="Submit">
        </form>
    </div>
</body>
</html>