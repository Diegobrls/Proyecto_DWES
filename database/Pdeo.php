<?php

require_once "Conexion.php";
require_once "Database.php";


class Pdeo extends Database implements Conexion
{
    private static ?Pdeo $conexion = null;
    public function __construct(string $name = "quedeque")
    {
        try {
            $uri = "mysql:host=" . "db" . ";dbname={$name};charset=utf8";

            // establecer una conexión con el servidor de bases de datos indicando:                
            $this->db = new PDO($uri, "root", "");

        } catch (PDOException $exp) {
            die("** Error de conexión con la base de datos: " . $exp->getMessage() . "<br/>");
        }
    }

    public static function getConnection(): Pdeo
    {
        if (self::$conexion == null)
            self::$conexion = new Pdeo();

        return self::$conexion;
    }

    /**
     * Establece el nombre de la base de datos
     * @param string $name
     */
    public function setDatabaseName(string $name)
    {
        $this->db->query("USE {$name} ; ");
    }

    /**
     * Realiza una consulta sobre la base de datos y guarda
     * el conjunto de resultados en una propiedad de la clase
     */
    public function query(string $sql)
    {
        $this->resultado = $this->db->query($sql);
        return $this;
    }

    /**
     * Recupera un registro del conjunto de resultados y lo
     * devuelve en formato de Objeto.
     * @param string $clase Nombre de la clase para instanciar
     * @param mixed  ...$parametros Parámetros adicionales para la instanciación de la clase
     * @return object|null
     */
    public function getRow(string $clase, ...$parametros): ?object {
        try {
            $row = $this->resultado->fetchObject($clase, $parametros);
    
            // Comentario o eliminación de las líneas de depuración
            // echo "Clase: $clase\n";
            // echo "Parámetros: " . implode(', ', $parametros) . "\n";
            // echo "Fila: " . print_r($row, true) . "\n";
    
            return $row !== false ? $row : null;
        } catch (PDOException $e) {
            // Manejar errores si es necesario
            echo "Error en la consulta SQL: " . $e->getMessage() . "\n";
            return null;
        }
    }
    


    /**
     * Recupera todos los registros en forma de objeto y
     * los devuelve dentro de un array.
     * @return $clase
     * @return array 
     */
    public function getAll(string $clase): array
    {
        return $this->resultado->fetchAll(PDO::FETCH_CLASS, $clase);
    }

    /**
     * Devuelve el número de filas afectadas por la última consulta.
     *
     * @return int
     */
    public function rowCount(): int
    {
        if ($this->resultado instanceof PDOStatement) {
            return $this->resultado->rowCount();
        } else {
            return 0; // O devuelve un valor diferente según tu lógica
        }
    }

    /**
     * Ejecuta una consulta y devuelve el resultado como un array de objetos
     * utilizando la clase proporcionada.
     *
     * @param string $sql
     * @param string $clase
     * @return array
     */
}