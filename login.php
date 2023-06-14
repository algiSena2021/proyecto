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

// Recuperar datos del formulario de inicio de sesión
$username = $_POST["username"];
$password = $_POST["password"];

// Verificar las credenciales de inicio de sesión en la base de datos
$sql = "SELECT * FROM usuarios WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $hashedPassword = $row["password"];
    if (password_verify($password, $hashedPassword)) {
        echo "Inicio de sesión exitoso. ¡Bienvenido!";
        echo '<br><br><a href="index.html">Salir</a>'; // Agregamos el enlace para salir a index.html
    } else {
        echo "Error: Contraseña incorrecta.";
        echo '<br><br><a href="index.html">Volver</a>'; // Agregamos el enlace para volver a index.html
    }
} else {
    echo "Error: Nombre de usuario no encontrado.";
    echo '<br><br><a href="index.html">Volver</a>'; // Agregamos el enlace para volver a index.html
}

$conn->close();
?>
