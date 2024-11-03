<?php

namespace models;

/**
 * Classe Model de Usuários
 *
 * Esta classe representa um usuário e armazena suas informações básicas.
 * 
 * @author Eduardo Gustavo
 */
class User {
    
    /**
     * Login do usuário.
     *
     * @var string
     */
    public $login;
    
    /**
     * Nome completo do usuário.
     *
     * @var string
     */
    public $nome;
    
    /**
     * Endereço de email do usuário.
     *
     * @var string
     */
    public $email;
    
    /**
     * Número de celular do usuário.
     *
     * @var string
     */
    public $celular;

    /**
     * Status do usuário (ativo/inativo).
     *
     * @var bool
     */
    public $status;
    
    /**
     * Carrega os dados do usuário.
     *
     * Este método atribui os valores fornecidos às propriedades do usuário.
     *
     * @param string $login   Login do usuário.
     * @param string $nome    Nome completo do usuário.
     * @param string $email   Endereço de email do usuário.
     * @param string $celular Número de celular do usuário.
     * @param bool   $status  Status ativo/inativo do usuário.
     *
     * @return void
     */
    public function addUser($login, $nome, $email, $celular, $status){
        $this->login   = $login;
        $this->nome    = $nome;
        $this->email   = $email;
        $this->celular = $celular;
        $this->status  = $status;
    }

}

?>
