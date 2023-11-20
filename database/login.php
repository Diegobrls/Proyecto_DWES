<?php
// Crear una conexión a la base de datos
$conexion = mysqli_connect("db", "root", "", "proyecto_quiz");

// Comprobar si la conexión es exitosa
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Obtener los valores del formulario
$usuario = $_POST["nomUsu"];
$contraseña = $_POST["cont"];

// Crear una consulta SQL para buscar el usuario y la contraseña
$consulta = "SELECT * FROM usuario WHERE nomUsu = '$usuario' AND cont = '$contraseña'";

// Ejecutar la consulta SQL
$resultado = mysqli_query($conexion, $consulta);

// Comprobar si la consulta SQL devuelve algún resultado
if (mysqli_num_rows($resultado) > 0) {
    // El usuario y la contraseña son correctos
    header("Location: home.php");
} else {
    // El usuario y la contraseña son incorrectos
    echo "Usuario y/o contraseña incorrecto/s";
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>