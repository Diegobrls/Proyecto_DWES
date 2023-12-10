<?php
require_once __DIR__ . "/../modelo/Preguntas.php";
require_once "Controller.php";

class PreguntaController extends Controller
{
    public function showJuego()
    {
        if (!isset($_SESSION['numerosUtilizados'])) {
            $_SESSION['numerosUtilizados'] = [];
        }
        do {
            $idPregunta = mt_rand(1, 25);
        } while (in_array($idPregunta, $_SESSION['numerosUtilizados']));

        $_SESSION['numerosUtilizados'][] = $idPregunta;
        $pregunta = Preguntas::getPreguntaById($idPregunta);

        $this->render("/jugar.php.twig", ["datos" => $pregunta]);
    }

    public function showCrud()
    {
        $preguntas = Preguntas::getAllPreguntas();
        $this->render("/crud.php.twig", ["datos" => $preguntas]);
    }


    public function insertarDatosPregunta()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obtener datos del formulario
            $textoPregunta = $_POST["textoPregunta"];
            $respuestaUno = $_POST["respuestaUno"];
            $respuestaDos = $_POST["respuestaDos"];
            $respuestaCorrecta = $_POST["respuestaCorrecta"];
            Preguntas::ingresarDatos($textoPregunta, $respuestaUno, $respuestaDos, $respuestaCorrecta);
            PreguntaController::showCrud();
        }
    }


    public function eliminarPregunta()
    {
        $idPregunta = $_POST["borrar"];
        Preguntas::BorrarPregunta($idPregunta);
        // Redirige a la página de CRUD después de eliminar
        header("Location: crud");
        exit;
    }


}
