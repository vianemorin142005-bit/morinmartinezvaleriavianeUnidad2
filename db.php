<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$host = "sql208.infinityfree.com";   
$dbname = "if0_42125954_onlinestore";        
$username = "if0_42125954";             
$password = "oLjEanOxov";         

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

  
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 

} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

?>