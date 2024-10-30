<?php

namespace models;

/**
 * Classe Model de Prospects
 *
 * Esta classe representa um prospect e armazena suas informações básicas.
 * 
 * @author Eduardo Gustavo
 */

class Prospect {
    
    /**
     * Nome do prospect.
     *
     * @var string
     */
    public $nome;
    
    /**
     * Endereço de email do prospect.
     *
     * @var string
     */
    public $email;
    
    /**
     * Número de celular do prospect.
     *
     * @var string
     */
    public $celular;

   /**
    * whatsapp do prospect.
    *
    * @var string
    */
    public $whatsapp;

    /**
     * facebook do prospect.
     * 
     * @var string
     */

    public $facebook;

    /**
     * Carrega os dados do prospect 
     * 
     * Este método atribui os valores fornecidos às propriedades do prospect.
     * 
     * @param string $nome    Nome do prospect.
     * @param string $email   Endereço de email do prospect.
     * @param string $celular Número de celular do prospect.
     * @param string $whatsapp Número de whatsapp do prospect.
     * @param string $facebook Endereço do facebook do prospect.
     *  
     * 
     * @return void
     */

    public function addProspect($nome, $email, $celular, $whatsapp, $facebook){
        $this->nome    = $nome;
        $this->email   = $email;
        $this->celular = $celular;
        $this->whatsapp = $whatsapp;
        $this->facebook = $facebook;

    }
}
?>

