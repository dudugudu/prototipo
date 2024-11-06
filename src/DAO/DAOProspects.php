<?php

namespace DAO;

require_once __DIR__ . '/../../config.php';

// Configura o relatório de erros do MySQL para lançar exceções
mysqli_report(MYSQLI_REPORT_STRICT);

use models\Prospects;

class DAOProspects {

    /**
     * Conecta ao banco de dados
     * 
     * @return \MySQLi Conexão com o banco
     * @throws \Exception Em caso de falha na conexão
     */
    private function connectDB() {
        $separador = DIRECTORY_SEPARATOR;
        $root = dirname((__FILE__) . $separador);
        require("configdb.php");

        try {
            $conn = new \MySQLi($dbhost, $dbuser, $dbpass, $dbname);
            return $conn;
        } catch (\Exception $e) {
            throw new \Exception("Erro ao conectar com o banco de dados: " . $e->getMessage());
            die;
        }
    }

    /**
     * Insere um novo prospect no banco de dados
     */
    public function insertProspects($name, $email, $whatapp, $facebook, $celular) {
        $conn = $this->connectDB();
        
        try {
            $query = "INSERT INTO prospect(nome, email, whatsapp, facebook, celular) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sssss", $name, $email, $whatapp, $facebook, $celular);
            $stmt->execute();
            $conn->close();
            return TRUE;
        } catch (\Exception $e) {
            throw new \Exception("Erro ao inserir prospect: " . $e->getMessage());
            die;
        }
    }

    /**
     * Atualiza dados de um prospect existente
     */
    public function putProspects($name, $email, $whatapp, $facebook, $celular, $id) {
        $conn = $this->connectDB();
        
        try {
            $query = "UPDATE prospect SET nome = ?, email = ?, whatsapp = ?, facebook = ?, celular = ? WHERE cod_prospect = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sssssi", $name, $email, $whatapp, $facebook, $celular, $id);
            $stmt->execute();
            $conn->close();
            return TRUE;
        } catch (\Exception $e) {
            throw new \Exception("Erro ao atualizar prospect: " . $e->getMessage());
            die;
        }
    }

    /**
     * Deleta um prospect do banco de dados
     */
    public function deleteProspects($id) {
        $conn = $this->connectDB();
        
        try {
            $query = "DELETE FROM prospect WHERE cod_prospect = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $conn->close();
            return TRUE;
        } catch (\Exception $e) {
            throw new \Exception("Erro ao deletar prospect: " . $e->getMessage());
            die;
        }
    }

    /**
     * Busca um prospect pelo nome
     * 
     * @return array Prospect encontrado
     */
    public function getProspectName($name) {
        $conn = $this->connectDB();
        
        try {
            $query = "SELECT * FROM prospect WHERE nome = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $name);
            $stmt->execute();
            $result = $stmt->get_result();
            $conn->close();
            return $result->fetch_assoc();
        } catch (\Exception $e) {
            throw new \Exception("Erro ao buscar prospect: " . $e->getMessage());
            die;
        }
    }

    /**
     * Busca todos os prospects
     * 
     * @return array Lista de todos os prospects
     */
    public function getProspectsAll() {
        $conn = $this->connectDB();
        
        try {
            $query = "SELECT * FROM prospect";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result();
            $conn->close();
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Exception $e) {
            throw new \Exception("Erro ao buscar prospects: " . $e->getMessage());
            die;
        }
    }
}

?>
