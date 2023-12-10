<?php


interface Conexion
{

    /**
     * Establece el nombre de la base de datos
     * @param string $name
     */
    public function setDatabaseName(string $name);

    /**
     * Realiza una consulta sobre la base de datos y guarda
     * el conjunto de resultados en una propiedad de la clase
     */
    public function query(string $sql);

    /**
     * Recupera un registro del conjunto de resultados y lo
     * devuelve en formato de Objeto.
     * @param $clase
     * @return object
     */
    public function getRow(string $clase, ...$parametros): ?object;

    /**
     * Recupera todos los registros en forma de objeto y
     * los devuelve dentro de un array.
     * @return $clase
     * @return array 
     */
    public function getAll(string $clase): array;
}
