<?php
$secrets = require __DIR__ . '/secrets.php';

$db_host = "mysql111.unoeuro.com";
$db_user = "onepieceisreal_dk";
$db_pass = $secrets['db_pass'];
$db_name = "onepieceisreal_dk";
$charset = "utf8mb4";

$dsn = "mysql:host=$db_host;dbname=$db_name;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $options);
} catch (\PDOException $e) {
    die("Fejl ved forbindelse til databasen: " . $e->getMessage());
}
?>