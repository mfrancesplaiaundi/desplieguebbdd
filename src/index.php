<?php
var_dump(getenv('DATABASE_URL'));

$url = getenv('DATABASE_URL');

$db = parse_url($url);

$host = $db['host'];
$port = $db['port'];
$user = $db['user'];
$pass = $db['pass'];
$name = ltrim($db['path'], '/');

$dsn = "mysql:host=$host;port=$port;dbname=$name;charset=utf8";

try {
    $pdo = new PDO($dsn, $user, $pass);
    echo "<p>✅ Conectado a MySQL mediante DATABASE_URL</p>";
} catch (Exception $e) {
    die("❌ Error de conexión");
}

$stmt = $pdo->query("SELECT * FROM mensajes");

echo "<h2>Mensajes desde la base de datos</h2>";

while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<p>{$fila['texto']}</p>";
}
