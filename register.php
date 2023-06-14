<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "base_caso";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recuperar datos del formulario de registro
$username = $_POST["username"];
$password = $_POST["password"];
$confirmPassword = $_POST["confirm_password"];

// Verificar si el nombre de usuario ya existe en la base de datos
$sql = "SELECT * FROM usuarios WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "Error: El nombre de usuario ya está en uso.";
} elseif ($password !== $confirmPassword) {
    echo "Error: Las contraseñas no coinciden.";
} else {
    // Insertar el nuevo usuario en la base de datos
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (username, password) VALUES ('$username', '$hashedPassword')";
    if ($conn->query($sql) === true) {
        echo "Registro exitoso. Por favor, inicia sesión.";
        echo '<br><br><a href="index.html">Volver al inicio</a>'; // Agregamos el enlace para regresar a index.html
    } else {
        echo "Error en el registro: " . $conn->error;
    }
}

$conn->close();
?>
