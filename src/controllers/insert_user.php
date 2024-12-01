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
$notify = new Notify(); 


/**
 * @autor Eduardo Gustavo da Silva Rodrigues
 * @description Fazer tratamneto de requisições HTTP para POST de criação de usuário
 * @param string $user indica o nome do usuário em body em metodo post
 * @param string $name indica o nome do usuário em body em metodo post
 * @param string $email indica o email do usuário em body em metodo post
 * @param string $cellphone indica o celular do usuário em body em metodo post
 * @param string $senha indica a senha do usuário em body em metodo post
 * @param string $csenha indica a confirmação da senha do usuário em body em metodo post
 */

if(isset($_SERVER ['REQUEST_METHOD']) && $_SERVER ['REQUEST_METHOD'] == 'POST'){
    $user = $_POST['user'];
    $senha = $_POST['senha'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $cellphone = $_POST['cellphone'];   
    $csenha = $_POST['csenha'];

    if($senha != $csenha){
        $notify->addMessage('Senhas não conferem!', 'error');
        header('Location: '. VIEWS_URL . 'insert_user.php');
        return;
    }
    
    $controller = new ControllerUser();
    $user = $controller->cadastrarUser($user,$name, $email,$cellphone, $senha);

    if(! $user){
        $notify->addMessage('Erro ao cadastrar usuário!', 'error');
        header('Location: '. VIEWS_URL . 'insert_user.php');
        return;
    }
    
    $notify->addMessage('Sucesso ao cadastrar usuário!', 'success');
    header('Location: '.ROOT_URL.'index.php'); 


}else{
    $notify->addMessage('Você precisa estar logado para acessar esta página!', 'error'); 
    header('Location: '. VIEWS_URL . 'insert_user.php'); 
}