<?php
// Crear una conexión a la base de datos
$conexion = mysqli_connect("db", "root", "", "proyecto_quiz");

// Comprobar si la conexión es exitosa
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Obtener los valores del formulario
$usuario = $_POST["nomUsu"] ?? "";
$contraseña = $_POST["cont"] ?? "";
$correo = $_POST["correo"] ?? "";

// Comprobar si la contraseña se repite correctamente
if ($_POST["cont"] !== $_POST["confirmarCont"]) {
    die("Las contraseñas no coinciden");
}

// Comprobar si el correo tiene formato de correo electrónico
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    die("El correo no tiene formato de correo electrónico");
}

// Crear una consulta SQL para buscar el usuario o el correo electrónico
$consulta = "SELECT * FROM usuario WHERE nomUsu = '$usuario' OR correo = '$correo'";

// Ejecutar la consulta SQL
$resultado = mysqli_query($conexion, $consulta);

// Comprobar si la consulta SQL devuelve algún resultado
if (mysqli_num_rows($resultado) > 0) {
    // El usuario o el correo electrónico ya existen en la base de datos
    echo "El usuario o el correo electrónico ya existen";
} else {
    // El usuario y el correo electrónico no existen en la base de datos, almacenar los datos
    $consulta = "INSERT INTO usuario (nomUsu, cont, correo) VALUES ('$usuario', '$contraseña', '$correo')";
    mysqli_query($conexion, $consulta);
    echo "Los datos se han almacenado correctamente";
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
