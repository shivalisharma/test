<?php
ob_start();
$user = "impinge";
$pass = "admin";
try {
$dbh = new PDO('mysql:host=localhost;dbname=pdonew', $user, $pass);
}
catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>

