<?php
require __DIR__ . '/../src/funciones.php';

function assertEqual($esperado, $actual, $mensaje) {
    if ($esperado !== $actual) {
        echo "❌ $mensaje\n";
        exit(1);
    }
    echo "✅ $mensaje\n";
}

assertEqual(5, suma(2, 3), "suma funciona");
assertEqual(true, esPar(4), "4 es par");
assertEqual(false, esPar(3), "3 no es par");

echo "🎉 Todos los tests pasan\n";
