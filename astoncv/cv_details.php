<?php

include("config/db.php");
// Start the session to access session variables
$id = isset($_GET['id']) ? intval($_GET['id']) : null;

if (!$id) {
    die("Invalid ID");
}

$stmt = $conn->prepare("SELECT * FROM cvs WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = mysqli_fetch_assoc($result);

?>

<html>
<head>
    <link rel="stylesheet" type = "text/css" href="style/style.css">
    <link rel="icon" href="images/social media/Parallelogram.ico" type="image/x-icon"/>
</head>

<header>
    <h1>AstonCV</h1>
    <br>
</header><br><br>

<h2>CV Details</h2>

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
<!-- Display CV details -->
<h2><?php echo htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8'); ?></h2>

<p>Email: <?php echo htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8'); ?></p>

<p>Programming: <?php echo htmlspecialchars($row['keyprogramming'], ENT_QUOTES, 'UTF-8'); ?></p>

<p>Profile: <?php echo htmlspecialchars($row['profile'], ENT_QUOTES, 'UTF-8'); ?></p>

<p>Education: <?php echo htmlspecialchars($row['education'], ENT_QUOTES, 'UTF-8'); ?></p>

<p>Links: <?php echo htmlspecialchars($row['URLlinks'], ENT_QUOTES, 'UTF-8'); ?></p>

</body>
</html>