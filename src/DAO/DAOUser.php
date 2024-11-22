<?php

namespace DAO;

require_once __DIR__ . '/../../config.php';

// Configura o relatório de erros do MySQLi para lançar exceções em caso de falhas
mysqli_report(MYSQLI_REPORT_STRICT);

require_once(SRC."models\User.php");

use models\User;

/**
 * Classe DAO de Usuários
 *
 * Esta classe é responsável por realizar operações de CRUD no banco de dados
 * relacionadas a usuários.
 * 
 * @package DAO
 * @autor Eduardo Gustavo
 */
class DAOUser {

    /**
     * Conecta ao banco de dados.
     *
     * Este método estabelece uma conexão com o banco de dados utilizando os
     * parâmetros definidos no arquivo de configuração.
     * 
     * @return \MySQLi Conexão ativa com o banco de dados
     * @throws \Exception Se houver erro na conexão com o banco de dados
     */
    private function connectDB() {
        // Define o separador de diretório do sistema
        $separador = DIRECTORY_SEPARATOR;
        
        // Define o caminho raiz do arquivo de configuração do banco
        $root = dirname((__FILE__) . $separador);
        
        // Requer o arquivo de configuração do banco de dados
        require("configdb.php");
    
        try {
            // Cria uma nova conexão MySQLi com os parâmetros fornecidos
            $conn = new \MySQLi($dbhost, $dbuser, $dbpass, $dbname);
            return $conn;

        } catch (\Exception $e) {
            // Lança uma exceção em caso de falha na conexão
            throw new \Exception("Erro ao conectar com o banco de dados: " . $e->getMessage());
            die;
        }
    }

    /**
     * Realiza o login de um usuário no sistema.
     *
     * Verifica se as credenciais fornecidas estão corretas e retorna um objeto User
     * preenchido com os dados do usuário, se autenticado com sucesso.
     * 
     * @param string $login Login do usuário
     * @param string $senha Senha do usuário
     * @return User Objeto User com os dados do usuário ou com status FALSE caso falhe
     */
    public function logar($login, $senha) {

     
      
        // Estabelece conexão com o banco de dados
        $db = $this->connectDB();
        
        // Define a consulta SQL para verificar as credenciais do usuário
        $sql = "SELECT login, nome, email, celular FROM usuario WHERE login = ? AND senha = ?";
        $stmt = $db->prepare($sql);
        
        // Cria uma nova instância de User
        $user = new User();
        
        // Define os parâmetros de login e senha na consulta
        $stmt->bind_param("ss", $login, $senha);
        $stmt->execute();
        
        // Obtém o resultado da consulta
        $result = $stmt->get_result();

        // Verifica se as credenciais não retornaram nenhum resultado
        if ($result->num_rows === 0) {
            // Define o objeto User com status FALSE
            $user->addUser(null, null, null, null, FALSE);
            return $user;
        } else {
            // Preenche o objeto User com os dados retornados
            while ($row = $result->fetch_assoc()) {
                $user->addUser($row['login'], $row['nome'], $row['email'], $row['celular'], TRUE);
            }
            
            // Fecha a declaração e a conexão com o banco de dados
            $stmt->close();
            $db->close();
            return $user;
        }
    }

    /**
     * Inclui um novo usuário no banco de dados.
     *
     * Este método insere um novo registro na tabela de usuários com os dados fornecidos.
     * 
     * @param string $login Login do novo usuário
     * @param string $nome Nome do novo usuário
     * @param string $email Email do novo usuário
     * @param string $celular Número de celular do novo usuário
     * @param string $senha Senha do novo usuário
     * @return bool TRUE se o usuário foi incluído com sucesso, FALSE caso contrário
     */
    public function incluirUser($login, $nome, $email, $celular, $senha) {
        
        // Estabelece conexão com o banco de dados
        $db = $this->connectDB();
        
        // Define a consulta SQL para inserir um novo usuário
        $sql = "INSERT INTO usuario (login, nome, email, celular, senha) VALUES (?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        
        // Define os parâmetros de inserção para a consulta
        $stmt->bind_param("sssss", $login, $nome, $email, $celular, $senha);
        $stmt->execute();

        // Verifica se a inserção foi bem-sucedida
        if ($stmt->affected_rows === 0) {
            // Fecha a declaração e a conexão, retorna FALSE se não inserido
            $stmt->close();
            $db->close();
            return false;
        } else {
            // Fecha a declaração e a conexão, retorna TRUE se inserido com sucesso
            $stmt->close();
            $db->close();
            return true;
        }
    }

}

?>
