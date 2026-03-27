<?php include("config/db.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type = "text/css" href="style/style.css">
    <link rel="icon" href="images/social media/Parallelogram.ico" type="image/x-icon"/>
</head>
<header>
    <h1>AstonCV</h1>
    <br>
</header><br><br>

<body>

<h2>Search CVs</h2>

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

<form method="GET">

<input type="text" name="q">&nbsp;&nbsp;

<button type="submit">Search</button>
<br><br>

</form>

<?php
// If a search query is provided, perform the search
if(isset($_GET['q'])){

$q = $_GET['q'];
$searchTerm = '%' . $q . '%';
// Use prepared statements to prevent SQL injection
$stmt = $conn->prepare("SELECT * FROM cvs WHERE name LIKE ? OR keyprogramming LIKE ?");
$stmt->bind_param("ss", $searchTerm, $searchTerm);
$stmt->execute();
$result = $stmt->get_result();
// If results are found, display them in the table. Otherwise, show a message indicating no results
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){

    echo "<tr>";
    echo "<td>".htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8')."</td>";
    echo "<td>".htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8')."</td>";
    echo "<td>".htmlspecialchars($row['keyprogramming'], ENT_QUOTES, 'UTF-8')."</td>";
    echo "<td><a href='cv_details.php?id=".intval($row['id'])."'>View</a></td>";
    echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No CVs found matching your search.</td></tr>";
}

}

?>
</table>
</body>
</html>