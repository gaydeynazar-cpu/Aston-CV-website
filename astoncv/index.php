<!-- Setting the connection to the database -->
<?php include("config/db.php"); ?>
<html>
    <head>
        <link rel="icon" href="images/social media/Parallelogram.ico" type="image/x-icon"/>
        <link rel="stylesheet" type = "text/css" href="style/style.css">
    </head>
    <header>
        <h1>AstonCV</h1>
        <br>
    </header><br><br>

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
    </section>

    <h2>Welcome</h2>
<?php
    // This changes the appearance of the homepage based on whether the user is logged in or not
    session_start();
    $sql = "SELECT name FROM cvs";
    $result = mysqli_query($conn,$sql);
    if(!isset($_SESSION['user'])){
        echo "<p>Welcome, login to gain access to your CV</p>";
    // if the user is logged in, it welcomes them by name and gives them access to their CV
    }else{
        $row = mysqli_fetch_assoc($result);
        echo "<p>Welcome " . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . ", you are logged in and have access to your CV</p>";
    }
?>
    </body>
</html>