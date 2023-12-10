<?php

    require_once "Conexion.php" ;
    require_once "Database.php" ;

    class MySQL extends Database implements Conexion {

       
       
        private function __clone() { }

        /**
         * Conectamos con el servidor de bases de datos únicamente
         * cuando creo la instancia de la clase Conexión.
         */
        public function __construct(string $name = "") { 

            try {
               // establecer una conexión con el servidor de bases de datos indicando:
                // - La dirección del servidor (db porque estamos trabajando con un servicio de docker)
                // - Usuario
                // - Contraseña
                // - Nombre de la base de datos (opcional)
                // - Puerto (opcional)
                $this->db = new mysqli("db", "root", "") ;

                // Si se nos proporciona el nombre de la base de datos
                // conectamos con ella.
                if (!empty($name)) $this->setDatabaseName($name) ;
                        
            } catch(mysqli_sql_exception $exp) {		
                die("** Error de conexión con la base de datos: ".$exp->getMessage()."<br/>") ;
            }
         }

        /**
         * Establece el nombre de la base de datos
         * @param string $name
         */
        public function setDatabaseName(string $name) {

            // guardamos el nombre por si lo necesitamos (opcional)
            $this->name = $name ;

            // USE $name
            $this->db->select_db($name) ;
        }

        /**
         * Realiza una consulta sobre la base de datos y guarda
         * el conjunto de resultados en una propiedad de la clase
         */
        public function query(string $sql) {
          $this->resultado = $this->db->query($sql) ;
          return $this ;
        }

        /**
         * Recupera un registro del conjunto de resultados y lo
         * devuelve en formato de Objeto.
         * @param $clase
         * @return object
         */
        public function getRow(string $clase, ...$parametros):?object {

            return $this->resultado->fetch_object($clase, $parametros) ;
        }

        /**
         * Recupera todos los registros en forma de objeto y
         * los devuelve dentro de un array.
         * @return $clase
         * @return array 
         */
        public function getAll(string $clase):array {

            $datos = [] ;
            while ($item = $this->getRow($clase))
                array_push($datos, $item) ;
            //
            return $datos ;
        }

    }
