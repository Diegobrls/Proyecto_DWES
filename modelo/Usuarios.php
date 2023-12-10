<?php
require_once __DIR__ . "/../database/Pdeo.php";

class Usuarios
{

    public int $idUsuario;
    public string $nombre;
    public string $email;
    public string $contrasena;
    public string $fechaRegistro;
    public static function getAllUsuarios(): array
    {
        return Pdeo::getConnection()
            ->query("SELECT * FROM usuarios ;")
            ->getAll("Usuarios");
    }

    public static function verificarUsuario($nombreUsu, $contrasena)
    {
        try {
            $conexion = Pdeo::getConnection();
    
            $sql = "SELECT * FROM usuarios WHERE nombre = '$nombreUsu'";
            $conexion->query($sql);
            $usuario = $conexion->getRow("Usuarios");
    
            // Verificar si se encontró un usuario y si la contraseña coincide
            if ($usuario && ($contrasena == $usuario->contrasena)) {
                $_SESSION['idUsuario'] = $usuario->idUsuario;
    
                // Verificar si el usuario es admin y la contraseña es admin
                if ($nombreUsu == 'admin' && $contrasena == 'admin') {
                    // Si es admin, redirigir a la página de administración (CRUD)
                    header("Location: crud");
                } else {
                    // Si no es admin, redirigir a la página principal (home)
                    header("Location: home");
                }
                exit;
            } else {
                // El usuario y/o contraseña son incorrectos, redirigir a login con mensaje de error
                echo "Usuario y/o contraseña incorrecto";
            }
        } catch (Exception $e) {
            // Manejar la excepción (por ejemplo, mostrar un mensaje de error genérico)
            echo "Error en la conexión: " . $e->getMessage();
        }
    }


    public static function registrarUsuario($nombreUsu, $email, $contrasena, $contrasenaRep)
    {
        try {

            // Obtener la conexión a la base de datos
            $conexion = Pdeo::getConnection();

            // Consulta para verificar que no se repiten usuarios o contraseñas
            $sqlConsulta = "SELECT * FROM usuarios WHERE nombre = '$nombreUsu' OR email = '$email'";

            // Ejecutar la consulta
            $resultConsulta = $conexion->query($sqlConsulta);

            // Verificar si hay resultados
            if ($resultConsulta && $resultConsulta->rowCount() > 0) {
                echo "Usuario y/o email ya existentes";
            }

            // Consulta para insertar el nuevo usuario en la base de datos
            $sqlInsercion = "INSERT INTO usuarios (nombre, email, contrasena) VALUES ('$nombreUsu', '$email', '$contrasena')";

            // Ejecutar la consulta de inserción
            $conexion->query($sqlInsercion);
            echo "Usuario registrado exitosamente";

        } catch (Exception $e) {

            echo "Error al registrar el usuario";
            $e->getMessage();
        }
    }

    public static function obtenerDatosPerfil(int $idUsuario)
    {
        return Pdeo::getConnection()
            ->query("SELECT * FROM usuarios WHERE idUsuario = {$idUsuario}")
            ->getRow("Usuarios");
    }
}
