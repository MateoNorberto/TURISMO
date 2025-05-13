<?php
// Mostrar errores (solo en desarrollo)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Validar si el formulario fue enviado correctamente
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['nombre'], $_POST['email'], $_POST['mensaje'])) {

    // 1. Conectar a la base de datos SQLite
    $db = new SQLite3('norbert.db');

    // 2. Crear tabla si no existe
    $db->exec("CREATE TABLE IF NOT EXISTS mensajes (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        nombre TEXT NOT NULL,
        email TEXT NOT NULL,
        mensaje TEXT NOT NULL,
        fecha DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    // 3. Obtener los datos del formulario de forma segura
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $mensaje = $_POST['mensaje'];

    // 4. Insertar datos en la base de datos
    $stmt = $db->prepare("INSERT INTO mensajes (nombre, email, mensaje) VALUES (:nombre, :email, :mensaje)");
    $stmt->bindValue(':nombre', $nombre, SQLITE3_TEXT);
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $stmt->bindValue(':mensaje', $mensaje, SQLITE3_TEXT);
    $result = $stmt->execute();

    // 5. Confirmación
    if ($result) {
        echo "Mensaje enviado correctamente.";
    } else {
        echo "Error al enviar el mensaje.";
    }
} else {
    echo "No se enviaron datos válidos.";
}
?>
