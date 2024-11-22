<?php
/**
 * @author Eduardo Gustavo
 */

session_start(); // Inicia a sessão

require_once __DIR__ . '/../../config.php'; // Inclui o arquivo de configuração

require_once (SRC . 'Controllers/User/ControllerUser.php'); // Inclui o controlador de usuário

use Controllers\ControllerUser;

if(isset($_SERVER ['REQUEST_METHOD']) && $_SERVER ['REQUEST_METHOD'] == 'POST'){
    // Verifica se os campos 'user' e 'senha' foram enviados via POST
    $user = $_POST['user'];
    $senha = $_POST['senha'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $cellphone = $_POST['cellphone'];   
    $csenha = $_POST['csenha'];


    if($senha == $csenha){
        $controller = new ControllerUser();
        $user = $controller->cadastrarUser($user,$name, $email,$cellphone, $senha); // Valida o login do usuário
        if($user){
            // Se o login for bem-sucedido
            $_SESSION['user'] = serialize($user); // Armazena o objeto usuário na sessão
            header('Location: '.ROOT_URL.'index.php'); // Redireciona para o dashboard
        }else{
            // Se o login falhar
            $_SESSION['erroInsert'] = "Erro ao cadastrar usuário!"; // Armazena mensagem de erro na sessão
            header('Location: '. VIEWS_URL . 'insert_user.php'); // Redireciona para a página inicial
        }

    }else{
        echo "Senhas não conferem!";
        $_SESSION['erroInsert'] = "Senhas não conferem!"; // Armazena mensagem de erro na sessão
        header('Location: '. VIEWS_URL . 'insert_user.php'); // Redireciona para a página inicial
    }
}else{
    // Caso os dados não tenham sido enviados via POST

    $_SESSION['erroInsert'] = "Você precisa estar logado para acessar esta página!"; // Armazena mensagem de erro na sessão
    header('Location: '. VIEWS_URL . 'insert_user.php'); // Redireciona para a página inicial
}