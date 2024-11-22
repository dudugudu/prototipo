<?php
/**
 * Classe de controle de usuários
 * 
 * @autor: Eduardo Gustavo
 */

namespace Controllers;

require_once __DIR__ . '/../../../config.php'; // Inclui o arquivo de configuração

require_once (SRC . 'DAO/DAOUser.php'); // Inclui a classe DAOUser

use DAO\DAOUser;

class ControllerUser{

    /**
     * Verifica se o usuário existe no banco de dados
     */
    public function validarLogin($email, $senha){
        $dao = new DAOUser(); // Cria uma instância de DAOUser
        $user = $dao->logar($email, $senha); // Tenta realizar o login com o email e senha fornecidos
        
        return $user; // Retorna o usuário se as credenciais forem válidas
    }

    /**
     * Cadastra um novo usuário no banco de dados
     */
    public function cadastrarUser($login, $nome, $email, $celular, $senha){
        $dao = new DAOUser(); // Cria uma instância de DAOUser

        try{
            $user = $dao->incluirUser($login, $nome, $email, $celular, $senha); // Insere o novo usuário no banco de dados
            return $user; // Retorna o usuário cadastrado
        }catch(\Exception $e){
            // Em caso de erro, lança uma exceção com a mensagem do erro
            throw new \Exception($e->getMessage());
        }
    }
}
?>
