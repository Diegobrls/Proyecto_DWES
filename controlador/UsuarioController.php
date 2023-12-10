<?php

require_once "Controller.php";
include_once __DIR__ . "/../modelo/Usuarios.php";
include_once __DIR__ . "/../modelo/Ranking.php";
// require_once "librerias/libreria.php" ;

class UsuarioController extends Controller
{

    /**
     * Muestra el formulario de login
     * @return
     */
    public function showLogin()
    {
        $token = md5(uniqid(mt_rand()));
        $_SESSION["_csrf"] = $token;
        $this->render("/login.php.twig");
    }

    public function showRegistro()
    {
        $token = md5(uniqid(mt_rand()));
        $_SESSION["_csrf"] = $token;
        $this->render("/registro.php.twig");
    }

    public function showHome()
    {
        $token = md5(uniqid(mt_rand()));
        $_SESSION["_csrf"] = $token;
        $this->render("/home.php.twig");
    }

    public function showCrud()
    {
        $token = md5(uniqid(mt_rand()));
        $_SESSION["_csrf"] = $token;
        $this->render("/crud.php.twig");
    }

    public function showPerfil()
    {
        $idUsuarioActual = $_SESSION['idUsuario'];
        $datosUsuarioActual = Usuarios::obtenerDatosPerfil($idUsuarioActual);
        $puntosUsuario = Ranking::getRankingById($idUsuarioActual) ;
        $this->render("/perfil.php.twig", ["datos" => $datosUsuarioActual, "puntos" => $puntosUsuario]);
    }

    public function procesarLogin()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obtener datos del formulario
            $nombreUsu = $_POST["nombreUsu"];
            $contrasena = $_POST["contrasena"];
            Usuarios::verificarUsuario($nombreUsu, $contrasena);
        }
    }

    public function procesarRegistro()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obtener datos del formulario
            $nombre = $_POST["nombreUsu"];
            $email = $_POST["email"];
            $contrasena = $_POST["contrasena"];
            $contrasenaRep = $_POST["contrasenaRep"];

            if ($contrasena != $contrasenaRep) {
                $this->render("/registro.php.twig");
                echo "Las contraseñas no coinciden";
            } else {
                // Llamar al método registrarUsuario
                Usuarios::registrarUsuario($nombre, $email, $contrasena, $contrasenaRep);
            }
        }
    }

    public function logout()
    {
        session_destroy();
        $this->render("/login.php.twig");
    }
}