<?php

session_start(); // Inicia a sessão

require_once __DIR__ . '/../../config.php'; // Inclui o arquivo de configuração
require_once (SRC . 'utils/notify.php'); // Inclui o arquivo de utilcod_prospectades
require_once (SRC . 'Controllers/Propects/ControllerPropect.php'); // Inclui a classe ControllerPropect


use Controllers\ControllerPropect;

use Utils\Notify;


// >>> Funções CRUD <<<

 /**
    * @author Eduardo Gustavo da Silva Rodrigues
    * @description Fazer tratamneto de requisições HTTP para o CRUD de propects
    * @param string $meth indica o tipo de requisição em query string em metodo get
    * @param string $id indica o codigo do prospect em body em metodo post
    */

// Configura o cabeçalho para permitir requisições CORS (se necessário)
header('Content-Type: application/json');

// Roteamento baseado no método HTTP
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case 'GET':
        handleGet();
        break;
    case 'POST':
        handlePost();
        break;
    default:
        handleNotAllowed();
        break;
}

// Função para lidar com métodos desconhecidos
function handleNotAllowed() {
    http_response_code(405); // Código de status HTTP 405 (Método Não Permitido)
    echo json_encode(["error" => "Method not allowed"]);
}

function handlePost() {
  
    $id = $_POST['cod'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $whatapp = $_POST['whatsapp'];
    $facebook = $_POST['facebook'];
    $celular = $_POST['cellphone'];   

    if(isset($id) && !empty($id)){
        putProspect($name, $email, $whatapp, $facebook, $celular, $id);
    }else{
        insertProspetc($name, $email, $whatapp, $facebook, $celular);
    }

}

function handleGet() {
    // Lógica para o método GET (ex.: leitura de dados)
    $notify = new Notify();
    $meth = $_GET['meth'];
    if(isset($meth)){
        switch ($meth) {
            case 'del_propect':
                deleteProspect($_GET['cod_prospect']);
                break;
            default:
                handleNotAllowed();
                break;
        }
    }else{
        // Caso o parâmetro 'cod_prospect' não tenha scod_prospecto passado na query string
        $notify->addMessage(' do prospect não forneccod_prospecto!', 'erro_meth'); // Adiciona uma mensagem de erro
        header('Location: ' . VIEWS_URL . 'dashboard.php'); // Redireciona para o dashboard
    }
}
// >>> Funções CRUD <<<


 /**
    * @author Eduardo Gustavo da Silva Rodrigues
    * @description Deleta um prospect
    * @param string $cod_prospect
    */

function deleteProspect($cod_prospect){

    // Inteanciamento de classes e objetos
    $notify = new Notify();
    $controller = new ControllerPropect();

    // Verifica se o parâmetro 'cod_prospect' foi passado na query string
    if (! isset($_GET['cod_prospect'])) {
        $notify->addMessage('cod_prospect do prospect não forneccod_prospecto!', 'error'); 
        header('Location: ' . VIEWS_URL . 'dashboard.php'); 
        return;
    }        

    // Busca o prospect no banco de dados para verificar se ele existe
    $prospect = $controller->buscarPropect($cod_prospect); 

    if(! $prospect){
        $notify->addMessage('Prospect não encontrado!', 'error');
        header('Location: ' . VIEWS_URL . 'dashboard.php');
        return;
    }

    // Deleta o prospect do banco de dados
    $deleted = $controller->deletarPropect($cod_prospect);

    if(! $deleted){
        $notify->addMessage('Erro ao deletar prospect!', 'error');
        header('Location: ' . VIEWS_URL . 'dashboard.php');
        return;
    }

    $notify->addMessage('Prospect deletado com sucesso!', 'success');
    header('Location: ' . VIEWS_URL . 'dashboard.php');
   
}

 /**
    * @author Eduardo Gustavo da Silva Rodrigues
    * @description Fução apara adicionar um novo prospect
    * @param string $name
    * @param string $email
    * @param string $whatapp
    * @param string $facebook
    * @param string $celular
    */

function insertProspetc($name, $email, $whatapp, $facebook, $celular){

    // Inteanciamento de classes e objetos
    $notify = new Notify(); // Instancia a classe de notificação
    $controller = new ControllerPropect();

    // Cadastra o prospect
    $prospect = $controller->cadastrarPropect($name, $email, $whatapp, $facebook, $celular); 

    if(! $prospect){
        $notify->addMessage('Erro ao cadastrar prospect!', 'error'); 
        header('Location: '. VIEWS_URL . 'insert_prospect.php'); 
        return;
    }

    $notify->addMessage('Prospect adcionado com sucesso!'.$prospect, 'success'); 
    header('Location: '.VIEWS_URL.'dashboard.php'); 
}
 /**
    * @author Eduardo Gustavo da Silva Rodrigues
    * @description Função para atualizar um prospect
    * @param string $name
    * @param string $email
    * @param string $whatapp
    * @param string $facebook
    * @param string $celular
    * @param string $cod_prospect  
    */ 

function putProspect($name, $email, $whatapp, $facebook, $celular, $cod_prospect){
    
    // Inteanciamento de classes e objetos
    $notify = new Notify(); 
    $controller = new ControllerPropect();
    
    // Atualiza o prospect
    $prospect = $controller->putProspects($name, $email, $whatapp, $facebook, $celular, $cod_prospect);

    if(! $prospect){
        $notify->addMessage('Erro ao cadastrar prospect!', 'error');
        header('Location: '. VIEWS_URL . 'prospect/edit_prospect.php?cod_prospect='.$cod_prospect);
        return;
    }

    $notify->addMessage('Prospect atualizado com sucesso! '. $cod_prospect, 'success');
    $_SESSION['prospect'] = serialize($prospect);
    header('Location: '.VIEWS_URL.'dashboard.php');
}
?>
