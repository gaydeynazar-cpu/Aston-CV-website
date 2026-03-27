<?php
include("config/db.php");
session_start();
?>

<html>
<head>
    <link rel="stylesheet" type = "text/css" href="style/style.css">
    <link rel="icon" href="images/social media/Parallelogram.ico" type="image/x-icon"/>
</head>

<body>

<header>
    <h1>AstonCV</h1>
    <br>
</header><br><br>
<h2>Login</h2>

<section id = "button">
    <a href="index.php">
    <button>Home</button></a>
    <a href="cvs.php">
    <button>CVs</button></a>
    <a href="search.php">
    <button>Search</button></a>
    <a href="register.php">
    <button>Register</button></a>
    <a href="login.php">
    <button>Login</button></a>
    <a href="update_cv.php">
    <button>Update CV</button></a>
    <a href="logout.php">
    <button>Logout</button></a>
</section><br><br>

<form method="POST">

<label>Name: </label><br> 
<input type="name" name="name" required><br><br>

<label>Password: </label><br> 
<input type="password" name="password" required><br><br>

<button type="submit">Login</button>

</form>

<?php

if($_POST){

    $name = $_POST['name'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM cvs WHERE name=?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = mysqli_fetch_assoc($result);
    // Verify the password using password_verify() function
    if($row && password_verify($password, $row['password'])){
        
        $_SESSION['user'] = $row['id'];
        echo "<script>alert('Login successful'); window.location.href='index.php';</script>";

    } else {
        echo "<script>alert('Invalid name or password');</script>";
    }

}

?>
</body>
</html>