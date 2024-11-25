<?php
/**
 * @author Eduardo Gustavo
 */

session_start(); // Inicia a sessão

require_once __DIR__ . '/../../config.php'; // Inclui o arquivo de configuração

require_once (SRC . 'Controllers/Propects/ControllerPropect.php'); // Inclui a classe ControllerProspects


use Controllers\ControllerPropect;

require_once (SRC . 'utils/notify.php'); // Inclui o arquivo de utilidades; // Inclui o arquivo de utilidades
use Utils\Notify;
$notify = new Notify(); // Instancia a classe de notificação

if(isset($_SERVER ['REQUEST_METHOD']) && $_SERVER ['REQUEST_METHOD'] == 'POST'){
    // Verifica se os campos 'name', 'email', 'whatapp', 'facebook' e 'celular' foram enviados via POST
    $name = $_POST['name'];
    $cod_prospect = $_POST['cod'];
    $email = $_POST['email'];
    $whatapp = $_POST['whatsapp'];
    $facebook = $_POST['facebook'];
    $celular = $_POST['cellphone'];   

    $controller = new ControllerPropect();
    $prospect = $controller->putProspects($name, $email, $whatapp, $facebook, $celular, $cod_prospect); // Valida o cadastro do prospect
    if($prospect){
        // Se o cadastro for bem-sucedido
        $notify->addMessage('Prospect atualizado com sucesso!'.$prospect, 'success'); // Adiciona uma mensagem de sucesso
        $_SESSION['prospect'] = serialize($prospect); // Armazena o objeto prospect na sessão
        header('Location: '.VIEWS_URL.'dashboard.php'); // Redireciona para o dashboard
    }else{
        // Se o cadastro falhar
        $notify->addMessage('Erro ao cadastrar prospect!', 'error'); // Adiciona uma mensagem de erro
        
        header('Location: '. VIEWS_URL . 'prospect/edit_prospect.php?cod_prospect='); // Redireciona para a página inicial
    }
}else{
    // Caso os dados não tenham sido enviados via POST
    $notify->addMessage('Você precisa estar logado para acessar esta página!', 'error'); // Adiciona uma mensagem de erro
    header('Location: '. VIEWS_URL . 'dashboard.php' ); // Redireciona para a página inicial
}




?>


