<?php
session_start(); 

// Incluindo arquivos necessários
require_once __DIR__ . '/../../config.php'; 
require_once (SRC . 'Controllers/User/ControllerUser.php'); 
require_once (SRC . 'utils/notify.php'); 

// Incluindo classes necessárias
use Controllers\ControllerUser;
use Utils\Notify;

//Intacia a classe de notificação
$notify = new Notify(); // Instancia a classe de notificação

/**
 * @autor Eduardo Gustavo da Silva Rodrigues
 * @description Fazer tratamneto de requisições HTTP para POST de validação de login
 * @param string $user indica o nome do usuário em body em metodo post
 * @param string $senha indica a senha do usuário em body em metodo post
 */
if (!empty($_POST['user']) && !empty($_POST['senha'])) {

    $username = $_POST['user'];
    $senha = $_POST['senha'];

    $controller = new ControllerUser();
    $user = $controller->validarLogin($username, $senha); 

    if(! $user->status){
        $notify->addMessage('Usuário ou senha inválidos!', 'error'); 
        header('Location: '.ROOT_URL.'index.php'); 
        return;
    }
    
    $_SESSION['user'] = serialize($user); 
    header('Location: '. VIEWS_URL . 'dashboard.php'); 
   
}else{
    $notify->addMessage('Ensira o usuário e a senha!', 'error');
    header('Location: '.ROOT_URL.'index.php');
}
?>
