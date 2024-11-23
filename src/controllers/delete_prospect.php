<?php
/**
 * @author ...
 */

session_start(); // Inicia a sessão

require_once __DIR__ . '/../../config.php'; // Inclui o arquivo de configuração
require_once (SRC . 'Controllers/Propects/ControllerPropect.php'); // Inclui a classe ControllerPropect
use Controllers\ControllerPropect;

require_once (SRC . 'utils/notify.php'); // Inclui o arquivo de utilcod_prospectades
use Utils\Notify;
$notify = new Notify(); // Instancia a classe de notificação

if(isset($_GET['cod_prospect'])){
    // Verifica se o parâmetro 'cod_prospect' foi passado na query string
    $cod_prospect = filter_input(INPUT_GET, 'cod_prospect', FILTER_SANITIZE_NUMBER_INT); // Filtra o 'cod_prospect' para aceitar apenas números inteiros

    $controller = new ControllerPropect();
    $prospect = $controller->buscarPropect($cod_prospect); // Busca o prospect no banco de dados
    if($prospect){
        // Se o prospect for encontrado
        $deleted = $controller->deletarPropect($cod_prospect); // Deleta o prospect do banco de dados
        if($deleted){
            // Se o prospect for deletado com sucesso
            $notify->addMessage('Prospect deletado com sucesso!', 'success'); // Adiciona uma mensagem de sucesso
            header('Location: ' . VIEWS_URL . 'dashboard.php'); // Redireciona para o dashboard
        }else{
            // Se o prospect não for deletado
            $notify->addMessage('Erro ao deletar prospect!', 'error'); // Adiciona uma mensagem de erro
            header('Location: ' . VIEWS_URL . 'delete_prospect.php'); // Redireciona para a página de exclusão
        }
    }else{
        // Se o prospect não for encontrado
        $notify->addMessage('Prospect não encontrado!', 'error'); // Adiciona uma mensagem de erro
        header('Location: ' . VIEWS_URL . 'delete_prospect.php'); // Redireciona para a página de exclusão
    }
}else{
    // Caso o parâmetro 'cod_prospect' não tenha scod_prospecto passado na query string
    $notify->addMessage('cod_prospect do prospect não forneccod_prospecto!', 'error'); // Adiciona uma mensagem de erro
    header('Location: ' . VIEWS_URL . 'dashboard.php'); // Redireciona para o dashboard
}
