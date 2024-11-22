<?php
/**
 * @author Eduardo Gustavo
 */

session_start(); // Inicia a sessão

require_once __DIR__ . '/../../config.php'; // Inclui o arquivo de configuração

require_once (SRC . 'Controllers/Propects/ControllerPropect.php'); // Inclui a classe ControllerProspects


use Controllers\ControllerPropect;

if(isset($_SERVER ['REQUEST_METHOD']) && $_SERVER ['REQUEST_METHOD'] == 'POST'){
    // Verifica se os campos 'name', 'email', 'whatapp', 'facebook' e 'celular' foram enviados via POST
    $name = $_POST['name'];
    $email = $_POST['email'];
    $whatapp = $_POST['whatsapp'];
    $facebook = $_POST['facebook'];
    $celular = $_POST['cellphone'];   

    $controller = new ControllerPropect();
    $prospect = $controller->cadastrarPropect($name, $email, $whatapp, $facebook, $celular); // Valida o cadastro do prospect
    if($prospect){
        // Se o cadastro for bem-sucedido
        $_SESSION['prospect'] = serialize($prospect); // Armazena o objeto prospect na sessão
        header('Location: '.VIEWS_URL.'dashboard.php'); // Redireciona para o dashboard
    }else{
        // Se o cadastro falhar
        $_SESSION['erroInsert'] = "Erro ao cadastrar prospect!"; // Armazena mensagem de erro na sessão
        header('Location: '. VIEWS_URL . 'insert_prospect.php'); // Redireciona para a página inicial
    }
}else{
    // Caso os dados não tenham sido enviados via POST

    $_SESSION['erroInsert'] = "Você precisa estar logado para acessar esta página!"; // Armazena mensagem de erro na sessão
    header('Location: '. VIEWS_URL . 'insert_prospect.php'); // Redireciona para a página inicial
}




?>


