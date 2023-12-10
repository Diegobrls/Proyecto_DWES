<?php

require_once __DIR__ . "/../database/Pdeo.php";
require_once __DIR__ . "/../database/MySQL.php";
require_once __DIR__ . "/../database/Conexion.php";
require_once __DIR__ . "/../database/Database.php";



class Preguntas
{

    public int $idPregunta;
    public string $textoPregunta;
    public string $respuestaUno;
    public string $respuestaDos;
    public string $respuestaCorrecta;

    // Getter y Setter para idPregunta
    public function getIdPregunta(): int
    {
        return $this->idPregunta;
    }

    public function setIdPregunta(int $idPregunta): void
    {
        $this->idPregunta = $idPregunta;
    }

    // Getter y Setter para textoPregunta
    public function getTextoPregunta(): string
    {
        return $this->textoPregunta;
    }

    public function setTextoPregunta(string $textoPregunta): void
    {
        $this->textoPregunta = $textoPregunta;
    }

    // Getter y Setter para respuestaUno
    public function getRespuestaUno(): string
    {
        return $this->respuestaUno;
    }

    public function setRespuestaUno(string $respuestaUno): void
    {
        $this->respuestaUno = $respuestaUno;
    }

    // Getter y Setter para respuestaDos
    public function getRespuestaDos(): string
    {
        return $this->respuestaDos;
    }

    public function setRespuestaDos(string $respuestaDos): void
    {
        $this->respuestaDos = $respuestaDos;
    }

    // Getter y Setter para respuestaCorrecta
    public function getRespuestaCorrecta(): string
    {
        return $this->respuestaCorrecta;
    }

    public function setRespuestaCorrecta(string $respuestaCorrecta): void
    {
        $this->respuestaCorrecta = $respuestaCorrecta;
    }

    /**
     * Recupera información sobre todas las preguntas
     * @return array
     */
    public static function getAllPreguntas(): array
    {
        return Pdeo::getConnection()
            ->query("SELECT * FROM preguntas ;")
            ->getAll("Preguntas");
    }


    /**
     * Recupera información sobre una determinada pregunta por su ID
     * @param int $idPregunta
     * @return Preguntas|array|null Devuelve un array asociativo con la información de la pregunta o null si no se encuentra.
     */
    public static function getPreguntaById(int $idPregunta)
    {
        // Podemos encadenar llamadas a métodos tras utilizar
        // métodos que devuelvan la instancia de la clase Conexion.
        return Pdeo::getConnection()
            ->query("SELECT * FROM preguntas WHERE idPregunta = {$idPregunta}")
            ->getRow("Preguntas");
    }

    public static function ingresarDatos(string $textoPregunta, string $respuestaUno, string $respuestaDos, string $respuestaCorrecta) {
        $conexion = Pdeo::getConnection();
        $sqlInsercion = "INSERT INTO preguntas (textoPregunta, respuestaUno, respuestaDos, respuestaCorrecta) VALUES ('$textoPregunta', '$respuestaUno', '$respuestaDos', '$respuestaCorrecta')";
        $conexion->query($sqlInsercion);
    }

    // En tu modelo Preguntas
    public static function BorrarPregunta(int $idPregunta)
    {
        Pdeo::getConnection()
            ->query("DELETE FROM preguntas WHERE idPregunta = {$idPregunta}");
    }


}