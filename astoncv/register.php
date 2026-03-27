<?php include("config/db.php"); ?>

<html>
<head>
    <link rel="stylesheet" type = "text/css" href="style/style.css">
    <link rel="icon" href="images/social media/Parallelogram.ico" type="image/x-icon"/>
</head>
<header>
    <h1>AstonCV</h1>
    <br>
</header><br><br>

<h2>Register</h2>

<body>

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

<!-- Creating a form -->
<form method="POST">

<label>Name (2-100 characters): </label><br>
<input type="text" name="name" required minlength="2" maxlength="100"><br><br>

<label>Email (max 120 characters): </label><br>
<input type="email" name="email" required maxlength="120"><br><br>

<label>Password (min 6 characters): </label><br>
<input type="password" name="password" required minlength="6" maxlength="100"><br><br>

<label>Confirm Password (min 6 characters): </label><br>
<input type="password" name="confirm_password" required minlength="6" maxlength="100"><br><br>

<label>Key Programming Language (max 50 characters): </label><br>
<input type="text" name="keyprogramming" required maxlength="50"><br><br>

<button type="submit">Register</button>

</form>

<?php

if($_POST){
// Validate input lengths and formats
if (empty($_POST['name']) || strlen($_POST['name']) < 2 || strlen($_POST['name']) > 100) {
    echo "<script>alert('Name must be between 2 and 100 characters');</script>";
} else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('Invalid email format');</script>";
} else if (strlen($_POST['password']) < 6) {
    echo "<script>alert('Password must be at least 6 characters');</script>";
} else if ($_POST['password'] !== $_POST['confirm_password']) {
    echo "<script>alert('Passwords do not match. Please try again.');</script>";
} else if (empty($_POST['keyprogramming']) || strlen($_POST['keyprogramming']) > 50) {
    echo "<script>alert('Programming language is required and must not exceed 50 characters');</script>";
} else {
    $name = $_POST['name'];
    $email = $_POST['email'];
    
    // Check if email already exists
    $checkStmt = $conn->prepare("SELECT id FROM cvs WHERE email=?");
    $checkStmt->bind_param("s", $email);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();
    // If email already exists, show an error message. Otherwise, proceed with registration
    if ($checkResult->num_rows > 0) {
        echo "<script>alert('Email already registered. Please use a different email.');</script>";
    // If validation passes, proceed with registration
    } else {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $lang = $_POST['keyprogramming'];

        $stmt = $conn->prepare("INSERT INTO cvs(name,email,password,keyprogramming) VALUES(?,?,?,?)");
        $stmt->bind_param("ssss", $name, $email, $password, $lang);

        if ($stmt->execute()) {
            echo "<script>alert('Registration successful! You can now login.'); window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Registration failed. Please try again.');</script>";
        }
    }
}

}

?>

</body>
</html>