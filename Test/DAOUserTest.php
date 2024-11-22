<?php

// Requer o arquivo de configuração principal do projeto
require_once __DIR__ . '/../config.php';

// Inclui o autoloader do Composer
require_once(ROOT . 'vendor\autoload.php');

// Inclui a classe de acesso ao banco de dados para usuários
require_once(SRC . 'DAO\DAOUser.php');

// Inclui o modelo da entidade User
require_once(SRC . 'models\User.php');

// Usa a classe de teste do PHPUnit
use PHPUnit\Framework\TestCase;
use DAO\DAOUser;
use models\User;

/**
 * Classe de teste para a camada de acesso a dados de usuários (DAOUser)
 */
class DAOUserTest extends TestCase {

    /**
     * Testa o método de login da classe DAOUser
     * 
     * @test
     */
    public function loginTeste() {

        /**
         * Instancia um objeto da classe DAOUser para realizar o teste de login
         * 
         * @var DAOUser
         */
        $daoUsuario = new DAOUser();    
        
        try {
            // Define as credenciais de teste para login
            $login = 'paulo';
            $senha = '123';

            /**
             * Verifica se o método de login retorna status TRUE
             * quando as credenciais corretas são fornecidas
             */
            $this->assertEquals(TRUE, $daoUsuario->logar($login, $senha)->status);

            // Libera a memória ao remover a instância de DAOUser
            unset($daoUsuario);
        } catch (Exception $e) {
            // Se ocorrer uma exceção, o teste falha com a mensagem de erro
            $this->fail('Erro ao logar: ' . $e->getMessage());
        }
        
    }

    /**
     * Testa o método de login da classe DAOUser com credenciais inválidas
     * 
     * @test
     */

    public function loginInvalidoTeste() {

        /**
         * Instancia um objeto da classe DAOUser para realizar o teste de login
         * 
         * @var DAOUser
         */
        $daoUsuario = new DAOUser();    
        
        try {
            // Define as credenciais de teste para login
            $login = 'paulo';
            $senha = '1234';

            /**
             * Verifica se o método de login retorna status FALSE
             * quando as credenciais incorretas são fornecidas
             */
            $this->assertEquals(FALSE, $daoUsuario->logar($login, $senha)->status);

            // Libera a memória ao remover a instância de DAOUser
            unset($daoUsuario);
        } catch (Exception $e) {
            // Se ocorrer uma exceção, o teste falha com a mensagem de erro
            $this->fail('Erro ao logar: ' . $e->getMessage());
        }

    }

    

    /**
     * Testa o método incluir da classe DAOUser
     * 
     * @test
     */

    public function incluirTeste() {

        /**
         * Instancia um objeto da classe DAOUser para realizar o teste de inclusão
         * 
         * @var DAOUser
         */
        $daoUsuario = new DAOUser();    
        
        try {
            // Define os dados de teste para inclusão
            $login = 'teste';
            $nome = 'Teste';
            $email = 'tete@tete';
            $celular = '999999999';
            $senha = '123';

            /**
             * Verifica se o método de inclusão retorna status TRUE
             * quando os dados corretos são fornecidos
             */
            $this->assertEquals(TRUE, $daoUsuario->incluirUser($login, $nome, $email, $celular,$senha));

            // Libera a memória ao remover a instância de DAOUser
            unset($daoUsuario);
        } catch (Exception $e) {
            // Se ocorrer uma exceção, o teste falha com a mensagem de erro
            $this->fail('Erro ao incluir: ' . $e->getMessage());
        }
    }
}

?>
