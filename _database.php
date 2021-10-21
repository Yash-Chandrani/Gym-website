<?php
$server = "127.0.0.1:3307";
$username = "root";
$password = "";
$db = "gym_site";
$con = mysqli_connect($server, $username, $password, $db);

if (!$con) {
    die("connection to database failed due to" . mysqli_connect_error());
}
// echo "Success connection to the database";

?>
