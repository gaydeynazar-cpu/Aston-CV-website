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
    <body>
</html>
<?php
session_start();
include("config/db.php");

// check if user is logged in 
if(!isset($_SESSION['user'])){
    echo "You must login first.";
    exit();
}

$id = $_SESSION['user'];

// update CV when form submitted 
if($_POST){

// Validate input lengths
if (strlen($_POST['keyprogramming']) > 50) {
    echo "<script>alert('Programming language must not exceed 50 characters');</script>";
} else if (strlen($_POST['profile']) > 2000) {
    echo "<script>alert('Profile must not exceed 2000 characters');</script>";
} else if (strlen($_POST['education']) > 2000) {
    echo "<script>alert('Education must not exceed 2000 characters');</script>";
} else if (strlen($_POST['URLlinks']) > 500) {
    echo "<script>alert('Links must not exceed 500 characters');</script>";
} else {
    // If validation passes, proceed with updating the CV
    $keyprogramming = $_POST['keyprogramming'];
    $profile = $_POST['profile'];
    $education = $_POST['education'];
    $URLlinks = $_POST['URLlinks'];

    $stmt = $conn->prepare("UPDATE cvs SET keyprogramming=?, profile=?, education=?, URLlinks=? WHERE id=?");
    $stmt->bind_param("ssssi", $keyprogramming, $profile, $education, $URLlinks, $id);
    // Execute the statement and check for success
    if ($stmt->execute()) {
        echo "<p style='color: green; font-weight: bold;'>CV Updated Successfully!</p>";
    } else {
        echo "<p style='color: red; font-weight: bold;'>Error updating CV. Please try again.</p>";
    }
}
}

// get current CV data, it also handles injections
$stmt = $conn->prepare("SELECT * FROM cvs WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>


<body>

<!-- Display the form with current CV data pre-filled -->
<form method="POST">

<label>Key Programming Language (max 50 characters): </label><br>
<input type="text" name="keyprogramming" required maxlength="50"
value="<?php echo htmlspecialchars($row['keyprogramming'], ENT_QUOTES, 'UTF-8'); ?>"><br><br>

<label>Profile (max 2000 characters): </label><br>
<textarea name="profile" rows="8" cols="50" maxlength="2000"><?php echo htmlspecialchars($row['profile'], ENT_QUOTES, 'UTF-8'); ?></textarea><br><br>

<label>Education (max 2000 characters): </label><br>
<textarea name="education" rows="8" cols="50" maxlength="2000"><?php echo htmlspecialchars($row['education'], ENT_QUOTES, 'UTF-8'); ?></textarea><br><br>

<label>Links (GitHub / LinkedIn) (max 500 characters): </label><br>
<input type="text" id="URLlinks" name="URLlinks" maxlength="500"
value="<?php echo htmlspecialchars($row['URLlinks'], ENT_QUOTES, 'UTF-8'); ?>"><br><br>

<button type="submit">Update CV</button>

</form>

<button type="submit">Update CV</button>

</form>

</body>
</html>