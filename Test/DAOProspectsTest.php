<?php

// Requer o arquivo de configuração do projeto
require_once __DIR__ . '/../config.php';

// Autoloader do Composer
require_once(ROOT . 'vendor\autoload.php');

// Classe de acesso ao banco de dados de prospects
require_once(SRC . 'DAO\DAOProspects.php');

// Modelo da entidade Prospect
require_once(SRC . 'models\Prospect.php');

use PHPUnit\Framework\TestCase;
use DAO\DAOProspects;
use models\Prospect;

/**
 * Classe de testes para a DAOProspects
 */
class DAOProspectsTest extends TestCase {

    /**
     * @test
     * Verifica se o método insertProspects insere um prospect com sucesso
     */
    public function insertProspectsTeste() {

        $daoProspects = new DAOProspects();

        try {
            // Dados de teste para inserção
            $name = 'paulo';
            $email = 'email@email.com';
            $whatapp = '123456789';
            $facebook = 'facebook';
            $celular = '999999999';

            // Verifica se a inserção retorna TRUE
            $this->assertEquals(TRUE, $daoProspects->insertProspects($name, $email, $whatapp, $facebook, $celular));

            unset($daoProspects);
        } catch (Exception $e) {
            $this->fail('Erro ao inserir prospect: ' . $e->getMessage());
        }
    }

    /**
     * @test
     * Verifica se o método putProspects atualiza os dados de um prospect existente
     */
    public function putProspectsTeste() {

        $daoProspects = new DAOProspects();

        try {
            // Dados de teste para atualização
            $name = 'paulo';
            $email = 'teste@teste';
            $whatapp = '123456789';
            $facebook = 'facebook';
            $celular = '999999999';
            $id = 1;

            // Verifica se a atualização retorna TRUE
            $this->assertEquals(TRUE, $daoProspects->putProspects($name, $email, $whatapp, $facebook, $celular, $id));

            unset($daoProspects);
        } catch (Exception $e) {
            $this->fail('Erro ao atualizar prospect: ' . $e->getMessage());
        }
    }

    /**
     * @test
     * Verifica se o método getProspectName retorna o prospect pelo nome em formato de array
     */
    public function getProspectNameTeste() {

        $daoProspects = new DAOProspects();

        try {
            $name = 'paulo';

            // Verifica se o retorno é um array com os dados do prospect
            $this->assertIsArray($daoProspects->getProspectName($name));

            unset($daoProspects);
        } catch (Exception $e) {
            $this->fail('Erro ao obter prospect por nome: ' . $e->getMessage());
        }
    }

    /**
     * @test
     * Verifica se o método getProspectsAll retorna todos os prospects em formato de array
     */
    public function getProspectsAllTeste() {

        $daoProspects = new DAOProspects();

        try {
            // Verifica se o retorno é um array com todos os prospects
            $this->assertIsArray($daoProspects->getProspectsAll());

            unset($daoProspects);
        } catch (Exception $e) {
            $this->fail('Erro ao obter todos os prospects: ' . $e->getMessage());
        }
    }

    /**
     * @test
     * Verifica se o método deleteProspects exclui um prospect pelo ID com sucesso
     */
    public function deleteProspectIdTeste() {

        $daoProspects = new DAOProspects();

        try {
            $id = 1;

            // Verifica se a exclusão retorna TRUE
            $this->assertEquals(TRUE, $daoProspects->deleteProspects($id));

            unset($daoProspects);
        } catch (Exception $e) {
            $this->fail('Erro ao deletar prospect: ' . $e->getMessage());
        } 
    }
}

?>
