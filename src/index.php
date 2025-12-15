<?php
echo "<h1>🌍 App web en Render + PostgreSQL</h1>";

$url = getenv("DATABASE_URL");

if (!$url) {
    die("<p style='color:red'>DATABASE_URL no definida</p>");
}

$db = parse_url($url);

$dsn = "pgsql:host={$db['host']};port={$db['port']};dbname=" . ltrim($db['path'], '/');

try {
    $pdo = new PDO($dsn, $db['user'], $db['pass'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    echo "<p style='color:green'>✅ Conectado a PostgreSQL</p>";

    // Crear tabla si no existe
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS mensajes (
            id SERIAL PRIMARY KEY,
            texto VARCHAR(255)
        )
    ");

    // Insertar datos si está vacía
    $count = $pdo->query("SELECT COUNT(*) FROM mensajes")->fetchColumn();
    if ($count == 0) {
        $pdo->exec("
            INSERT INTO mensajes (texto) VALUES
            ('Hola desde PostgreSQL'),
            ('Render funciona'),
            ('2DAW3 en producción 🚀')
        ");
    }

    // Mostrar datos
    echo "<h2>Mensajes:</h2>";
    foreach ($pdo->query("SELECT texto FROM mensajes") as $row) {
        echo "<p>• {$row['texto']}</p>";
    }

} catch (Exception $e) {
    echo "<p style='color:red'>❌ Error: {$e->getMessage()}</p>";
}
