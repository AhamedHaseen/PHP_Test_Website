<?php

$db_user = "root";
$db_password = "";
$db_name = "useraccounts";
// Create a new PDO instance
try {
    $db = new PDO("mysql:host=localhost;dbname=" . $db_name, $db_user, $db_password);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>