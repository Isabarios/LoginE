<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Login Seguro</title>
  <style>
    body {
      font-family: Arial;
      background-color: #f3f3f3;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .form-container {
      background-color: white;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0px 0px 10px #ccc;
      width: 300px;
    }

    input[type="text"], input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    button {
      width: 100%;
      padding: 10px;
      background-color: #3498db;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    button:hover {
      background-color: #2980b9;
    }

    .error {
      color: red;
      font-size: 0.9em;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Iniciar Sesión</h2>
    <form action="login.php" method="POST" onsubmit="return validarFormulario();">
      <input type="text" name="username" id="username" placeholder="Usuario" required>
      <input type="password" name="password" id="password" placeholder="Contraseña" required>
      <div id="error" class="error"></div>
      <button type="submit">Entrar</button>
    </form>
  </div>

  <script>
    function validarFormulario() {
      const usuario = document.getElementById('username').value.trim();
      const contraseña = document.getElementById('password').value.trim();
      const errorDiv = document.getElementById('error');
      const permitidos = ['Administrador', 'usuario1', 'usuario2', 'usuario3'];

      if (!permitidos.includes(usuario)) {
        errorDiv.textContent = "Usuario no permitido.";
        return false;
      }

      if (contraseña.length < 6) {
        errorDiv.textContent = "La contraseña debe tener al menos 6 caracteres.";
        return false;
      }

      return true;
    }
  </script>
</body>
</html>
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