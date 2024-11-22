<?php
/**
 * @author Eduardo Gustavo
 */

session_start(); // Inicia a sessão

require_once __DIR__ . '/../../config.php'; // Inclui o arquivo de configuração

require_once (SRC . 'Controllers/User/ControllerUser.php'); // Inclui o controlador de usuário

use Controllers\ControllerUser;

if(isset($_POST['user']) && isset($_POST['senha'])){
    // Verifica se os campos 'user' e 'senha' foram enviados via POST
    $user = $_POST['user'];
    $senha = $_POST['senha'];

    $controller = new ControllerUser();
    $user = $controller->validarLogin($user, $senha); // Valida o login do usuário
    if($user){
        // Se o login for bem-sucedido
        echo "Logado com sucesso!";
        $_SESSION['user'] = serialize($user); // Armazena o objeto usuário na sessão
        header('Location: '. VIEWS_URL . 'dashboard.php'); // Redireciona para o dashboard
    }else{
        // Se o login falhar
        echo "Usuário ou senha inválidos, tente novamente!";
        $_SESSION['erroLogin'] = "Usuário ou senha inválidos, tente novamente!"; // Armazena mensagem de erro na sessão
        header('Location: '.ROOT_URL.'index.php'); // Redireciona para a página inicial
    }
}else{
    // Caso os dados não tenham sido enviados via POST

    $_SESSION['erroLogin'] = "Você precisa estar logado para acessar esta página!"; // Armazena mensagem de erro na sessão
    header('Location: '.ROOT_URL.'index.php'); // Redireciona para a página inicial
}
?>
