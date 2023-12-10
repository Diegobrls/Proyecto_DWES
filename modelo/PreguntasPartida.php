<?php

require_once __DIR__ . "/../database/Pdeo.php" ;

    class PreguntasPartida {

        public int $idPartida ;
        public int $idPregunta ;
        public static function getAllPreguntasPartida(): array {
            return Pdeo::getConnection()
                         ->query("SELECT * FROM preguntasPartida ;")
                         ->getAll("preguntasPartida") ;            
         }

    }