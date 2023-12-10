<?php

require_once __DIR__ . "/../database/Pdeo.php";

class Partidas
{

    public int $idPartida;
    public int $idUsuario;
    public int $puntuacion;
    public string $fechaInicio;

    public static function getAllPartidas(): array
    {
        return Pdeo::getConnection()
            ->query("SELECT * FROM partidas;")
            ->getAll("partidas");
    }


    /**
     * Recupera los puntos totales de un jugador
     * @param int $idPartida
     * @return Partidas|int|null Devuelve un valor entero o null si no se encuentra.
     */
    public static function getPuntosTotalesById(int $idPartida)
    {
        return Pdeo::getConnection()
            ->query("SELECT * FROM partidas WHERE idPartida = {$idPartida}")
            ->getRow("Partidas");
    }


    /**
     * Comprueba el resultado de la pregunta, si es correcto suma 50 puntos, si no 0
     * @param int $respuestaSeleccionada
     * @return int
     */
    public static function comprobarResultado($respuestaCorrecta)
    {

        if ($respuestaCorrecta == "respuestaCorrecta") {
            return 50;
        } else {
            return 0;
        }
    }


    /**
     * Añade un nuevo registro de puntos
     * @param int $puntos $idUsuario
     */
    public static function ingresarPuntosTotales($puntos, $idUsuario)
    {
        $conexion = Pdeo::getConnection();

        // Comprobar si el usuario ya tiene una partida
        $conexion->query("SELECT idPartida, puntuacion FROM partidas WHERE idUsuario = {$idUsuario}");
        $result = $conexion->getRow('Partidas');

        if ($result) {
            // El usuario ya tiene una partida, actualiza la puntuación
            $idPartida = $result->idPartida;
            $puntuacionActual = $result->puntuacion;
            $nuevaPuntuacion = $puntuacionActual + $puntos;
            $conexion->query("UPDATE partidas SET puntuacion = {$puntos} WHERE idPartida = {$idPartida}");
            // Actualiza la puntuación en la tabla ranking
            $conexion->query("UPDATE ranking SET totalJugador = {$nuevaPuntuacion} WHERE idUsuario = {$idUsuario}");
            echo "Se ha actualizado la puntuación en la tabla ranking: Total Jugador = {$nuevaPuntuacion} para el Usuario con ID {$idUsuario}";
        } else {
            // El usuario no tiene una partida, crea una nueva entrada
            $conexion->query("INSERT INTO partidas (idUsuario, puntuacion) VALUES ({$idUsuario}, {$puntos})");
            // Inserta la puntuación en la tabla ranking
            $conexion->query("INSERT INTO ranking (idUsuario, totalJugador) VALUES ({$idUsuario}, {$puntos})");

        }
    }
}