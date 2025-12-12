<?php

$host = getenv('MYSQL_HOST');
$db   = getenv('MYSQL_DATABASE');
$user = getenv('MYSQL_USER');
$pass = getenv('MYSQL_PASSWORD');
$port = getenv('MYSQL_PORT');

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Error de conexión");
}

$stmt = $pdo->query("SELECT * FROM mensajes");

echo "<h2>Mensajes desde la base de datos</h2>";

while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<p>{$fila['texto']}</p>";
}
