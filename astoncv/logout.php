<?php
include("config/db.php");
session_start();
// check if user is logged in
// If the user is not logged in, show an alert and redirect to the homepage
if (!isset($_SESSION['user'])) {
    echo "<script>alert('You are not logged in'); window.location.href='index.php';</script>";
// If the user is logged in, destroy the session to log them out
// and redirect to the homepage with a success message
} else {
    session_destroy();
    echo "<script>alert('Logout successful'); window.location.href='index.php';</script>";
}
?>