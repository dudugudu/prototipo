<?php

namespace DAO;

use mysqli;

mysqli_report(MYSQLI_REPORT_STRICT);

/**
 * Classe DAO de Usuários
 *
 * Esta classe é responsável por realizar operações de CRUD no banco de dados
 * relacionadas a usuários.
 * 
 * @package DAO
 */

$separador = DIRECTORY_SEPARATOR;

$root = $_SERVER["DOCUMENT_ROOT"].$separador;

require_once($root."models/Usuario.php");

use models\Usuario;


/**
 * Essa classe é responsável por realizar operações de CRUD no banco de dados, sendo desde conexão , logar e incluir usuários.
 * @autor Eduardo Gustavo
 */


 class DAOUsuario{
    private function connectDB(){
        $conn = new \MySQLi("localhost", "teste", "teste", "bc_propect");
        return $conn;
    }

 }
?>
