<?php

require_once __DIR__ . "/../database/Pdeo.php";

class Ranking
{

    public int $idUsuario;
    public int $totalJugador;
    public static function getAllRanking(): array
    {
        return Pdeo::getConnection()
            ->query("SELECT * FROM ranking ORDER BY totalJugador DESC;")
            ->getAll("ranking");
    }

    /**
     * Recupera información sobre un registro del Ranking por su ID
     * @param int $idUsuario
     * @return Ranking|array|null 
     */
    public static function getRankingById(int $idUsuario)
    {

        return Pdeo::getConnection()
            ->query("SELECT * FROM ranking WHERE idUsuario = {$idUsuario}")
            ->getRow("Ranking");
    }


    /**
     * Actualiza los valores del Ranking
     * @param int $idUsuario $puntos
     * @return Ranking|array|null 
     */
    public static function ingresarPuntosTotales($puntos, $idUsuario)
    {
        $conexion = Pdeo::getConnection();

        // Comprobar si el usuario ya tiene un registro en el ranking
        $conexion->query("SELECT totalJugador FROM ranking WHERE idUsuario = {$idUsuario}");
        $result = $conexion->getRow('Ranking');

        if ($result) {
            // El usuario ya tiene un registro en el ranking, actualiza la puntuación
            $nuevaPuntuacion = $result->totalJugador + $puntos;
            $conexion->query("UPDATE ranking SET totalJugador = {$nuevaPuntuacion} WHERE idUsuario = {$idUsuario}");
        } else {
            // El usuario no tiene un registro en el ranking, crea uno nuevo
            $conexion->query("INSERT INTO ranking (idUsuario, totalJugador) VALUES ({$idUsuario}, {$puntos})");
        }
    }


}