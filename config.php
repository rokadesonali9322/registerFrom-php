<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'register-Form';
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    echo 'Connection failed' . mysqli_connet_error();
}
?>
