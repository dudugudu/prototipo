<?php
/**
 * @author Eduardo Gustavo
 */

session_start(); // Inicia a sessão

require_once __DIR__ . '/../../config.php'; // Inclui o arquivo de configuração

require_once (SRC . 'Controllers/User/ControllerUser.php'); // Inclui o controlador de usuário
use Controllers\ControllerUser;

require_once (SRC . 'utils/notify.php'); // Inclui o arquivo de utilidades
use Utils\Notify;
$notify = new Notify(); // Instancia a classe de notificação


if (!empty($_POST['user']) && !empty($_POST['senha'])) {
    // Verifica se os campos 'user' e 'senha' foram enviados via POST
    $username = $_POST['user'];
    $senha = $_POST['senha'];

    $controller = new ControllerUser();
    $user = $controller->validarLogin($username, $senha); // Valida o login do usuário
    if($user->status){
        // Se o login for bem-sucedido
        $_SESSION['user'] = serialize($user); // Armazena o objeto usuário na sessão
        header('Location: '. VIEWS_URL . 'dashboard.php'); // Redireciona para o dashboard
    }else{
        // Se o login falhar
        $notify->addMessage('Usuário ou senha inválidos!', 'error'); // Adiciona uma mensagem de erro
        header('Location: '.ROOT_URL.'index.php'); // Redireciona para a página inicial
    }
}else{
    // Caso os dados não tenham sido enviados via POST
    $notify->addMessage('Ensira o usuário e a senha!', 'error'); // Adiciona uma mensagem de erro
    header('Location: '.ROOT_URL.'index.php'); // Redireciona para a página inicial
}
?>
