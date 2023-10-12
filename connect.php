<?php
// Modify these settings to match your database server configuration
$db_host = 'localhost';
$db_name = 'iudigital_libreria';
$db_user = 'root';
$db_pass = 'gaXKW^9,o$Y^p>b`';

try {
    $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
