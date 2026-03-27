<?php
// Setting up the connection to the database in the aston server
$conn = mysqli_connect("localhost","dg250055933","aqQlgq9cpKaHgH90GrhsbMz2k","dg250055933_banking");

if(!$conn){
    die("Database connection failed");
}

?>