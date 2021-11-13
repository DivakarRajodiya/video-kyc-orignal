<?php
$servername = 'localhost';
$database = 'vidkyc';
$username = 'root';
$password = '#xJhC@Uf^X2k8*!9fvV';
$charset = 'utf8mb4';
$dbPrefix = 'lsv_';
$pasPhrase = '';
$setVal = 'ZFNwlwZ49rERoFLxqLdagFMQcNO71yHiaaelJHcKBXE=';


$dsn = "mysql:host=$servername;dbname=$database;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $pdo = new PDO($dsn, $username, $password, $options);
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}