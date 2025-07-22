<?php
session_start();
require 'usuarios.php'; // Importar lista de usuarios y hashes

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["username"] ?? '';
    $clave = $_POST["password"] ?? '';

    if (isset($usuarios[$usuario])) {
        if (password_verify($clave, $usuarios[$usuario])) {
            echo "<h2>Bienvenido, $usuario</h2>";
            // Puedes hacer: $_SESSION["usuario"] = $usuario;
        } else {
            echo "<p style='color:red;'>Contraseña incorrecta.</p>";
        }
    } else {
        echo "<p style='color:red;'>Usuario no permitido.</p>";
    }
} else {
    echo "Acceso no válido.";
}
?>