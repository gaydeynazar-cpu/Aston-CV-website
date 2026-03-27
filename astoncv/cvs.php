<?php include("config/db.php"); ?>

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
<h2>CVs</h2>

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

<table border="1">

<tr>
<th>Name</th>
<th>Email</th>
<th>Programming</th>
<th>View</th>
</tr>

<?php
// Fetch all CVs from the database
$sql = "SELECT * FROM cvs";
$result = mysqli_query($conn,$sql);
// Loop through each CV and display in the table
while($row = mysqli_fetch_assoc($result)){

echo "<tr>";
echo "<td>".htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8')."</td>";
echo "<td>".htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8')."</td>";
echo "<td>".htmlspecialchars($row['keyprogramming'], ENT_QUOTES, 'UTF-8')."</td>";
echo "<td><a href='cv_details.php?id=".intval($row['id'])."'>View</a></td>";
echo "</tr>";

}

?>

</table>

</body>
</html>