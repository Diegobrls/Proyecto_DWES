<?php

    abstract class Database {

        protected $name ;           // nombre de la base de datos
        protected $db ;             // conexión con el servidor de bases de datos
        protected $resultado ;      // mysqli -> mysqli_result; PDO    -> PDOStatement
                                

    }