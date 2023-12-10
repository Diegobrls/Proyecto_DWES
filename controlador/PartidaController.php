<?php
require_once __DIR__ . "/../modelo/Partidas.php";
require_once __DIR__ . "/../modelo/Ranking.php";
require_once __DIR__ . "/../modelo/Usuarios.php";
require_once "Controller.php";

class PartidaController extends Controller
{
    public function procesarRespuesta()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $_SESSION['contador_preguntas'] = ($_SESSION['contador_preguntas'] ?? 0) + 1;
            $idUsuario = $_SESSION['idUsuario'];
            $respuestaSeleccionada = $_POST["respuesta"];
            $puntos = Partidas::comprobarResultado($respuestaSeleccionada);
            Ranking::ingresarPuntosTotales($puntos, $idUsuario);
            if ($_SESSION['contador_preguntas'] == 5) {
                // Resetea el contador
                unset($_SESSION['contador_preguntas']);

                header('Location: ranking');
                exit();
            }

            header('Location: juega');
            exit();
        }
    }
}