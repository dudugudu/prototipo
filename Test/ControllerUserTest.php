<?php

// Requer o arquivo de configuração do projeto
require_once __DIR__ . '/../config.php';

// Autoloader do Composer
require_once(ROOT . 'vendor\autoload.php');

// Classe de acesso ao banco de dados de prospects
require_once(SRC . 'controllers\User\ControllerUser.php');

// Modelo da entidade Prospect
require_once(SRC . 'models\User.php');

use PHPUnit\Framework\TestCase;

use Controllers\ControllerUser;

use models\User;

/**
 * Classe de teste para a ControllerUser
 */

class ControllerUserTest extends TestCase {

    /**
     * Verifica se o método validarLogin retorna um usuário válido
     * @test
     */
    public function validarLoginTeste() {

        
        try {
            $controllerUser = new ControllerUser();
            // Dados de teste para validação
            $email = 'paulo';
            $senha = '123';

            // Verifica se a validação retorna um usuário
            $this->assertEquals(TRUE, $controllerUser->validarLogin($email, $senha)->status);

            // Libera a memória ao remover a instância de DAOUser
            unset($controllerUser);
        } catch (Exception $e) {
            // Se ocorrer uma exceção, o teste falha com a mensagem de erro
            $this->fail('Erro ao logar: ' . $e->getMessage());
        }
    }

}
?>