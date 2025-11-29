<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "nsapool";

try {
    // Connexion à la base avec PDO
    $dsn = "mysql:host=$servername;dbname=$dbname;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    $pdo = new PDO($dsn, $username, $password, $options);

    // Requête SQL
    $stmt = $pdo->query("SELECT id, username FROM user");

    if ($stmt->rowCount() > 0) {
        foreach ($stmt as $row) {
            echo "id: {$row['id']} - Name: {$row['username']}<br>";
        }
    } else {
        echo "0 results";
    }

} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
