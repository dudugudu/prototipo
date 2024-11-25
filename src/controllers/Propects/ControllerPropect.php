<?php
/**
 * Classe de controle de usuários
 * 
 * @autor: Eduardo Gustavo
 */

namespace Controllers;

require_once __DIR__ . '/../../../config.php'; // Inclui o arquivo de configuração

require_once (SRC . 'DAO/DAOProspects.php'); // Inclui a classe DAOPropect


use DAO\DAOProspects;

class ControllerPropect{

    /**
     * Cadastra um novo usuário no banco de dados
     */
    public function cadastrarPropect($name, $email, $whatapp, $facebook, $celular){
        $dao = new DAOProspects(); // Cria uma instância de DAOPropect

        try{
            $propect = $dao->insertProspects($name, $email, $whatapp, $facebook, $celular); // Insere o novo usuário no banco de dados
            return $propect; // Retorna o usuário cadastrado
        }catch(\Exception $e){
            // Em caso de erro, lança uma exceção com a mensagem do erro
            throw new \Exception($e->getMessage());
        }
    }

    public function listarPropects(){
        $dao = new DAOProspects(); // Cria uma instância de DAOPropect

        try{
            $propects = $dao->getProspectsAll(); // Insere o novo usuário no banco de dados
            return $propects; // Retorna o usuário cadastrado
        }catch(\Exception $e){
            // Em caso de erro, lança uma exceção com a mensagem do erro
            throw new \Exception($e->getMessage());
        }
    }

    public function buscarPropect($id){
        $dao = new DAOProspects(); // Cria uma instância de DAOPropect

        try{
            $propect = $dao->getProspectId($id); // Insere o novo usuário no banco de dados
            return $propect; // Retorna o usuário cadastrado
        }catch(\Exception $e){
            // Em caso de erro, lança uma exceção com a mensagem do erro
            throw new \Exception($e->getMessage());
        }
    }

    public function atualizarPropect($id, $name, $email, $whatapp, $facebook, $celular){
        $dao = new DAOProspects(); // Cria uma instância de DAOPropect

        try{
            $propect = $dao->updateProspects($id, $name, $email, $whatapp, $facebook, $celular); // Insere o novo usuário no banco de dados
            return $propect; // Retorna o usuário cadastrado
        }catch(\Exception $e){
            // Em caso de erro, lança uma exceção com a mensagem do erro
            throw new \Exception($e->getMessage());
        }
    }

    public function deletarPropect($id){
        $dao = new DAOProspects(); // Cria uma instância de DAOPropect

        try{
            $propect = $dao->deleteProspects($id); // Insere o novo usuário no banco de dados
            return $propect; // Retorna o usuário cadastrado
        }catch(\Exception $e){
            // Em caso de erro, lança uma exceção com a mensagem do erro
            throw new \Exception($e->getMessage());
        }
    }

    public function putProspects($name, $email, $whatapp, $facebook, $celular, $id){
        $dao = new DAOProspects(); // Cria uma instância de DAOPropect

        try{
            $propect = $dao->putProspects($name, $email, $whatapp, $facebook, $celular, $id); // Insere o novo usuário no banco de dados
            return $propect; // Retorna o usuário cadastrado
        }catch(\Exception $e){
            // Em caso de erro, lança uma exceção com a mensagem do erro
            throw new \Exception($e->getMessage());
        }
    }
    
}