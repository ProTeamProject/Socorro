<?php
$servername = "localhost";
$username = "root";
$password = "root";

try {
    $con = new PDO("mysql:host=$servername;dbname=sc-web", $username, $password);
    // set the PDO error mode to exception
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    }
?>
